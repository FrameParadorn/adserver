<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Adldap\Laravel\Facades\Adldap;

class HomeController extends Controller
{

    protected $AD_USER;
    protected $AD_TYPE;

    
    public function loadSession(Request $req)
    {
        $this->AD_USER = $req->session()->get("ad_username");
        $this->AD_TYPE = $req->session()->get("ad_type");
        if(!empty($this->AD_USER)) {
            return redirect("/home");
        }

    }


    public function login(Request $req)
    {
        $data = [
            "hasBackground" => true
        ];

        if($this->loadSession($req)) return $this->loadSession($req);

        return view('auth.userLogin', $data);
    }



    public function isAdmin($ad, $username) {
        $userId=trim($username);
        exec("NET USER /DOMAIN ".$userId." 2>1",$outputs);

        foreach($outputs as $output) {
            if(strpos($output, "Group") > -1 && strpos($output, env("AD_ADMIN_GROUP")) > -1) {
                return true;
            }
        }

        return false;

    }


    public function verify(Request $req) 
    {

        $username = $req->username;
        $password = $req->password;
        $server = env("AD_SERVER"); 
        $user = $username."@".env("AD_DOMAIN");

        $ad = ldap_connect($server);
        ldap_set_option($ad, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ad, LDAP_OPT_REFERRALS, 0);
        if(!$ad) {
            echo "Server not connected. Please contact to your administrator of ad server";
            return;
        } else {
            $login = @ldap_bind($ad,$user,$password);
            if(!$login) {
                return redirect()->back();
            }else {

                Session::put('ad_username', $username);
                if($this->isAdmin($ad, $username)) {
                    Session::put('ad_type', "admin");
                }else {
                    Session::put('ad_type', "user");
                }

                return redirect("/home");
            }
        }
    
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $req)
    {

        if(empty($this->loadSession($req))) return redirect("/");
        $news = DB::table("news")->orderBy("id", "DESC")->where("type", $this->AD_TYPE)->get();
        $services = DB::table("services")->where("type", $this->AD_TYPE)->get();
        $slides = DB::table("slides")->get();

        $data = [
            "news" => $news,
            "slides" => $slides,
            "services" => $services
        ];

        return view('home', $data);
    }



    public function logout() {
        Session::flush();
        return redirect("/");
    }


}

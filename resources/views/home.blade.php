@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/css/swiper.min.css">
@endsection

@section('content')

    <div class="nav">
        <div class="container">
            <img src="images/logo.png" class="logo">
            <span class="float-right mt-3">ยินดีต้อนรับ {{ session('ad_username') }} <a href="/userlogout">ออกจากระบบ</a></span>
        </div>
    </div>

    <div class="swiper-container" style="height: 400px">
        <div class="swiper-wrapper">
            @foreach($slides as $slide)
                <div class="swiper-slide" style="background: url('storage/{{ $slide->image }}');">
                <div class="content">
                    <div style="width: 90%;">
                        <h1>{{ $slide->title }}</h1>
                        <h3>{{ $slide->content }}</h3>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

    <div class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-3 mt-3">
                    <div class="card pt-2">
                        @foreach($services as $service)
                        <div class="service">
                            <div style="background-image: url('/storage/{{ $service->icon }}')" class="icon"></div>
                            <div>
                                <div class="service-name">{{ $service->name }}</div>
                                <div class="service-url">
                                    <a href="{{ $service->url }}">{{ $service->url }}</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-9">
                    @php
                        $thaimonth=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
                    @endphp
                    @foreach($news as $val)
                    <div class="card news-card mt-3">
                        <div class="cover" style="background: url('storage/{{ $val->image }}')"></div>
                        <div class="card-content">
                            <div class="date-time">
                                {{ date("d", strtotime($val->created_at)) }} 
                                {{ $thaimonth[date("n", strtotime($val->created_at))] }} 
                                {{ date("Y", strtotime($val->created_at)) }}
                            </div>
                            <div class="title">{{ $val->title }}</div>
                            <div class="content">{!! $val->content !!}</div>
                            <button 
                                class="button-detail" 
                                data-content="{{ $val->content }}"
                                data-video="{{ !empty($val->video) ? $val->video : "" }}"
                            >
                                รายละเอียด
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" style="font-size: 3rem;">&times;</button>
                    <div class="title">
                    </div>
                    <div class="date-time">
                    </div>
                    <div class="news-content">
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/js/swiper.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
            },
        });

        let modal = $("#myModal")

        $(".button-detail").click(function() {

            let title = $(this).parent().find(".title").text()
            let content = $(this).attr("data-content")
            let video = $(this).attr("data-video")
            let date = $(this).parent().find(".date-time").text()
            console.log(content);

            modal.find(".title").text(title)
            modal.find(".date-time").text(date)
            modal.find(".news-content").html(content).css("text-indent", "40px")

            if(video !== "")  {
                let videoContent = `
                    <video controls autoplay style="width: 100%" class="mt-3">
                        <source src="/storage/${video}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                `; 
                modal.find(".news-content").append(videoContent)
            }

            console.log("debug");

            $("#myModal").modal("show")     
        })


        $(".service").click(function() {
            let url = $(this).find("a").attr("href")   
            window.open(url)
        })


        modal.on('hidden.bs.modal', function () {
            modal.find(".title").html("")
            modal.find(".date-time").html("")
            modal.find(".news-content").html("")
        })

        
    </script>
@endsection

<div class="form-group {{ $errors->has('icon') ? 'has-error' : ''}}">
    <label for="icon" class="control-label">{{ 'Icon' }}</label>
    <input class="form-control" name="icon" type="file" id="icon" value="{{ isset($service->icon) ? $service->icon : ''}}" {{ !isset($isEdit) ? "required" : "" }}>
    {!! $errors->first('icon', '<p class="help-block">:message</p>') !!}
    @isset($service->icon)
    <img src="/storage/{{ $service->icon }}" style="width: 50px;" class="mt-3">
    @endisset
</div>
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($service->name) ? $service->name : ''}}" required>
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('url') ? 'has-error' : ''}}">
    <label for="url" class="control-label">{{ 'Url' }}</label>
    <textarea class="form-control" rows="5" name="url" type="textarea" id="url" required>{{ isset($service->url) ? $service->url : ''}}</textarea>
    {!! $errors->first('url', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    <label for="type" class="control-label">{{ 'Type' }}</label>
    <select name="type" class="form-control" id="type" required>
    @foreach (json_decode('{"user": "User", "admin": "Admin"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($news->type) && $news->type == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
    {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>

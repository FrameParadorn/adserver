<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Title' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ isset($news->title) ? $news->title : ''}}" required>
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
    <label for="content" class="control-label">{{ 'Content' }}</label>
    <textarea class="form-control" rows="5" name="content" type="textarea" id="content" required>{{ isset($news->content) ? $news->content : ''}}</textarea>
    {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    <label for="image" class="control-label">{{ 'Image' }}</label>
    <input class="form-control" name="image" type="file" id="image" value="{{ isset($news->image) ? $news->image : ''}}" {{ !isset($isEdit) ? "required" : "" }}>
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}

    @isset($news->image)
    <img src="/storage/{{ $news->image  }}" style="width: 50%" class="mt-3">
    @endisset
</div>
<div class="form-group {{ $errors->has('video') ? 'has-error' : ''}} mt-3">
    <label for="video" class="control-label">{{ 'video' }}</label>
    <input class="form-control" name="video" type="file" id="image" value="{{ isset($news->video) ? $news->video : ''}}" >
    {!! $errors->first('video', '<p class="help-block">:message</p>') !!}

    @if(isset($news->video) && !empty($news->video))
    <video controls autoplay style="width: 100%" class="mt-3">
        <source src="/storage/{{ $news->video }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    @endif
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

{{ csrf_field() }}

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name" class="col-md-4 control-label">Tag Name</label>

    <div class="col-md-6">
        <input id="name" 
            type="text" 
            class="form-control" 
            name="name" 
            value="{{ old('name', $tag->name) }}" autofocus>

        {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
    <label for="type" class="col-md-4 control-label">Tag type</label>

    <div class="col-md-6">
        <select id="type" 
            class="form-control" 
            name="type">
            <option disabled selected>Pick a type...</option>
            <option value="blog"{{ old('type', $tag->type) == 'blog' ? ' selected' : '' }}>Blog</option>
            <option value="ebook"{{ old('type', $tag->type) == 'ebook' ? ' selected' : '' }}>Ebook</option>
            <option value="video"{{ old('type', $tag->type) == 'video' ? ' selected' : '' }}>Video</option>
        </select>

        {!! $errors->first('type', '<span class="help-block">:message</span>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary btn-lg">
            Save
        </button>
        <a href="{{ route('tags.index') }}" class="btn btn-default btn-lg">
            Cancel
        </a>
    </div>
</div>

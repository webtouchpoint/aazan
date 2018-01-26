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

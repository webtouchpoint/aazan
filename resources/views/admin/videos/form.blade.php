        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label for="title" class="col-md-4 control-label">Title</label>

            <div class="col-md-6">
                <input id="title" 
                    type="text" 
                    class="form-control" 
                    name="title" 
                    value="{{ old('title', $video->title) }}" autofocus>

                {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
            </div>
        </div>

        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <label for="description" class="col-md-4 control-label">Description</label>

            <div class="col-md-6">
                <textarea id="description" 
                    type="text" 
                    class="form-control" 
                    rows="5"
                    name="description">{{ old('description', $video->description) }}</textarea>

                {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
            </div>
        </div>

        @if($video->link)
            <div class="form-group">
                <label class="col-md-4 control-label">&nbsp;</label>

                <div class="col-md-6">
                    <a href="{{ $video->link }}" target="_blank"
                        class="btn btn-sm btn-warning">
                            <i class="fa fa-eye"></i> View
                    </a>
                </div>
            </div>
        @endif

        <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
            <label for="link" class="col-md-4 control-label">Video Link</label>

            <div class="col-md-6">
                <input id="link" 
                    type="text" 
                    class="form-control" 
                    name="link" 
                    value="{{ old('description', $video->link) }}">

                {!! $errors->first('link', '<span class="help-block">:message</span>') !!}
            </div>
        </div>

        <div class="form-group{{ $errors->has('youtube_id') ? ' has-error' : '' }}">
            <label for="youtube_id" class="col-md-4 control-label">Youtube Id</label>

            <div class="col-md-6">
                <input id="youtube_id" 
                    type="text" 
                    class="form-control" 
                    name="youtube_id" 
                    value="{{ old('youtube_id', $video->youtube_id) }}" autofocus>

                {!! $errors->first('youtube_id', '<span class="help-block">:message</span>') !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary btn-lg">
                    Save
                </button>
                <a href="{{ route('videos.index') }}" class="btn btn-default btn-lg">
                    Cancel
                </a>
            </div>
        </div>
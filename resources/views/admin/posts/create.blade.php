@extends('admin.layouts.master')

@section('content')
    @component('components.panelWithHeading')
        @slot('title')
            Post - Create
        @endslot

    <form class="form-horizontal" method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label for="title" class="col-md-4 control-label">Title</label>

            <div class="col-md-6">
                <input id="title" 
                    type="text" 
                    class="form-control" 
                    name="title" 
                    value="{{ old('title') }}" autofocus>

                {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
            </div>
        </div>

        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
            <label for="content" class="col-md-4 control-label">Content</label>

            <div class="col-md-6">

                <wysiwyg name="content" value="{{ old('content') }}"></wysiwyg>

                {!! $errors->first('content', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
        <div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
            <label for="tags" class="col-md-4 control-label">Tags</label>

            <div class="col-md-6">
                <select name="tags[]"
                    id="tags"
                    class="form-control"
                    multiple>
                    @if (count($allTags) > 0) 
                        @foreach ($allTags as $tag)
                            <option value="{{ $tag->id }}" {{ (collect(old('tags'))->contains($tag->id)) ? 'selected' : '' }}>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    @endif
                </select>

                {!! $errors->first('tags', '<span class="help-block">:message</span>') !!}
            </div>
        </div>

        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
            <label for="image" class="col-md-4 control-label">Upload Image</label>

            <div class="col-md-6">
                <input id="image" 
                    type="file" 
                    class="form-control" 
                    name="image">

                {!! $errors->first('image', '<span class="help-block">:message</span>') !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary btn-lg">
                    Save
                </button>
                <a href="{{ route('posts.index') }}" class="btn btn-default btn-lg">
                    Cancel
                </a>
            </div>
        </div>
    </form>
    @endcomponent
@endsection

@section('scripts')
  <script>
    $(document).ready(function() {
        $('#tags').select2({
            placeholder: "Select a tags..."
        });
    });
  </script>
@endsection

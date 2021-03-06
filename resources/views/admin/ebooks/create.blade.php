@extends('admin.layouts.master')

@section('content')
    @component('components.panelWithHeading')
        @slot('title')
            Ebooks - Create
        @endslot

    <form class="form-horizontal" method="POST" action="{{ route('ebooks.store') }}" enctype="multipart/form-data">
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

        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <label for="description" class="col-md-4 control-label">Description</label>

            <div class="col-md-6">
                <textarea id="description" 
                    type="text" 
                    class="form-control" 
                    rows="5"
                    name="description">{{ old('description') }}</textarea>

                {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
        <div class="form-group{{ $errors->has('filename') ? ' has-error' : '' }}">
            <label for="filename" class="col-md-4 control-label">Upload File</label>

            <div class="col-md-6">
                <input id="filename" 
                    type="file" 
                    class="form-control" 
                    name="filename">

                {!! $errors->first('filename', '<span class="help-block">:message</span>') !!}
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

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary btn-lg">
                    Save
                </button>
                <a href="{{ route('ebooks.index') }}" class="btn btn-default btn-lg">
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

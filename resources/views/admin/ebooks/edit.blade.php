@extends('admin.layouts.master')

@section('content')
    @component('components.panelWithHeading')
        @slot('title')
            Ebooks - Edit
        @endslot

    <form class="form-horizontal" method="POST" action="{{ route('ebooks.update',  $ebook->slug) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label for="title" class="col-md-4 control-label">Title</label>

            <div class="col-md-6">
                <input id="title" 
                    type="text" 
                    class="form-control" 
                    name="title" 
                    value="{{ old('title', $ebook->title) }}" autofocus>

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
                    name="description">{{ old('description', $ebook->description ) }}</textarea>

                {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
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
                            <option value="{{ $tag->id }}" {{ (collect(old('tags', $ebook->tags()->allRelatedIds()))->contains($tag->id)) ? 'selected' : '' }}>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    @endif
                </select>

                {!! $errors->first('tags', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
        @if($ebook->filename)
        <div class="form-group">
            <label class="col-md-4 control-label">&nbsp;</label>

            <div class="col-md-6">
                <a href="{{ asset('storage/ebooks/'.$ebook->filename) }}" target="_blank"
                    class="btn btn-sm btn-warning">
                        <i class="fa fa-eye"></i> View
                </a>
               <button type="button" class="btn btn-danger btn-sm"
                    data-toggle="modal" data-target="#modal-deletefile">
                        <i class="fa fa-times"></i>
                </button>
            </div>
        </div>

        @else
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
        @endif

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary btn-lg">
                     <i class="fa fa-floppy-o"></i> Save
                </button>
                <button type="button" class="btn btn-danger btn-lg"
                    data-toggle="modal" data-target="#modal-delete">
                        <i class="fa fa-times-circle"></i> Delete
                </button>
                <a href="{{ route('ebooks.index') }}" class="btn btn-default btn-lg">
                    Cancel
                </a>
            </div>
        </div>
    </form>

    {{-- Confirm Delete --}}
    <div class="modal fade" id="modal-delete" tabIndex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                    &times;
                    </button>
                    <h4 class="modal-title">Please Confirm</h4>
                </div>
                <div class="modal-body">
                    <p class="lead">
                        <i class="fa fa-question-circle fa-lg"></i> &nbsp;
                        Are you sure you want to delete this ebook?
                    </p>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('ebooks.destroy', $ebook->slug) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="button" class="btn btn-default"
                            data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fa fa-times-circle"></i> Yes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Confirm File Delete --}}
    <div class="modal fade" id="modal-deletefile" tabIndex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                    &times;
                    </button>
                    <h4 class="modal-title">Please Confirm</h4>
                </div>
                <div class="modal-body">
                    <p class="lead">
                        <i class="fa fa-question-circle fa-lg"></i> &nbsp;
                        Are you sure you want to delete this file?
                    </p>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('ebooks.deletefile', $ebook->slug) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="button" class="btn btn-default"
                            data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fa fa-times-circle"></i> Yes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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

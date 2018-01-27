@extends('admin.layouts.master')

@section('content')
<div class="row page-title-row">
    <div class="col-md-6">
        <h3>Videos <small>&raquo; Listing</small></h3>
    </div>
    <div class="col-md-6 text-right">
        <a href="{{ route('videos.create') }}" class="btn btn-success btn-md">
            <i class="fa fa-plus-circle"></i> New Video
        </a>
    </div>
</div>

<table class="table table-bordered" id="videos-table">
    <thead>
        <th>Title</th>
        <th>Description</th>
        <th>Published</th>
        <th>Actions</th>
    </thead>   
    <tbody>
        @forelse ($videos as $video)
            <tr>
                <td>
                    {{ $video->title }}
                </td>
                <td>
                    {{ $video->description }}
                </td>
                <td>
                    {{ $video->created_at->format('d-m-Y') }}
                </td>
                <td>
                    <a href="{{ route('videos.edit', $video->slug) }}"
                        class="btn btn-xs btn-info">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                    <a href="{{ $video->link }}" target="_blank" 
                        class="btn btn-xs btn-warning">
                        <i class="fa fa-edit"></i> View
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">
                    No Video exists.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>


@endsection

@section('scripts')
  <script>
    $(function() {
      $("#videos-table").DataTable({
        order: [[0, "desc"]]
      });
    });
  </script>
@endsection
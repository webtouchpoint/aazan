@extends('admin.layouts.master')

@section('content')
<div class="row page-title-row">
    <div class="col-md-6">
        <h3>News <small>&raquo; Listing</small></h3>
    </div>
    <div class="col-md-6 text-right">
        <a href="{{ route('news.create') }}" class="btn btn-success btn-md">
            <i class="fa fa-plus-circle"></i> New News
        </a>
    </div>
</div>

<table class="table table-bordered" id="news-table">
    <thead>
        <th>Title</th>
        <th>Description</th>
        <th>Published</th>
        <th>Actions</th>
    </thead>   
    <tbody>
        @forelse ($allNews as $news)
            <tr>
                <td>
                    {{ $news->title }}
                </td>
                <td>
                    {{ $news->description }}
                </td>
                <td>
                    {{ $news->created_at->format('d-m-Y') }}
                </td>
                <td>
                    <a href="{{ route('news.edit', $news->slug) }}"
                    class="btn btn-xs btn-info">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                    @if($news->filename)
                        <a href="{{ asset('storage/news/'.$news->filename) }}" target="_blank"
                        class="btn btn-xs btn-warning">
                            <i class="fa fa-eye"></i> View
                        </a>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">
                    No news exists.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>


@endsection

@section('scripts')
  <script>
    $(function() {
      $("#news-table").DataTable({
        order: [[0, "desc"]]
      });
    });
  </script>
@endsection

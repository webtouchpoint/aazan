@extends('admin.layouts.master')

@section('content')
<div class="row page-title-row">
    <div class="col-md-6">
        <h3>Posts <small>&raquo; Listing</small></h3>
    </div>
    <div class="col-md-6 text-right">
        <a href="{{ route('posts.create') }}" class="btn btn-success btn-md">
            <i class="fa fa-plus-circle"></i> New Post
        </a>
    </div>
</div>

<table class="table table-bordered" id="posts-table">
    <thead>
        <th>Title</th>
        <th>Content</th>
        <th>Published</th>
        <th>Actions</th>
    </thead>   
    <tbody>
        @forelse ($posts as $post)
            <tr>
                <td>
                    {{ $post->title }}
                </td>
                <td>
                    {{ $post->content }}
                </td>
                <td>
                    {{ $post->created_at->format('d-m-Y') }}
                </td>
                <td>
                    <a href="{{ route('posts.edit', $post->slug) }}"
                        class="btn btn-xs btn-info">
                        <i class="fa fa-edit"></i> Edit
                    </a> 
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">
                    No post exists.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>


@endsection

@section('scripts')
  <script>
    $(function() {
      $("#posts-table").DataTable({
        order: [[0, "desc"]]
      });
    });
</script>
@endsection

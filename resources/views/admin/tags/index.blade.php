@extends('admin.layouts.master', [
    'vueView' => 'tags'
])

@section('content')
<div class="row page-title-row">
    <div class="col-md-6">
        <h3>Tags <small>&raquo; Listing</small></h3>
    </div>
    <div class="col-md-6 text-right">
        <a href="{{ route('tags.create') }}" class="btn btn-success btn-md">
            <i class="fa fa-plus-circle"></i> New Tag
        </a>
    </div>
</div>

<table class="table table-bordered" id="tags-table">
    <thead>
        <th>Name</th>
        <th>Type</th>
        <th>Actions</th>
    </thead>   
    <tbody>
        @forelse ($tags as $tag)
            <tr>
                <td>
                    {{ $tag->name }}
                </td>
                <td>
                    {{ $tag->type }}
                </td>
                <td>
                    <a href="{{ route('tags.edit', $tag->slug) }}"
                        class="btn btn-xs btn-info">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                   <button type="button" class="btn btn-xs btn-danger"
                        @click="deleteTag('{{ $tag->slug }}', '{{ $tag->name }}')">
                        <i class="fa fa-times-circle fa-lg"></i>
                        Delete
                    </button>    
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="2">
                    No tag exists.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- Delete File Modal --}}
<div class="modal fade" id="modal-tag-delete">
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
          Are you sure you want to delete the
          <kbd><span>@{{ name }}</span></kbd>
          tag?
        </p>
      </div>
      <div class="modal-footer">
        <form method="POST" :action="url">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
          <input type="hidden" name="del_tag" id="delete-tag-slug">
          <button type="button" class="btn btn-default" data-dismiss="modal">
            Cancel
          </button>
          <button type="submit" class="btn btn-danger">
            Delete
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
  <script>
    $(function() {
      $("#tags-table").DataTable({
        order: [[0, "desc"]]
      });
    });
  </script>
@endsection

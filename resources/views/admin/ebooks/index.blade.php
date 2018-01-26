@extends('admin.layouts.master')

@section('content')
<div class="row page-title-row">
    <div class="col-md-6">
        <h3>EBooks <small>&raquo; Listing</small></h3>
    </div>
    <div class="col-md-6 text-right">
        <a href="{{ route('ebooks.create') }}" class="btn btn-success btn-md">
            <i class="fa fa-plus-circle"></i> New EBook
        </a>
    </div>
</div>

<table class="table table-bordered" id="ebook-table">
    <thead>
        <th>Title</th>
        <th>Description</th>
        <th>Published</th>
        <th>Actions</th>
    </thead>   
    <tbody>
        @forelse ($ebooks as $ebook)
            <tr>
                <td>
                    {{ $ebook->title }}
                </td>
                <td>
                    {{ $ebook->description }}
                </td>
                <td>
                    {{ $ebook->created_at->format('d-m-Y') }}
                </td>
                <td>
                    <a href="{{ route('ebooks.edit', $ebook->slug) }}"
                    class="btn btn-xs btn-info">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                    @if($ebook->filename)
                        <a href="{{ asset('storage/ebooks/'.$ebook->filename) }}" target="_blank"
                        class="btn btn-xs btn-warning">
                            <i class="fa fa-eye"></i> View
                        </a>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">
                    No Ebook exists.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>


@endsection

@section('scripts')
  <script>
    $(function() {
      $("#ebook-table").DataTable({
        order: [[0, "desc"]]
      });
    });
  </script>
@endsection

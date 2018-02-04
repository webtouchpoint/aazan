@extends('admin.layouts.master')

@section('content')
    @component('components.panelWithHeading')
        @slot('title')
            Videos - Create
        @endslot

	    <form class="form-horizontal" method="POST" action="{{ route('videos.store') }}">
	        @include('admin.videos.form')
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

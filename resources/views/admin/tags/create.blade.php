@extends('admin.layouts.master')

@section('content')
    @component('components.panelWithHeading')
        @slot('title')
            Tags - Create
        @endslot

    <form class="form-horizontal" method="POST" action="{{ route('tags.store') }}">
        @include('admin.tags.form')
    </form>
    @endcomponent
@endsection

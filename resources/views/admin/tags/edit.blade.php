@extends('admin.layouts.master')

@section('content')
    @component('components.panelWithHeading')
        @slot('title')
            Tags - Edit
        @endslot

    <form class="form-horizontal" method="POST" action="{{ route('tags.update', $tag->slug) }}">
    	{{ method_field('PATCH') }}
        @include('admin.tags.form')
    </form>
    @endcomponent
@endsection

@extends('layouts.master')

@section('content')
    <h1>Ebooks</h1>
    <hr>
    <table class="table table-bordered table-ebooks">
        <thead>
            <tr>
                <th>File</th>
                <th>&nbsp;</th>
                <th>Download</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ebooks as $ebook)
                <tr>
                    <td class="text-center">
                        <a href="{{ asset('storage/ebooks/'.$ebook->filename) }}" target="_blank">
                            <i class="fa fa-file-pdf-o"></i>
                        </a>
                    </td>
                    <td>                             
                        <a href="{{ asset('storage/ebooks/'.$ebook->filename) }}" target="_blank">
                            {{ $ebook->title }}
                        </a>
                    </td>
                    <td class="text-center">
                         <a href="{{ asset('storage/ebooks/'.$ebook->filename) }}" download>
                                <i class="fa fa-download"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">
                        No EBooks found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection

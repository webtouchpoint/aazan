@extends('layouts.master')

@section('content')
    <h1>News</h1>
    <hr>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>News</th>
                <th>Download</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($allNews as $news)
                <tr>
                    <td>                             
                        <a href="{{ asset('storage/news/'.$news->filename) }}" target="_blank">
                            {{ $news->title }}
                        </a>
                    </td>
                    <td class="text-center">
                         <a href="{{ asset('storage/ebooks/'.$news->filename) }}" download>
                                <i class="fa fa-download"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">
                        No news found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection

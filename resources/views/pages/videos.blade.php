@extends('layouts.master')

@section('content')
    <h2>Video</h2>

    @forelse($videos as $video)
    <div class="video-container">
        <h4>{{ $video->title }}</h4>
        <div class="videoWrapper">
            <!-- Copy & Pasted from YouTube -->
            <iframe 
                width="560" 
                height="349" 
                src="http://www.youtube.com/embed/{{ $video->youtube_id }}?rel=0&hd=1" 
                frameborder="0" 
                allowfullscreen></iframe>
        </div>
        <h5>{{ $video->description }}</h5>
    </div>
    @empty
        <h4>No videos found.</h4>
    @endforelse


@endsection

@section('scripts')
    <script>
        // Find all YouTube videos
        var $allVideos = $("iframe[src^='//www.youtube.com']"),

            // The element that is fluid width
            $fluidEl = $("body");

        // Figure out and save aspect ratio for each video
        $allVideos.each(function() {

          $(this)
            .data('aspectRatio', this.height / this.width)

            // and remove the hard coded width/height
            .removeAttr('height')
            .removeAttr('width');

        });

        // When the window is resized
        $(window).resize(function() {

          var newWidth = $fluidEl.width();

          // Resize all videos according to their own aspect ratio
          $allVideos.each(function() {

            var $el = $(this);
            $el
              .width(newWidth)
              .height(newWidth * $el.data('aspectRatio'));

          });

        // Kick off one resize to fix all videos on page load
        }).resize();
    </script>
@endsection

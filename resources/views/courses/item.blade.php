{{-- @extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h3>{{ $course->title }}</h3>
                </div>
                <div class="card-body">

                    <h5 class="mb-3">{{ $course->sub_title }}</h5>

                    {{-- DEBUG: Show what URL we got --}}
                    <p><b>Video URL from DB:</b> {{ $video_url }}</p>

                    @php
                        $videoId = '';
                        if (preg_match('/youtube\.com\/watch\?v=([^&]+)/', $video_url, $m)) $videoId = $m[1];
                        elseif (preg_match('/youtu\.be\/([^?]+)/', $video_url, $m)) $videoId = $m[1];
                    @endphp

                    @if($videoId)
                        <div class="embed-responsive embed-responsive-16by9 mb-3">
                           @if($videoId)
    <div class="embed-responsive embed-responsive-16by9 mb-3">
        <iframe class="embed-responsive-item"
            src="https://www.youtube.com/embed/{{ $videoId }}"
            frameborder="0" allowfullscreen>
        </iframe>
    </div>
@else
    <div class="alert alert-danger">Invalid URL</div>
@endif

{{-- Fallback link --}}
<a href="{{ $video_url }}" target="_blank" class="btn btn-danger">Watch on YouTube</a>
                        </div>
                    @else
                        <div class="alert alert-danger">
                            <b>Video not playing because:</b> <br>
                            The URL in `playlist_url` is not a valid YouTube watch link. <br>
                            Current: {{ $video_url }} <br><br>
                            It must look like: `https://www.youtube.com/watch?v=XXXX` or `https://youtu.be/XXXX`
                        </div>
                    @endif

                    <hr>
                    <div>{!! $course->description!!}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
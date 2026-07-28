@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">

        <!-- LEFT COLUMN -->
        <div class="col-md-8" style="padding-right:5px;">
            @if(Auth::check() && (Auth::user()->id == $item->user_id || Auth::user()->role_id < 3))
                <h2 class="text-right">
                    <a href="{{ route('items.edit', $item->id) }}" class="btn btn-primary btn-md">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                </h2>
            @endif

            <h3 style="margin-bottom:-20px;">{{ $item->title }}</h3> <br>
            <small>Views: {{ $item->view_count }}</small>

            <div class="text-right" style="margin-bottom:15px;"></div>

            @if($item->created_at)
                <div class="text-muted" style="margin-bottom:15px;"></div>
            @endif

            {{-- DYNAMIC VIDEO EMBED FROM $item->url --}}
            @if(!empty($item->url))
                @php
                    // This regex grabs the 11 char ID from any youtube url
                    preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $item->url, $match);
                    $youtube_id = $match[1]?? null;
                @endphp

                @if($youtube_id)
                    <div class="embed-responsive embed-responsive-16by9" style="margin-bottom:20px;">
                        <iframe
                            class="embed-responsive-item"
                            src="https://www.youtube.com/embed/{{ $youtube_id }}"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                @else
                    {{-- If it's not a youtube video, just show the link --}}
                    <p style="margin-top:15px;"><a href="{{ $item->url }}" target="_blank">{{ $item->url }}</a></p>
                @endif
            @endif

            <hr>
            <h3>Description</h3>
            <small class="text-muted">{{ optional($item->created_at)->format('h:i a - D d M Y') }}</small>
            <p>{{ $item->description }}</p>
        </div>

        <!-- RIGHT COLUMN -->
        <div class="col-md-4" style="padding-left:20px;">
            <div class="panel panel-default">
                <div class="panel-heading"><h2><strong>Playlist</strong></h2></div>
                <div class="list-group">
                    @foreach($course->items as $newItem)
                        <a href="{{ route('courses.items', ['course_id'=>$course->id,'item_id'=>$newItem->id]) }}"
                           class="list-group-item {{ $item->id == $newItem->id? 'active' : '' }}">
                            <i class="fa-solid fa-play me-2"></i> {{ $newItem->title }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
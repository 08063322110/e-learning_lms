@extends('layouts.app')

@section('content')
<style>
    .nav-tabs { border-bottom: 1px solid #ddd; margin-bottom: 25px; }
    .nav-tabs>li { margin-bottom: -1px; }
    .nav-tabs>li>a { 
        border: 1px solid transparent; 
        border-radius: 0; 
        padding: 10px 15px; 
        font-weight: 600; 
        color: #333; 
        margin-right: 2px;
    }
    .nav-tabs>li.active>a {
        background-color: #337ab7; 
        color: #fff; 
        border: 1px solid #337ab7;
        border-bottom-color: transparent;
    }
    .item-row { position: relative; padding: 15px 0 15px 0; border-bottom: 1px solid #eee; }
    .item-actions { position: absolute; top: 10px; right: 15px; }
</style>

<div class="container">
    <h2 style="margin-bottom: 20px;">{{ $course->title }}</h2>

    {{-- Tabs --}}
    <ul class="nav nav-tabs">
        <li><a href="{{ route('courses.show', $course->id) }}">Course Home</a></li>
        <li class="active"><a href="{{ route('courses.contents', $course->id) }}">Contents</a></li>
        <li><a href="{{ route('courses.subscribers', $course->id) }}">Subscribers</a></li>
    </ul>

    {{-- Centered Header --}}
    <h3 class="text-center" style="margin-bottom: 15px;">Course contents</h3>

    {{-- Add Item button - right above first item --}}
    <div class="text-right" style="margin-bottom: 10px;">
        <a href="{{ route('items.create', $course->id) }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Add Item
        </a>
    </div>

    @foreach($items as $item)
    <div class="item-row">
        
        {{-- Edit/Delete top right of each item --}}
        <div class="item-actions">
            <a href="{{ route('items.edit', $item->id) }}" class="btn btn-default btn-xs" title="Edit" style="padding:2px 6px;">
                <i class="fa fa-edit"></i>
            </a>
            <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-xs" title="Delete" style="padding:2px 6px;" onclick="return confirm('Delete this item?')">
                    <i class="fa fa-trash"></i>
                </button>
            </form>
        </div>

        {{-- Content --}}
        <h4 style="margin-top:0; padding-right: 80px;">
            <a href="{{ route('courses.items', ['course_id' => $course->id, 'item_id' => $item->id]) }}">
                {{ $item->title }}
            </a>
        </h4>

        <small class="text-muted">{{ $item->views ?? 0 }} views</small>

        <p style="margin-top: 5px; color:#555; padding-right: 80px;">
            {{ \Illuminate\Support\Str::limit(strip_tags($item->description), 300) }}
        </p>

    </div>
    @endforeach
</div>
@endsection
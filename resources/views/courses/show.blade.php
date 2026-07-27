@extends('layouts.app')

@section('content')
<section class="content-header">
</section>

<div class="content">

    <div class="clearfix"></div>
    @include('flash::message')
    <div class="clearfix"></div>

    <div class="box box-primary">
        <div class="box-body" style="padding:30px;">

            @include('courses.header')
            {{-- @include('courses.menu') --}}

            @if(isset($items) && $items == 'yes')

                @include('courses.show-item')

            @elseif(isset($subscribers) && $subscribers == 'yes')

                @include('courses.subscribers')

            @elseif(isset($contents) && $contents == 'yes')

                @include('courses.contents')

            @elseif(isset($description) && $description == 'yes')

                @include('courses.show_fields')

                <h2 class="text-center">Comments and Reviews</h2>

                @include('comments.table')

            @endif

        </div>
    </div>

</div>
@endsection

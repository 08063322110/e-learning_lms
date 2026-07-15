@extends('layouts.app')

@section('content')
   <section class="content-header">
           
   </section>

    <div class="content">

        <div class="clearfix"></div>
        @include('flash::message')
        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body">

                 @include('courses.header')
                 @include('courses.menu')
                <div class="row" style="padding-left: 20px">


                    @if(isset($items) AND $items == 'yes')
                            @include('courses.show-item')
                    @elseif(isset($subscribers) AND $subscribers == 'yes')
                            @include('courses.subscribers')
                    @elseif (isset($contents) AND $contents == 'yes')
                            @include('courses.contents') 
                    @elseif (isset($description) AND $description == 'yes')
                            @include('courses.show_fields')     
                            <h2 class="col-md-12">Comments and Reviews</h2>    
                            @include('comments.table')
                    @endif

                    {{-- <ul class="nav nav-tabs col-md-4 " id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active text-bold" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">Comments</a>
                    </li>

                        @if(Auth::check() AND (Auth::user()->role_id < 3 || Auth::user()->id == $course->user_id))
                    <li class="nav-item">
                        <a class="nav-link text-bold" id="profile-tab" data-toggle="tab" href="#profile" role="tab" 
                        aria-controls="profile" aria-selected="false">Subscribers</a>
                    </li>
                        @endif 
                    
                    </ul>
    <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                 @include('comments.table')

    </div>
    
        @if(Auth::check() AND (Auth::user()->role_id < 3 || Auth::user()->id == $course->user_id))
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <h3 class="col-md-12 text-center"> Subscribers </h3>
                                @include('users.table-user')
        </div>
        @endif

    </div>

                </div>
            </div>
        </div>
    </div> --}}
@endsection
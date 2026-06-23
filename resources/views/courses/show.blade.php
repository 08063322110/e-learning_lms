@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Course Details</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('courses.index') }}">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row" style="padding-left: 20px">
                    @include('courses.show_fields')


<ul class="nav nav-tabs col-md-8 " id="myTab" role="tablist">
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
    </div>
@endsection
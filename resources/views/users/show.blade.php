@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Details</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('users.index') }}">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('users.show_fields') 
                    
                    <ul class="nav nav-tabs text-center col-md-12"id="myTab" role="tablist">

                        <li class="nav-item">
                            <a class="nav-link text-bold" id="profile-tab" data-toggle="tab" href="#profile"
                            role="tab" aria-controls="profile" aria-selected="false">Subscriptions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-bold"  id="home-tab" data-toggle="tab" href="#home" 
                            role="tab" aria-controls="home" aria-selected="true">Courses Created by {{$user->name}}
                        </li>
                        
                        </ul>
                        <div class="tab-content col-md-12" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            @include('courses.table')</div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            @include('courses.table')</div>
                        </div>

                                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endsection

                     <div class="tab-content" id="myTabContent">

</div> /div>
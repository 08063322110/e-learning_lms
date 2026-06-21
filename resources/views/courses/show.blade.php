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
                    @if(Auth::check() AND (Auth::user()->role_id < 3 || Auth::user()->id == $course->user_id))
                            <h3 class="col-md-12 text-center"> Subscribers </h3>
                            @include('users.table-user')
                    @endif
                            @include('comments.table')

                </div>
            </div>
        </div>
    </div>
@endsection
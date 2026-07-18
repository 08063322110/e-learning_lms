@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Course Categories</h1>
                </div>

             @if(Auth::check() AND Auth::user()->role_id < 3)
                <h1> 
                    <a class="btn btn-primary pull-right" style="margin-top: -10px; margin-bottom: 5px"
                       href="{{ route('categories.create') }}">
                        Add New
                    </a>
                </h1>
             @endif

            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('categories.table')

                <div class="card-footer clearfix">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection


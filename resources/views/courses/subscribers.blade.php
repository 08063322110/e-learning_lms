@extends('layouts.app')

@section('content')



<div class="col-md-12">
<ul class="nav nav-pills text-bold"  >
  <li role="presentation" style="margin-right:15px;><a href="{{ route('courses.show', ['course' => $course->id]) }}">Course Home</a></li>
  <li role="presentation" style="margin-right:15px;"><a href="{{ route('courses.contents', ['course_id' => $course->id])}}">Contents</a></li>
  {{-- <li role="presentation"><a href="{{ route('courses.contents', ['course_id' => $course->id])}}">Contents</a></li> --}}


  @if (Auth::check() AND (Auth::user()->id == $course->user_id || Auth::user()->role_id < 3 )) 
    <li role="presentation"><a href="{{route('courses.subscribers', ['course_id' => $course->id])}}">Subscribers</a></li>
  @endif
  
</ul>
</div>


<div class="content" >

    <h2 style="margin-top: 25px; margin-bottom: 20px;">{{ $course->title }}</h2>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Amount</th>
            </tr>
        </thead>

        <tbody>
        @forelse($subscribers as $subscriber)
            <tr>
                <td>{{ $subscriber->name }}</td>
                <td>{{ $subscriber->email }}</td>
                <td>{{ $subscriber->gender }}</td>
                <td>${{ $subscriber->pivot->paid_amount }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">
                    No subscribers found.
                </td>
            </tr>
        @endforelse
        </tbody>

    </table>

</div>

@endsection
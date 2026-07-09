<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

<div class="col-md-12">
<ul class="nav nav-pills text-bold">
  <li role="presentation" ><a href="{{ route('courses.show', ['course' => $course->id]) }}">Course Home</a></li>
  <li role="presentation"><a href="{{ route('courses.contents', ['course_id' => $course->id])}}">Contents</a></li>
  <li role="presentation"><a href="#">Comments and Reviews</a></li>

  @if (Auth::check() AND (Auth::user()->id == $course->user_id || Auth::user()->role_id < 3 )) 
    <li role="presentation"><a href="#">Subscribers</a></li>
  @endif
</ul>
</div>

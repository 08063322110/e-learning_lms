@extends('layouts.app')

@section('content')

<div class="col-md-12">
@php
    $currentRoute = Route::currentRouteName();
@endphp

<ul class="nav nav-pills text-bold">
  <li role="presentation" style="margin-right:10px;">
      <a href="{{ route('courses.show', ['course' => $course->id]) }}" 
         style="{{ $currentRoute == 'courses.show' ? 'background:#337ab7; color:#fff; padding:10px 15px; border-radius:4px; display:block;' : 'padding:10px 15px; display:block;' }}">
         Course Home
      </a>
  </li>
  
  <li role="presentation" style="margin-right:10px;">
      <a href="{{ route('courses.contents', ['course_id' => $course->id])}}"
         style="{{ $currentRoute == 'courses.contents' ? 'background:#337ab7; color:#fff; padding:10px 15px; border-radius:4px; display:block;' : 'padding:10px 15px; display:block;' }}">
         Contents
      </a>
  </li>

  @if (Auth::check() && (Auth::user()->id == $course->user_id || Auth::user()->role_id < 3 )) 
    <li role="presentation">
        <a href="{{route('courses.subscribers', ['course_id' => $course->id])}}"
           style="{{ $currentRoute == 'courses.subscribers' ? 'background:#337ab7; color:#fff; padding:10px 15px; border-radius:4px; display:block;' : 'padding:10px 15px; display:block;' }}">
           Subscribers
        </a>
    </li>
  @endif
</ul>
</div>

<div class="content" >

    <h2 style="margin-top: 25px; margin-bottom: 20px;">{{ $course->title }} - Subscribers</h2>

    <div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Course</th>
                <th>Paid Date</th>
                <th>Expiry Date</th>
                <th>Plan</th>
                <th>Paid Amount</th>
                <th>Status</th>
                <th width="120">Action</th>
            </tr>
        </thead>

        <tbody>
        @forelse($courseUsers as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $course->title }}</td>
                <td>{{ $user->pivot->paid_date ? \Carbon\Carbon::parse($user->pivot->paid_date)->format('M d, Y') : '-' }}</td>
                <td>{{ $user->pivot->expiry_date ? \Carbon\Carbon::parse($user->pivot->expiry_date)->format('M d, Y') : '-' }}</td>
                <td>{{ ucfirst($user->pivot->plan ?? '-') }}</td>
                <td>${{ number_format($user->pivot->paid_amount ?? 0, 2) }}</td>
             
                <td>
    @if($user->pivot->status == 1)
        <span class="badge badge-success">Active</span>
    @else
        <span class="badge badge-secondary">Inactive</span>
    @endif
</td>
              <td class="text-nowrap">
    {{-- View --}}
    <a href="{{ route('users.show', $user->id) }}"
       class="btn btn-info btn-sm"
       title="View User">
        <i class="fas fa-eye"></i>
    </a>

    {{-- Delete --}}
    <form action="{{ route('courses.unsubscribe', ['course_id' => $course->id, 'user_id' => $user->id]) }}"
          method="POST"
          style="display:inline-block;"
          onsubmit="return confirm('Remove this subscriber from course?')">
        @csrf
        @method('DELETE')

        <button type="submit"
                class="btn btn-danger btn-sm"
                title="Remove">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</td>
            </tr>
        @empty
            <tr>
                <td colspan="9" class="text-center">No subscribers found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    </div>

</div>

@endsection
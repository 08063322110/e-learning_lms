<!-- Sub Title Field -->
<div class="form-group col-md-12">
    {{-- <p>{!! $course->sub_title !!}</p> --}}
    <div class="text-muted col-md-6">
        @if($course->subscriber_count > 0)
            | Students : {{ number_format($course->subscriber_count) }}
        @endif
        @if($course->view_count > 0)
             Views : {{ number_format($course->view_count) }}
        @endif
    </div>
</div>

{{-- @include('courses.menu') --}}
 
{{-- <!-- Created At Field -->
<div class="form-group col-md-6">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $course->created_at->format('h:i a - D d M Y') !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-md-6">
    {!! Form::label('updated_at', 'Last Updated:') !!}
    <p>{!! $course->updated_at->format('h:i a - D d M Y') !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group col-md-6">
    {!! Form::label('user_id', 'Author:') !!}
    <p><a href="/users/{{ $course->user['id'] }}"> {!! $course->user['name'] !!}</a></p>
</div>

<!-- Category Id Field -->
<div class="form-group col-md-6">
    {!! Form::label('category_id', 'Category :') !!}
    <p><a href="/categories/{{ $course->category['id'] }}">{{ $course->category['name'] }}</a></p>
</div>  --}}
{{-- 
<!-- Creator Status Field -->
<div class="form-group col-md-6">
    {!! Form::label('creator_status', 'Creator Status:') !!}
    <p>{{ $course->creator_status == 1 ? 'Published' : 'Unpublished' }}</p>
    @if($course->creator_status == 0)
        <a href="{{ url('courses/'.$course->id.'/publish') }}" class="btn btn-xs btn-success"><i class="fa fa-upload"></i> Click to Publish</a>
    @endif
</div>

<!-- Admin Status Field -->
<div class="form-group col-md-6">
    {!! Form::label('admin_status', 'Admin Status:') !!}
    <p>{{ $course->admin_status == 1 ? 'Approve' : 'Pending' }}</p>
    @if($course->admin_status == 1)
        <a href="{{ url('courses/'.$course->id.'/disapprove') }}" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Click to Disapprove</a>
    @endif
</div> --}}

{{-- BUY SECTION - Only show if NOT subscribed --}}
@if(empty($getSubscription))
    {{-- HIDE EVERYTHING FOR NON-SUBSCRIBERS --}}
    {{-- Nothing will show here --}}

@else
    {{-- Show this when person HAS paid/subscribed --}}
    <div class="form-group col-md-12">
        <div class="row" style="margin-bottom:30px;">
            <div class="col-md-8 col-md-offset-2">
                <a href="{{ route('courses.contents', $course->id) }}" class="btn btn-lg btn-primary btn-block">
                    <i class="fa fa-play-circle"></i> Start Learning
                </a>
            </div>
        </div>
    </div>
@endif {{-- THIS CLOSES THE BUY SECTION --}}
<!-- Description Field -->
<div class="form-group col-md-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $course->description !!}</p>
</div>

<!-- About Instructor Field -->
<div class="form-group col-md-12">
    {!! Form::label('about_instructor', 'About Instructor:') !!}
    <p>{!! $course->about_instructor !!}</p>
</div>

<!-- Tags Field -->
<div class="form-group col-md-12">
    {!! Form::label('tags', 'Tags:') !!}
    <p>{!! $course->tags !!}</p>
</div>

<!-- What Will Students Learn Field -->
<div class="form-group col-md-12">
    {!! Form::label('what_will_students_learn', 'What Will Students Learn:') !!}
    <p>{!! $course->what_will_students_learn !!}</p>
</div>

<!-- Target Students Field -->
<div class="form-group col-md-12">
    {!! Form::label('target_students', 'Target Students:') !!}
    <p>{!! $course->target_students !!}</p>
</div>

<!-- Requirements Field -->
<div class="form-group col-md-12">
    {!! Form::label('requirements', 'Requirements:') !!}
    <p>{!! $course->requirements !!}</p>
</div>
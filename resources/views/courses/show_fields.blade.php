<!-- Title Field -->
<div class="form-group col-xs-12">
    <h2>{!! $course->title !!}</h2>  
    <p>{{ $course->sub_title }}
        <div class="text-muted">
            @if ($course->subscriber_count>0)
            | students : {{ number_format($course->subscriber_count) }}
            @endif   
            @if ($course->subscriber_count>0)
            | views : {{ number_format($course->view_count) }}
            @endif 
        </div>
    </p>

</div>

@if (Auth::user()->role_id < 3  || Auth::user()->id == $course->user_id)
    

<!-- Creator Status Field -->
<div class="col-md-5">
    {!! Form::label('creator_status', 'Creator Status:') !!}
    <p>
        @if($course->creator_status == 1)
             on
        @else
             off
        @endif
    </p>
</div>

<!-- Admin Status Field -->
<div class="col-sm-7">
    {!! Form::label('admin_status', 'Admin Status:') !!}
    <p>
           @if($course->admin_status == 1)
             on
        @else
             off
        @endif
    </p>
</div>
@endif

<!-- User Id Field -->
<div class="col-md-5">
    {!! Form::label('user_id', 'Author:') !!}
    <p>{{ $course->user['name'] }}</p>
</div>

<!-- Category Id Field -->
<div class="col-md-5">
    {!! Form::label('category_id', 'Category:') !!}
    <p><a href="/categories/{!! $course->category['id'] !!}">{{ $course->category['name']}}</a></p>
</div>

{{-- Updated at Field --}}
<div class="col-md-5">
    {!! Form::label('updated_at', 'Last Updated:') !!}
    <p>{{ $course->updated_at }}</p>
</div>

{{-- Created at Field --}}
<div class="col-md-5">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $course->created_at }}</p>
</div>
<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $course->description }}</p>
</div>

<!-- About Instructor Field -->
<div class="col-md-8">
    {!! Form::label('about_instructor', 'About Instructor:') !!}
    <p>{{ $course->about_instructor }}</p>
</div>



<!-- Tags Field -->
<div class="col-md-8">
    {!! Form::label('tags', 'Tags:') !!}
    <p>{{ $course->tags }}</p>
</div>



<!-- Promo Video Url Field -->
{{-- <div class="col-sm-12">
    {!! Form::label('promo_video_url', 'Promo Video Url:') !!}
    <p>{{ $course->promo_video_url }}</p>
</div> --}}

<!-- Playlist Url Field -->
{{-- <div class="col-sm-12">
    {!! Form::label('playlist_url', 'Playlist Url:') !!}
    <p>{{ $course->playlist_url }}</p>
</div> --}}



<!-- What Will Students Learn Field -->
<div class="col-md-8">
    {!! Form::label('what_will_students_learn', 'What Will Students Learn:') !!}
    <p>{{ $course->what_will_students_learn }}</p>
</div>

 <!-- Target Students Field -->

<div class="col-md-8">
    {!! Form::label('target_students', 'Target Students:') !!}
    <p>{{ $course->target_students }}</p>
</div>

<!-- Requirements Field -->
<div class="col-md-8">
    {!! Form::label('requirements', 'Requirements:') !!}
    <p>{{ $course->requirements }}</p>
</div>

<!-- Discount Price Field -->
<div class="col-sm-12">
    {!! Form::label('discount_price', 'Discount Price:') !!}
    <p>{{ $course->discount_price }}</p>
</div>

<!-- Actual Price Field -->
<div class="col-sm-12">
    {!! Form::label('actual_price', 'Actual Price:') !!}
    <p>{{ $course->actual_price }}</p>
</div>



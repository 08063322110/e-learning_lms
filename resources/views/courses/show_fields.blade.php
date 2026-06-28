{{-- Course Title + Subtitle --}}
<div class="col-md-12 mb-4">
    <h1 class="font-weight-bold">{{ $course->title }}</h1>
    <p class="lead text-muted">Laravel Way</p>
</div>

{{-- 3 COLUMNS ROW - EQUAL SPACING LEFT/RIGHT/BETWEEN --}}
<div class="row mb-4 justify-content-between px-5">
    
    {{-- Column 1: Created + Author + Creator Status --}}
    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('created_at', 'Created At:') !!}
            <p>{{ $course->created_at->format('h:i a - D d M Y') }}</p>
        </div>

        <div class="mb-3">
            {!! Form::label('user_id', 'Author:') !!}
            <p><a href="/users/{{ $course->user['id'] }}">{{ $course->user['name'] }}</a></p>
        </div>

        <div>
            {!! Form::label('creator_status', 'Creator Status:') !!}
            <p>
                @if($course->creator_status == 1)
                    Published
                    {!! Form::open(['route' => ['courses.unpublishCourse', $course->id],'method' => 'post', 'class' => 'mt-1']) !!}   
                        <input type="hidden" name="course_id" value="{{$course->id}}">
                        {!! Form::button('<i class="far fa-trash-alt"></i> Click to Unpublish', ['type' => 'submit','class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure you want to Unpublish?')"]) !!}
                    {!! Form::close() !!}
                @else
                    Unpublished 
                    {!! Form::open(['route' => ['courses.publishCourse', $course->id],'method' => 'post', 'class' => 'mt-1']) !!}       
                        <input type="hidden" name="course_id" value="{{$course->id}}">
                        {!! Form::button('<i class="fa fa-upload"></i> Click to Publish', ['type' => 'submit','class' => 'btn btn-success btn-xs', 'onclick' => "return confirm('Are you sure you want to Approve?')"]) !!}
                    {!! Form::close() !!}
                @endif
            </p>
        </div>
    </div>

    {{-- Column 2: Updated + Category + Admin Status --}}
    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('updated_at', 'Last Updated:') !!}
            <p>{{ $course->updated_at->format('h:i a - D d M Y') }}</p>
        </div>

        <div class="mb-3">
            {!! Form::label('category_id', 'Category:') !!}
            <p><a href="/categories/{{ $course->category['id'] }}">{{ $course->category['name'] }}</a></p>
        </div>

        <div>
            {!! Form::label('admin_status', 'Admin Status:') !!}
            <p>
                @if($course->admin_status == 1)
                    Approved
                    @if(Auth::user()->role_id < 3)
                        |
                        {!! Form::open(['route' => ['courses.disapprove', $course->id],'method' => 'post', 'class' => 'd-inline mt-1']) !!}   
                            <input type="hidden" name="course_id" value="{{$course->id}}">
                            {!! Form::button('<i class="far fa-trash-alt"></i> Click to Disapprove', ['type' => 'submit','class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure want to Disapprove?')"]) !!}
                        {!! Form::close() !!}
                    @endif
                @else
                    Disapproved 
                    @if(Auth::user()->role_id < 3)
                        |
                        {!! Form::open(['route' => ['courses.approve', $course->id],'method' => 'post', 'class' => 'd-inline mt-1']) !!}       
                            <input type="hidden" name="course_id" value="{{$course->id}}">
                            {!! Form::button('<i class="fa fa-check"></i> Click to Approve', ['type' => 'submit','class' => 'btn btn-success btn-xs', 'onclick' => "return confirm('Are you sure want to Approve?')"]) !!}
                        {!! Form::close() !!}
                    @endif
                @endif
            </p>
        </div>
    </div>

    {{-- Column 3: Price --}}
    <div class="col-md-3">
        <h2 class="font-weight-bold">#80 <small class="text-muted"><s>#100</s></small></h2>
        <input type="email" class="form-control mb-2" value="simsi@gmail.com">
        <button class="btn btn-success btn-block">Pay Now</button>
        <p class="text-center small text-muted mt-2">24-hour Money-back Guarantee</p>
    </div>
</div>

{{-- Description Field - BACK TO ORIGINAL POSITION --}}
<div class="col-md-12 mb-4">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $course->description }}</p>
</div>

{{-- Other full-width fields --}}
<div class="col-md-8">
    {!! Form::label('what_will_students_learn', 'What Will Students Learn:') !!}
    <p>{{ $course->what_will_students_learn }}</p>
</div>
 
<div class="col-md-8">
    {!! Form::label('target_students', 'Target Students:') !!}
    <p>{{ $course->target_students }}</p>
</div>
 
<div class="col-md-8">
    {!! Form::label('requirements', 'Requirements:') !!}
    <p>{{ $course->requirements }}</p>
</div>
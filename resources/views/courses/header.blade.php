
<!-- Title Field -->
<div class="form-group">
    {!! Form::label('') !!}
    <h1><strong>{{ $course->title }}</strong></h1>
</div>

<!-- Sub Title Field -->
<div class="form-group">
    {!! Form::label('') !!}
   <h6 <p class="text-muted "style="margin-top: -40px;" >{{ $course->sub_title }}</p></h6>
</div>
            @include('courses.menu')

{{-- 3 COLUMNS ROW - EQUAL SPACING LEFT/RIGHT/BETWEEN --}}
<div class="row mb-4 justify-content-between px-5 "style="margin-top: 40px;" " >
    
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
                    Approve
                    @if(Auth::user()->role_id < 3)
                        
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
@if(empty($getSubscription))
<div class="col-md-3">
    <h2 class="font-weight-bold">#{{ $course->discount_price }} <small class="text-muted"><s>#{{ $course->actual_price }}</s></small></h2>
    
    <form action="{{ route('pay') }}" method="POST">
        @csrf
        <div class="form-group">
            <input 
                type="email" 
                name="email" 
                class="form-control" 
                placeholder="Enter valid email" 
                value="{{ Auth::check() ? Auth::user()->email : old('email') }}"
                required
            >
        </div>

        <input type="hidden" name="amount" value="{{ $course->discount_price * 100 }}">
        <input type="hidden" name="metadata" value='{"course_id": "{{ $course->id }}"}'>
        <input type="hidden" name="reference" value="course_{{ $course->id }}_{{ time() }}">
        <input type="hidden" name="currency" value="NGN">
        
        <button class="btn btn-success btn-block">
            <i class="fa fa-plus-circle"></i> Pay Now!
        </button>
    </form>
    
    <p class="text-center small text-muted mt-2">24-hour money-back guarantee.</p>
</div>
@endif
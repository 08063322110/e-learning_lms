{{-- //header was removed from here --}}

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
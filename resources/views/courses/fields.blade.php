@if(Auth::user()->role_id < 3)
<!-- Admin Status Field -->
<div class="form-group col-sm-6">
<label for="admin_status">Admin Status:</label>
<select class="form-control" name="admin_status" id="admin_status">
    <option value="1" {{ old('admin_status', $course->admin_status ?? 0) == 1 ? 'selected' : '' }}>on</option>
    <option value="0" {{ old('admin_status', $course->admin_status ?? 0) == 0 ? 'selected' : '' }}>off</option>
</select>
</div>
@endif

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control','maxlength' => 191]) !!}
</div>

<div class="form-group col-sm-6">
  <label for="category_id">Category</label>
  <select class="form-control" id="category_id" name="category_id">
    <option value="">Select Category</option>
    @foreach ($categories as $category)
        <option value="{{ $category->id }}" 
            {{ old('category_id', $course->category_id ?? '') == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
        </option>
    @endforeach
  </select>
</div>

<!-- Sub Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sub_title', 'Sub Title:') !!}
    {!! Form::text('sub_title', null, ['class' => 'form-control','maxlength' => 191]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-8">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- About Instructor Field -->
<div class="form-group col-sm-12 col-lg-8">
    {!! Form::label('about_instructor', 'About Instructor:') !!}
    {!! Form::textarea('about_instructor', null, ['class' => 'form-control']) !!}
</div>

<!-- Playlist Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('playlist_url', 'Playlist Url:') !!}
    {!! Form::text('playlist_url', null, ['class' => 'form-control','maxlength' => 191]) !!}
</div>

<!-- Tags Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tags', 'Tags:(separated with comma)') !!}
    {!! Form::text('tags', null, ['class' => 'form-control','maxlength' => 191]) !!}
</div>

<!-- Photo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('photo', 'Photo:') !!}
    {!! Form::text('photo', null, ['class' => 'form-control','maxlength' => 191]) !!}
</div>

<!-- Promo-Video Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('promo_video_url', 'Promo-Video Url:') !!}
    {!! Form::text('promo_video_url', null, ['class' => 'form-control','maxlength' => 191]) !!}
</div>

<!-- What Will Students Learn Field -->
<div class="form-group col-sm-12 col-lg-8">
    {!! Form::label('what_will_students_learn', 'What Will Students Learn:') !!}
    {!! Form::textarea('what_will_students_learn', null, ['class' => 'form-control']) !!}
</div>

<!-- Target Students Field -->
<div class="form-group col-sm-12 col-lg-8">
    {!! Form::label('target_students', 'Target Students:') !!}
    {!! Form::textarea('target_students', null, ['class' => 'form-control']) !!}
</div>

<!-- Requirements Field -->
<div class="form-group col-sm-12 col-lg-8">
    {!! Form::label('requirements', 'Requirements:') !!}
    {!! Form::textarea('requirements', null, ['class' => 'form-control']) !!}
</div>

<!-- Discount Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('discount_price', 'Discount Price:') !!}
    {!! Form::number('discount_price', null, ['class' => 'form-control']) !!}
</div>

<!-- Actual Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('actual_price', 'Actual Price:') !!}
    {!! Form::number('actual_price', null, ['class' => 'form-control']) !!}
</div>

<!-- Creator Status Field -->
<div class="form-group col-sm-6">
<label for="creator_status">Creator Status:</label>
<select class="form-control" name="creator_status" id="creator_status">
    <option value="1" {{ old('creator_status', $course->creator_status ?? 0) == 1 ? 'selected' : '' }}>on</option>
    <option value="0" {{ old('creator_status', $course->creator_status ?? 0) == 0 ? 'selected' : '' }}>off</option>
</select>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
    <a href="{!!route('courses.index')!!}" class="btn btn-default">Cancel</a>
</div>
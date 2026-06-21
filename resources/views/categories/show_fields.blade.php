
<!-- View Count Field -->
<div class="col-sm-12 small text-muted text-right">
    {!! Form::label('view_count', 'Page View Count:') !!} {{ $category->view_count }}
</div>

<h1 class="mt-0">{{$category->name}} </h1>

<!-- Description Field -->
<div class="col-sm-12">
    <p>{{ $category->description }}</p>
</div>

{{-- Created at field --}}
<div class="col-sm-12 small text-muted">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $category->created_at->format('h:m a - D d M Y') !!}</p>
</div>

{{-- Updated at field --}}
<div class="col-sm-12 small text-muted">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $category->updated_at->format('h:m a - D d M Y') !!}</p>
</div>
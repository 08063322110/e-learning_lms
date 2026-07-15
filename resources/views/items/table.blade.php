<h2 class="col-md-8 text-center">Course Contents</h2>

<div class="text-right col-md-12">
    <a class="btn btn-lg btn-primary" 
    href="{{route('items.create', ['course_id' => $course->id ]) }}">
        <i class="glyphicon glyphicon-plus"></i>
        Add Item</a>
</div>

    <table class="table table-responsive" id="items-table">

        <thead>
            <tr>
            <th></th>
            <th width= "10%"></th>
            </tr>
        </thead>
        <tbody>

        @foreach($course->items as $item)
            <tr>
                {{-- $item->url --}}
                <td data-toggle="modal" data-target="#modal-default">
     <h3 data-google="modal" data-target="modal-default">
        <a href="{{ route('courses.items', ['course_id' => $course->id, 'item_id' => $item->id]) }}"> {{ $item->title }}</a>                    
    </h3>

                    <div class="text-muted">{{$item->view_count}} views</div>
                    {{$item->description}}
                </td>
                <td>
                    @if(Auth::check() AND (Auth::user()->role_id < 3 || Auth::user()->id == $course->id))
                    {{Form::open(['route' => ['items.destroy', $item->id], 'method'=> 'delete']) }}
                    <div class="btn-group">
    <a href="{{ route('items.edit', [$item->id]) }}" class="btn btn-default btn-xs">
        <i class="glyphicon glyphicon-edit"></i>
    </a>

    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger'
    ]) !!}
</div>
     {{Form::close() }}
                    @endif
                </td>
            </tr>
            @endforeach

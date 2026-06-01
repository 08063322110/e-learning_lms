
{{--  {!! Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('categories.show', [$category->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('categories.edit', [$category->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!} --}}


<div class="card-columns">

      @foreach($categories as $category)

  <div class="card">
  <img class="card-img-top" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22239%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20239%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_19e7dd6db76%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A12pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_19e7dd6db76%22%3E%3Crect%20width%3D%22239%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2288.75390625%22%20y%3D%2295.1%22%3E239x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E">
  <div class="card-body">
    <h5 class="card-title">{{ $category->name }}</h5>

    <p class="card-text">{{ \Illuminate\Support\Str::limit($category->description, 120, '...') }}</p>
    
    <ul class="list-group list-group-flush">
        <small class="text-muted">Views: {!! number_format($category->view_count) !!}</small>
    </ul>
  </div>
  
  
  <div class="card-footer">
     {!! Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'delete']) !!}
                    <div class='btn-group'></div>
       <a href="{{ route('categories.show', [$category->id]) }}" class="btn btn-primary mr-4">View Category</a>

        @if(Auth::user()->role_id < 3)

        <a href="{{ route('categories.edit', [$category->id]) }}" class='btn btn-default mr-2'><i class="far fa-edit"></i></a>
    {!! Form::button('<i class="glyphicon glyphicon trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger ', 'onclick' => "return confirm('Are you sure?')"]) !!}
        @endif
  </div>
    {!! Form::close() !!}
</div>

 @endforeach
</div>

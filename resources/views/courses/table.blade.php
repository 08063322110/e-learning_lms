<div class="table-responsive">
    <table class="table" id="courses-table">
        <thead>
        <tr>
           
        <th>Title</th>
        <th>Discount Price</th>
        <th>Actual Price</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($courses as $course)
            <tr>
            <td>{{ $course->photo }}</td>
            <td><h2>{{ $course->title }}</h2></br> 
               {{ $course->sub_title }} 
                </td>
            <td>{{ $course->promo_video_url }}</td>
            <td>{{ $course->discount_price }}</td>
            <td>{{ $course->actual_price }}</td>
           
            <td width="120">
                    {!! Form::open(['route' => ['courses.destroy', $course->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('courses.show', [$course->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('courses.edit', [$course->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
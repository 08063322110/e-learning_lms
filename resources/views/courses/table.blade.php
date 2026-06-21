<div class="table-responsive">
    <table class="table" id="courses-table">
        <thead >
            <tr >
                <th class="text-right" colspan="120">Action</th>
            </tr>
        </thead>

        <tbody>
        @foreach($courses as $course)
            <tr>
                <td>{{ $course->photo }}</td>

                <td width="80%">
                    <h4 style="margin-bottom: -10px;">
                        <a href="{{ route('courses.show', [$course->id]) }}">
                            {{ $course->title }}
                        </a>
                    </h4>

                    <br>

    Author: {{ optional($course->user)->name ?? 'Unknown Author' }} 
            @if ($course->subscriber_count>0)
            | students : {{ number_format($course->subscriber_count) }}
            @endif   
            @if ($course->subscriber_count>0)
            | views : {{ number_format($course->view_count) }}
            @endif 
            </div>
          
                {!!$course->sub_title!!}   
                </td>

                <td>
                    <h3 style="margin-bottom: -10px;">
                        ${{ $course->discount_price }}
                    </h3>
                    <del style="text-decoration: line-through; padding-left: 10px">
                        ${{ $course->actual_price }}
                    </del>
                </td>

                <td width="120">

                  @if(Auth::check() AND (Auth::user()->role_id < 3
                 || $course->user_id == Auth::user()->id))

                    {!! Form::open([
                        'route' => ['courses.destroy', $course->id],
                        'method' => 'delete'
                    ]) !!}

                    <div class="btn-group">
                        <a href="{{ route('courses.show', [$course->id]) }}"
                           class="btn btn-default btn-xs">
                            <i class="far fa-eye"></i>
                        </a>

                        <a href="{{ route('courses.edit', [$course->id]) }}"
                           class="btn btn-default btn-xs">
                            <i class="far fa-edit"></i>
                        </a>

                        {!! Form::button(
                            '<i class="far fa-trash-alt"></i>',
                            [
                                'type' => 'submit',
                                'class' => 'btn btn-success btn-xs',
                                'onclick' => "return confirm('Are you sure want to Approve?')"
                            ]
                        ) !!}
                    </div>

                    {!! Form::close() !!}
                    @endif
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
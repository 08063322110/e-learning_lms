<div class="table-responsive">
    <table class="table" id="users-table">
       
        <thead>
        <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Gender</th>
        <th>Amount</th>
        </thead>

        <tbody>
        @foreach($course->users as $user)
            <tr>
            <td>{{ $user->name }}</td>
            
            <td>
            <a href="{{ route('users.show', [$user->id]) }}">
                {{ $user->email }}
            </a>
            </td>

            <td>{{ $user->gender }}</td>
            <td>$ {{ $user->pivot->paid_amount }}</td>
     
                <td width="120">
                            @if(Auth::check() AND Auth::user()->role_id < 3) 

                    {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('users.show', [$user->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('users.edit', [$user->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
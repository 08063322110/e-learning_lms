<h2 class="col-md-8 text-center">Course Contents</h2>
<div class="col-md-10">
<div class="table-responsive">
    <table class="table" id="items-table">
        <thead>
        <tr>
        {{-- <th>Url</th> --}}
        <th>Description</th>
        <th>Views</th>
        <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($course->items as $item)
            <tr>
            {{-- <td>{{ $item->url }}</td> --}}
            <td>
            <h3>{{ $item->title }}</h3>
                {{ $item->description }}</td>
            <td>{{ $item->view_count }}</td>

            
                <td width="120">
                    {!! Form::open(['route' => ['items.destroy', $item->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('items.show', [$item->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('items.edit', [$item->id]) }}"
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
</div>
<div class="box box-primary">
    <div class="box-body table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>Paid Date</th>
                    <th>Expiry Date</th>
                    <th>Plan</th>
                    <th>Paid Amount</th>
                    <th>Status</th>
                    <th width="150">Action</th>
                </tr>
            </thead>
            <tbody>
            @forelse($courseUsers as $courseUser)
                <tr>
                    <td>{{ $courseUser->user->name ?? '-' }}</td>
                    <td>{{ $courseUser->user->email ?? '-' }}</td>
                    <td>{{ $courseUser->course->title ?? '-' }}</td>
                    <td>{{ $courseUser->paid_date ? $courseUser->paid_date->format('d M Y') : '-' }}</td>
                    <td>{{ $courseUser->expiry_date ? $courseUser->expiry_date->format('d M Y') : '-' }}</td>
                    <td><span class="label label-info">{{ ucfirst($courseUser->plan) }}</span></td>
                    <td><strong>#{{ number_format($courseUser->paid_amount, 2) }}</strong></td>
                    <td>
                        @if($courseUser->status)
                            <span class="label label-success">Active</span>
                        @else
                            <span class="label label-danger">Inactive</span>
                        @endif
                    </td>
                    <td>
                        {!! Form::open(['route' => ['courseUsers.destroy', $courseUser->id], 'method' => 'delete', 'style' => 'display:inline']) !!}
                        <div class='btn-group btn-group-sm'>
                            <a href="{{ route('courseUsers.show', [$courseUser->id]) }}" class='btn btn-info' title="View">
                               <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{ route('courseUsers.edit', [$courseUser->id]) }}" class='btn btn-warning' title="Edit">
                               <i class="fa fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="fa fa-trash"></i>', [
                                'type' => 'submit',
                                'class' => 'btn btn-danger',
                                'title' => 'Delete',
                                'onclick' => "return confirm('Are you sure you want to delete this subscription?')"
                            ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No subscriptions found</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
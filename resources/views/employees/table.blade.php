<table class="table table-responsive" id="employees-table">
    <thead>
        <tr>
            <th>{{ __('messages.id') }}</th>
            <th>{{ __('messages.name') }}</th>
            <th>{{ __('messages.email') }}</th>
            <th>{{ __('messages.phone_number') }}</th>
            <th>{{ __('messages.address') }}</th>
            <th>{{ __('messages.date') }}</th>
            <th>{{ __('messages.salary') }}</th>
            <th>{{ __('messages.day_work') }}</th>
            <th>{{ __('messages.over_time') }}</th>
            <th colspan="3">{{ __('messages.action') }}</th>
        </tr>
    </thead>
    <tbody>
    @foreach($employees as $employee)
        <tr>
            <td>{!! $employee->id !!}</td>
            <td>{!! $employee->name !!}</td>
            <td>{!! $employee->email !!}</td>
            <td>{!! $employee->phonenumber !!}</td>
            <td>{!! $employee->address !!}</td>
            <td>{!! $employee->date !!}</td>
            <td>{!! $employee->salary !!}</td>
            <td>{!! $employee->day_work !!}</td>
            <td>{!! $employee->over_time !!}</td>
            <td>
                {!! Form::open(['route' => ['employees.destroy', $employee->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('employees.edit', [$employee->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
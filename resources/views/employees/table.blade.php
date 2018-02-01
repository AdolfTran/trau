<table class="table table-responsive" id="employees-table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Date</th>
            <th>Salary</th>
            <th>Day work</th>
            <th>Over time</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($employees as $employee)
        <tr>
            <td>{!! $employee->id !!}</td>
            <td>{!! $employee->name !!}</td>
            <td>{!! $employee->phone_number !!}</td>
            <td>{!! $employee->address !!}</td>
            <td>{!! $employee->date !!}</td>
            <td>{!! $employee->salary !!}</td>
            <td>{!! $employee->day_work !!}</td>
            <td>{!! $employee->over_time !!}</td>
            <td>
                {!! Form::open(['route' => ['employees.destroy', $employee->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('employees.show', [$employee->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('employees.edit', [$employee->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<table class="table table-responsive" id="machines-table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Date</th>
            <th>Status</th>
            <th>Ip</th>
            <th>Sale Place</th>
            <th>Code</th>
            <th>Price</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($machines as $machine)
        <tr>
            <td>{!! $machine->id !!}</td>
            <td>{!! $machine->name !!}</td>
            <td>{!! $machine->date !!}</td>
            <td>{!! $machine->status !!}</td>
            <td>{!! $machine->ip !!}</td>
            <td>{!! $machine->sale_place !!}</td>
            <td>{!! $machine->code !!}</td>
            <td>{!! $machine->price !!}</td>
            <td>
                {!! Form::open(['route' => ['machines.destroy', $machine->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('machines.show', [$machine->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('machines.edit', [$machine->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<table class="table table-responsive" id="homes-table">
    <thead>
        <tr>
            <th>Id</th>
        <th>Name</th>
        <th>Pc</th>
        <th>Nhietdo</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($homes as $home)
        <tr>
            <td>{!! $home->id !!}</td>
            <td>{!! $home->name !!}</td>
            <td>{!! $home->pc !!}</td>
            <td>{!! $home->nhietdo !!}</td>
            <td>
                {!! Form::open(['route' => ['homes.destroy', $home->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('homes.show', [$home->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('homes.edit', [$home->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
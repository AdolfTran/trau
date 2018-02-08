<table class="table table-responsive" id="machineTypes-table">
    <thead>
        <tr>
            <th>{!! __('messages.id') !!}</th>
            <th>{!! __('messages.name') !!}</th>
        <th>Price</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($machineTypes as $machineType)
        <tr>
            <td>{!! $machineType->id !!}</td>
            <td>{!! $machineType->name !!}</td>
            <td>{!! $machineType->price !!}</td>
            <td>
                {!! Form::open(['route' => ['machineTypes.destroy', $machineType->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
{{--                    <a href="{!! route('machineTypes.show', [$machineType->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    <a href="{!! route('machineTypes.edit', [$machineType->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
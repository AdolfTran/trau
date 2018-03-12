<table class="table table-responsive" id="customers-table">
    <thead>
    <tr>
        <th>{{ __('messages.id') }}</th>
        <th>{{ __('messages.amount_of_money') }}</th>
        <th>{{ __('messages.description') }}</th>
        <th>{{ __('messages.date_cost') }}</th>
        <th>{{ __('messages.people') }}</th>
        <th colspan="3">{{ __('messages.action') }}</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
    @foreach($costs as $cost)
        <tr>
            <td>{!! $i++ !!}</td>
            <td>{!! $cost->amount_money !!}</td>
            <td>{!! $cost->description !!}</td>
            <td>{!! $cost->date !!}</td>
            <td>{!! $cost->people !!}</td>
            <td>
                {!! Form::open(['route' => ['cost.destroy', $cost->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('cost.edit', [$cost->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
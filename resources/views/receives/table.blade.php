<table class="table table-responsive" id="receives-table">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ __('messages.amount_of_money') }}</th>
            <th>{{ __('messages.date') }}</th>
            <th>{{ __('messages.sender') }}</th>
            <th>{{ __('messages.receiver') }}</th>
            <th>{{ __('messages.description') }}</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
    @foreach($receives as $receive)
        <tr>
            <td>{!! $i++ !!}</td>
            <td>{!! $receive->amount_money !!}</td>
            <td>{!! $receive->date !!}</td>
            <td>{!! $receive->sender !!}</td>
            <td>{!! $receive->receiver !!}</td>
            <td>{!! $receive->description !!}</td>
            <td>
                {!! Form::open(['route' => ['receives.destroy', $receive->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
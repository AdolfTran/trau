<table class="table table-responsive" id="customers-table">
    <thead>
        <tr>
            <th>{{ __('messages.id') }}</th>
            <th>{{ __('messages.name') }}</th>
            <th>{{ __('messages.address') }}</th>
            <th>{{ __('messages.phone_number') }}</th>
            <th>{{ __('messages.email') }}</th>
            <th>{{ __('messages.contract_siging_date') }}</th>
            <th colspan="3">{{ __('messages.action') }}</th>
        </tr>
    </thead>
    <tbody>
    @foreach($customers as $customer)
        <tr>
            <td>{!! $customer->id !!}</td>
            <td>{!! $customer->name !!}</td>
            <td>{!! $customer->address !!}</td>
            <td>{!! $customer->phonenumber !!}</td>
            <td>{!! $customer->email !!}</td>
            <td>{!! $customer->date !!}</td>
            <td>
                {!! Form::open(['route' => ['customers.destroy', $customer->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('customers.edit', [$customer->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    <?php if(Auth::user() &&  Auth::user()->role == 1){ ?>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    <?php } ?>
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
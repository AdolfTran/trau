<div class="col-xs-6">
    <!-- Name Field -->
    <div class="form-group">
        {!! Form::label('name', __('messages.name') . ':') !!}
        <p>{!! $customer['name'] !!}</p>
    </div>

    <!-- Address Field -->
    <div class="form-group">
        {!! Form::label('address', __('messages.address') . ':') !!}
        <p>{!! $customer['address'] !!}</p>
    </div>

    <!-- Phonenumber Field -->
    <div class="form-group">
        {!! Form::label('phonenumber', __('messages.phone_number') . ':') !!}
        <p>{!! $customer['phonenumber'] !!}</p>
    </div>
</div>
<div class="col-xs-6">
    <!-- Email Field -->
    <div class="form-group">
        {!! Form::label('email', __('messages.email') . ':') !!}
        <p>{!! $customer['email'] !!}</p>
    </div>

    <!-- Date Field -->
    <div class="form-group">
        {!! Form::label('date', __('messages.contract_siging_date') . ':') !!}
        <p>{!! $customer['date'] !!}</p>
    </div>
</div>
<div class="col-xs-12">
<hr>
<h5>
    {{ __('messages.list') }}
</h5>
    {{--<!-- name_machines Field -->--}}
    {{--<div class="form-group col-sm-6">--}}
        {{--{!! Form::label('name_machines', __('messages.name_machines') . ':') !!}--}}
        {{--{!! Form::text('name_machines', null, ['class' => 'form-control']) !!}--}}
    {{--</div>--}}

    {{--<!-- send_date Field -->--}}
    {{--<div class="form-group col-sm-6">--}}
        {{--{!! Form::label('send_date', __('messages.send_date') . ':') !!}--}}
         {{--{!! Form::text('send_date', null, ['class' => 'form-control']) !!}--}}
    {{--</div>--}}

    {{--<!-- status Field -->--}}
    {{--<div class="form-group col-sm-6">--}}
        {{--{!! Form::label('status', __('messages.type') . ':') !!}--}}
        {{--{!! Form::text('status', null, ['class' => 'form-control']) !!}--}}
    {{--</div>--}}

    {{--<!-- ip Field -->--}}
    {{--<div class="form-group col-sm-6">--}}
        {{--{!! Form::label('ip', __('messages.ip') . ':') !!}--}}
        {{--{!! Form::text('ip', null, ['class' => 'form-control']) !!}--}}
    {{--</div>--}}

    {{--<!-- sale_place Field -->--}}
    {{--<div class="form-group col-sm-6">--}}
        {{--{!! Form::label('sale_place', __('messages.sale_place') . ':') !!}--}}
        {{--{!! Form::text('sale_place', null, ['class' => 'form-control']) !!}--}}
    {{--</div>--}}

    {{--<!-- code Field -->--}}
    {{--<div class="form-group col-sm-6">--}}
        {{--{!! Form::label('code', __('messages.code') . ':') !!}--}}
        {{--{!! Form::text('code', null, ['class' => 'form-control']) !!}--}}
    {{--</div>--}}

    {{--<!-- send_price Field -->--}}
    {{--<div class="form-group col-sm-6">--}}
        {{--{!! Form::label('send_price', __('messages.send_price') . ':') !!}--}}
        {{--{!! Form::text('send_price', null, ['class' => 'form-control']) !!}--}}
    {{--</div>--}}
</div>

<div class="col-xs-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('customers.index') !!}" class="btn btn-default">Back</a>
</div>

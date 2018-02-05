<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('messages.name') . ':') !!}
    <p>{!! $customer['name'] !!}</p>
</div>

<!-- password Field -->
<div class="form-group">
    {!! Form::label('password', __('messages.password') . ':') !!}
    <p>{!! $_password !!}</p>
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


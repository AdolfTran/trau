<!-- Id Field -->

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('messages.name') . ':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', __('messages.email') . ":")  !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', __('messages.address') . ":")  !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<!-- Phonenumber Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phonenumber', __('messages.phone_number') . ":")  !!}
    {!! Form::number('phonenumber', null, ['class' => 'form-control']) !!}
</div>

<!-- Contract signing date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', __('messages.contract_siging_date') . ":") !!}
    {!! Form::text('date', null, ['class' => 'form-control', 'data-provide' => 'datepicker', 'data-date-format'=>'dd/mm/yyyy']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('customers.index') !!}" class="btn btn-default">Cancel</a>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('amount_money', __('messages.amount_of_money') . ':') !!}
    {!! Form::number('amount_money', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('months', __('messages.months') . ':') !!}
    {!! Form::text('months', null, ['class' => 'form-control', 'data-provide' => 'datepicker', 'data-date-format'=>'mm/yyyy']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('date', __('messages.date') . ':') !!}
    {!! Form::text('date', null, ['class' => 'form-control', 'data-provide' => 'datepicker', 'data-date-format'=>'dd/mm/yyyy']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('sender', __('messages.sender') . ':') !!}
    {!! Form::text('sender', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('receiver', __('messages.receiver') . ':') !!}
    {!! Form::text('receiver', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('description', __('messages.description') . ':') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('receives.index') !!}" class="btn btn-default">Cancel</a>
</div>

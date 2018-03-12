
<div class="form-group col-sm-6">
    {!! Form::label('amount_money', __('messages.amount_of_money') . ':') !!}
    {!! Form::number('amount_money', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('description', __('messages.description') . ":")  !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('date', __('messages.date_cost') . ":")  !!}
    {!! Form::text('date', null, ['class' => 'form-control', 'data-provide' => 'datepicker', 'data-date-format'=>'dd/mm/yyyy']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('people', __('messages.people') . ":")  !!}
    {!! Form::text('people', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('cost.index') !!}" class="btn btn-default">Cancel</a>
</div>

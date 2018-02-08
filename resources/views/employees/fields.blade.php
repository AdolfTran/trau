<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('messages.name') . ':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', __('messages.email') . ':') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phonenumber', __('messages.phone_number') . ':') !!}
    {!! Form::text('phonenumber', null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', __('messages.address') . ':') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', __('messages.date') . ':') !!}
    {!! Form::text('date', null, ['class' => 'form-control', 'data-provide' => 'datepicker', 'data-date-format'=>'dd/mm/yyyy']) !!}
</div>

<!-- Salary Field -->
<div class="form-group col-sm-6">
    {!! Form::label('salary', __('messages.salary') . ':') !!}
    {!! Form::text('salary', null, ['class' => 'form-control']) !!}
</div>

<!-- Day Work Field -->
<div class="form-group col-sm-6">
    {!! Form::label('day_work', __('messages.day_work') . ':') !!}
    {!! Form::number('day_work', null, ['class' => 'form-control']) !!}
</div>

<!-- Over time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('over_time', __('messages.over_time') . ':') !!}
    {!! Form::number('over_time', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('employees.index') !!}" class="btn btn-default">Cancel</a>
</div>

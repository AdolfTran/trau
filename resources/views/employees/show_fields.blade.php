<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('messages.id') . ':') !!}
    <p>{!! $employee->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('messages.name') . ':') !!}
    <p>{!! $employee->name !!}</p>
</div>

<!-- Phone Number Field -->
<div class="form-group">
    {!! Form::label('phone_number', __('messages.phone_number') . ':') !!}
    <p>{!! $employee->phone_number !!}</p>
</div>

<!-- Address Field -->
<div class="form-group">
    {!! Form::label('address', __('messages.address') . ':') !!}
    <p>{!! $employee->address !!}</p>
</div>


<!-- Date Field -->
<div class="form-group">
    {!! Form::label('date', __('messages.date') . ':') !!}
    <p>{!! $employee->date !!}</p>
</div>

<!-- Salary Field -->
<div class="form-group">
    {!! Form::label('salary', __('messages.salary') . ':') !!}
    <p>{!! $employee->salary !!}</p>
</div>

<!-- Day Work Field -->
<div class="form-group">
    {!! Form::label('day_work', __('messages.day_work') . ':') !!}
    <p>{!! $employee->day_work !!}</p>
</div>

<!-- Over time Field -->
<div class="form-group">
    {!! Form::label('over_time', __('messages.over_time') . ':') !!}
    <p>{!! $employee->over_time !!}</p>
</div>



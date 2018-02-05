<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('messages.name') . ':') !!}
    <p>{!! $employee['name'] !!}</p>
</div>

<!-- Phone Number Field -->
<div class="form-group">
    {!! Form::label('phonenumber', __('messages.phone_number') . ':') !!}
    <p>{!! $employee['phonenumber'] !!}</p>
</div>

<!-- Password Field -->
<div class="form-group">
    {!! Form::label('password', __('messages.password') . ':') !!}
    <p>{!! $_password !!}</p>
</div>

<!-- Address Field -->
<div class="form-group">
    {!! Form::label('address', __('messages.address') . ':') !!}
    <p>{!! $employee['address'] !!}</p>
</div>


<!-- Date Field -->
<div class="form-group">
    {!! Form::label('date', __('messages.date') . ':') !!}
    <p>{!! $employee['date'] !!}</p>
</div>

<!-- Salary Field -->
<div class="form-group">
    {!! Form::label('salary', __('messages.salary') . ':') !!}
    <p>{!! $employee['salary'] !!}</p>
</div>

<!-- Day Work Field -->
<div class="form-group">
    {!! Form::label('day_work', __('messages.day_work') . ':') !!}
    <p>{!! $employee['day_work'] !!}</p>
</div>

<!-- Over time Field -->
<div class="form-group">
    {!! Form::label('over_time', __('messages.over_time') . ':') !!}
    <p>{!! $employee['over_time'] !!}</p>
</div>



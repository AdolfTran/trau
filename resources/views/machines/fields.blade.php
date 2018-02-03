<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('messages.name') . ':') !!}
    {{--{!! Form::text('name', null, ['class' => 'form-control']) !!}--}}
    <p>{!! $machine->worker1 !!}</p>
</div>

<!-- User Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user', __('messages.user') . ':') !!}
    <select name="user_id" class="form-control">
        <?php foreach($users as $key=>$user){ ?>
            <option value="{!! $key !!}" {!! $key == $machine->user_id ? 'selected' : '' !!}>{!! $user !!}</option>
        <?php } ?>
    </select>
</div>

<!-- ip Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ip', __('messages.ip') . ':') !!}
{{--    {!! Form::text('ip', null, ['class' => 'form-control']) !!}--}}
    <p>{!! $machine->ip !!}</p>
</div>

<!-- type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', __('messages.type') . ':') !!}
    {{--{!! Form::text('type', null, ['class' => 'form-control']) !!}--}}
    <p>{!! $machine->type !!}</p>
</div>

<!-- pool1 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pool1', __('messages.pool1') . ':') !!}
{{--    {!! Form::text('ip', null, ['class' => 'form-control']) !!}--}}
    <p>{!! $machine->pool1 !!}</p>
</div>

<!-- hash_rate_5s Field -->
<div class="form-group col-sm-6">
    {!! Form::label('hash_rate_5s', __('messages.hash_rate_5s') . ':') !!}
{{--    {!! Form::text('sale_place', null, ['class' => 'form-control']) !!}--}}
    <p>{!! $machine->hash_rate_5s !!}</p>
</div>

<!-- temp Field -->
<div class="form-group col-sm-6">
    {!! Form::label('temp', __('messages.temp') . ':') !!}
{{--    {!! Form::text('code', null, ['class' => 'form-control']) !!}--}}
    <p>{!! $machine->temp !!}</p>
</div>

<!-- temp Field -->
<div class="form-group col-sm-6">
    {!! Form::label('temp', __('messages.temp') . ':') !!}
{{--    {!! Form::text('code', null, ['class' => 'form-control']) !!}--}}
    <p>{!! $machine->temp !!}</p>
</div>

<!-- elapsed Field -->
<div class="form-group col-sm-6">
    {!! Form::label('elapsed', __('messages.elapsed') . ':') !!}
{{--    {!! Form::number('price', null, ['class' => 'form-control']) !!}--}}
    <p>{!! $machine->elapsed !!}</p>
</div>

<!-- update_time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('update_time', __('messages.update_time') . ':') !!}
{{--    {!! Form::number('update_time', null, ['class' => 'form-control']) !!}--}}
    <p>{!! $machine->update_time ? $machine->update_time : 'N/A' !!}</p>
</div>

<!-- status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', __('messages.status') . ':') !!}
{{--    {!! Form::number('price', null, ['class' => 'form-control']) !!}--}}
    <p>{!! $machine->status !!}</p>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('machines.index') !!}" class="btn btn-default">Cancel</a>
</div>

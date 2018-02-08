<!-- Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('name', __('messages.name') . ':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-4">
    {!! Form::label('price', __('messages.price') . ':') !!}
    {!! Form::number('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('machineTypes.index') !!}" class="btn btn-default">Cancel</a>
</div>

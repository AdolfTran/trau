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
    <div class="form-group col-sm-6">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('employees.index') !!}" class="btn btn-default">Cancel</a>
    </div>
    <div class="form-group col-sm-6">
        <button type="button" id="resetPassword" class="btn btn-warning">{!! __('messages.reset_password') !!}</button>
    </div>
</div>
<div class="modal fade" id="modalShowPass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showPassLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body col-sm-12" id="contentShowPass">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_machines" data-dismiss="modal">{!! __('messages.close') !!}</button>
            </div>
        </div>
    </div>
</div>
@section('scripts')
    <script type="application/javascript">
        $("#resetPassword").click(function(){
            var _id = <?php echo json_encode($employee['id']) ?>;
            var r = confirm("Bạn chắc chắn muốn reset password?");
            if(r){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{!! route('resetPassword') !!}",
                    data: {
                        'id': _id
                    },
                    method: 'POST',
                    success: function (data) {
                        if(data !== undefined && data != 0){
                            $('#contentShowPass').html('Mật khẩu mới được thay đổi là:' + data);
                            $('#showPassLabel').html('Thay đổi mật khẩu thành công');
                            $('#modalShowPass').modal('show');
                        } else {
                            $('#contentShowPass').html('Quá trình thay đổi mật khẩu thất bại. Vui lòng thử lại');
                            $('#showPassLabel').html('Thay đổi mật khẩu thất bại');
                            $('#modalShowPass').modal('show');
                        }
                    }
                });
            }
        });
    </script>
@endsection

<div class="box box-primary" style="height: 150px; padding-top: 20px">
<div class="col-xs-3">
    <!-- Name Field -->
    <div class="form-group">
        {!! Form::label('name', __('messages.name') . ':') !!}
        <p>{!! $customer['name'] !!}</p>
    </div>

    <!-- Address Field -->
    <div class="form-group">
        {!! Form::label('address', __('messages.address') . ':') !!}
        <p>{!! $customer['address'] !!}</p>
    </div>
</div>
<div class="col-xs-3">
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
</div>
<div class="col-xs-3">
    <!-- Date Field -->
    <div class="form-group">
        {!! Form::label('date', __('messages.contract_siging_date') . ':') !!}
        <p>{!! $customer['date'] !!}</p>
    </div>
    <div class="form-group">
        {!! Form::label('code', __('messages.customer_code') . ':') !!}
        <p>{!! $customer['code'] !!}</p>
    </div>
</div>
<div class="col-xs-3">
    <button type="button" id="resetPassword" class="btn btn-warning">{!! __('messages.reset_password') !!}</button>
</div>
</div>

<div class="col-xs-12">
    <div class="col-xs-2">
        <h3 style="margin-top: 0px">
            {{ __('messages.list_machines') }}
        </h3>
    </div>
    <div class="col-xs-2" style="margin-left: -40px">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAddNew" style="margin-top: -5px;margin-left: -40px;">
            {!! __('messages.add_machines') !!}
        </button>
    </div>
</div>
<div class="box box-primary" style="overflow: scroll; max-height: 550px;margin-bottom: 0px;padding-bottom: 10px;">
<div class="col-xs-12">
<hr>
    <table class="table table-responsive" id="customer-devices-table">
        <thead>
        <tr>
            <th>#</th>
            <th>{!! __('messages.name') !!}</th>
            <th>{!! __('messages.date') !!}</th>
            <th>{!! __('messages.status') !!}</th>
            <th>{!! __('messages.ip') !!}</th>
            <th>{!! __('messages.sale_place') !!}</th>
            <th>{!! __('messages.code') !!}</th>
            <th>{!! __('messages.machines_type') !!}</th>
            <th>{!! __('messages.machine_number') !!}</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 1; ?>
        @foreach($machines as $machine)
            <tr id="m_{!! $machine->id !!}">
                <td>{!! $i++ !!}</td>
                <td>{!! $machine->name !!}</td>
                <td>{!! $machine->date !!}</td>
                <td>{!! $machine->status !!}</td>
                <td>{!! $machine->ip !!}</td>
                <td>{!! $machine->sale_place !!}</td>
                <td>{!! $machine->code !!}</td>
                <td data-id="{!! $machine->machine_type_id !!}">{!! $machine->machine_type_id && $machineTypes[$machine->machine_type_id] ? $machineTypes[$machine->machine_type_id] : '' !!}</td>
                <td>{!! $machine->machine_number !!}</td>
                <td data-id="{!! $machine->id !!}">
                    <div class='btn-group'>
                        <button type="button" class="btn btn-default btn-x edit_machines" data-toggle="modal" style="padding: 0px 4px;"><i class="glyphicon glyphicon-edit"></i></button>
                        <a class='btn btn-danger btn-xs delete_machines'><i class="glyphicon glyphicon-trash"></i></a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="modal fade" id="modalAddNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{!! __('messages.machines') !!}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body col-sm-12">
                <!-- name_machines Field -->
                <div class="form-group col-sm-6">
                    <label for="name_machines">{!! __('messages.name_machines') . '*:' !!}</label>
                    <input class="form-control" name="name_machines" type="text" id="name_machines">
                </div>

                <!-- send_date Field -->
                <div class="form-group col-sm-6">
                    <label for="send_date">{!! __('messages.send_date') . '*:' !!}</label>
                    <input class="form-control" name="send_date" type="text" id="send_date" data-provide = 'datepicker' data-date-format ='dd/mm/yyyy'>
                </div>

                <!-- status Field -->
                <div class="form-group col-sm-6">
                    <label for="status">{!! __('messages.status') . ':' !!}</label>
                    <input class="form-control" name="status" type="text" id="status">
                </div>

                <!-- ip Field -->
                <div class="form-group col-sm-6">
                    <label for="ip">{!! __('messages.ip') . ':' !!}</label>
                    <input class="form-control" name="ip" type="text" id="ip">
                </div>

                <!-- sale_place Field -->
                <div class="form-group col-sm-6">
                    <label for="sale_place">{!! __('messages.sale_place') . ':' !!}</label>
                    <input class="form-control" name="sale_place" type="text" id="sale_place" data-provide = 'datepicker' data-date-format ='dd/mm/yyyy'>
                </div>

                <!-- code Field -->
                <div class="form-group col-sm-6">
                    <label for="code">{!! __('messages.code') . ':' !!}</label>
                    <input class="form-control" name="code" type="text" id="code">
                </div>
                <!-- machine type Field -->
                <div class="form-group col-sm-6">
                    <label for="machine_type_id">{!! __('messages.machines_type') . '*:' !!}</label>
                    <input list="browsers" class="form-control" name="machine_type_id" id="machine_type_id">
                    <datalist id="browsers">
                        <?php foreach( $machineTypes as $key => $value ){ ?>
                            <option value="{!! $value !!}" data-id="{!! $key !!}">
                        <?php } ?>
                    </datalist>
                </div>
                <!-- code Field -->
                <div class="form-group col-sm-6">
                    <label for="machine_number">{!! __('messages.machine_number') . ':' !!}</label>
                    <input class="form-control" name="machine_number" type="text" id="machine_number">
                </div>
                <!-- hidden Field -->
                <input class="form-control" name="id" type="hidden" id="id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_machines" data-dismiss="modal">{!! __('messages.close') !!}</button>
                <button type="button" class="btn btn-primary" id="add_machines">{!! __('messages.add') !!}</button>
            </div>
        </div>
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
</div>
@section('scripts')
    <script type="application/javascript">
        document.querySelector('input[list="browsers"]').addEventListener('input', onInput);

        function onInput(e) {
            var input = e.target,
                val = input.value;
                options = document.getElementById('browsers').childNodes;

            for(var i = 0; i < options.length; i++) {
                if($(options[i]).val() === val) {
                    if($(options[i]).data('id') === undefined){
                        $('#machine_type_id').attr('data-id', "");
                    } else {
                        $('#machine_type_id').attr('data-id', $(options[i]).data('id'));
                    }
                    break;
                }
            }
        }

        $(document).ready(function() {
            var max_id = <?php echo json_encode($i-1); ?>;
            $('#add_machines').click(function(){
                var input = $('#modalAddNew').find('input');
                if($('#name_machines').val() == ""
                    || $('#send_date').val() == ""){
                    return false;
                }
                var data = [];
                var id = $('#id').val();
                if(id == "") {
                    var ip = $('#ip').val();
                    max_id = max_id + 1;
                    var _html = "<tr id='ip_" + ip + "'><td>"+max_id+"</td>";
                    $(input).each(function (_v, index) {
                        var key = $(index).attr('name');
                        var value = $(index).val();
                        var _value = value;
                        if(key == 'machine_type_id'){
                            _value = $(index).data('id');
                        }
                        data[key] = _value;
                        _html += "<td>" + value + "</td>";
                    });
                    data['id'] = "";
                    _html += "<td id='ip_" + ip + "'>\n" +
                        "<div class='btn-group'>\n" +
                        "<button type=\"button\" class=\"btn btn-default btn-x edit_machines\" data-toggle=\"modal\" style=\"padding: 0px 4px;\"><i class=\"glyphicon glyphicon-edit\"></i></button>\n" +
                        "<a href=\"\" class='btn btn-danger btn-xs delete_machines'><i class=\"glyphicon glyphicon-trash\"></i></a>\n" +
                        "</div>\n" +
                        "</td>";
                    _html += "</tr>";
                    $('#customer-devices-table tbody').append(_html);
                    $('#modalAddNew').modal('hide');
                    $(':input').val('');
                } else {
                    var _id = id.split('_');
                    if(_id.length = 1){
                        var td = $('#m_' + id).find('td');
                        $(td[1]).html($('#name_machines').val());
                        $(td[2]).html($('#send_date').val());
                        $(td[3]).html($('#status').val());
                        $(td[4]).html($('#ip').val());
                        $(td[5]).html($('#sale_place').val());
                        $(td[6]).html($('#code').val());
                        $(td[7]).html($('#machine_type_id').val());
                        $(td[8]).html($('#machine_number').val());
                        data['name_machines'] = $('#name_machines').val();
                        data['send_date'] = $('#send_date').val();
                        data['status'] = $('#status').val();
                        data['ip'] = $('#ip').val();
                        data['sale_place'] = $('#sale_place').val();
                        data['code'] = $('#code').val();
                        data['machine_type_id'] = $('#machine_type_id').data('id');
                        data['send_price'] = $('#send_price').val();
                        data['machine_number'] = $('#machine_number').val();
                        data['id'] = id;
                    }
                    $('#modalAddNew').modal('hide');
                    $(':input').val('');
                }

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{!! route('addMachines') !!}",
                    data: {
                        'code': data.code,
                        'ip': data.ip,
                        'name': data.name_machines,
                        'sale_place': data.sale_place,
                        'date': data.send_date,
                        'status': data.status,
                        'id': data.id,
                        'machine_type_id': data.machine_type_id,
                        'machine_number': data.machine_number,
                        'user_id': "{!! $customer['id'] !!}"
                    },
                    method: 'POST',
                });
            });

            $('.edit_machines').click(function () {
                var input = $($(this).parent().parent().parent()['0']).find('td');
                $('#name_machines').val($(input[1]).html());
                $('#send_date').val($(input[2]).html());
                $('#status').val($(input[3]).html());
                $('#ip').val($(input[4]).html());
                $('#sale_place').val($(input[5]).html());
                $('#code').val($(input[6]).html());
                $('#machine_type_id').val($(input[7]).html());
                $('#machine_number').val($(input[8]).html());
                $('#machine_type_id').attr("data-id",$(input[9]).data('id'));
                $('#id').val($(input[9]).data('id'));
                $('#modalAddNew').modal('show');
            });
            $('.close_machines').click(function (){
                $(':input').val('');
            });
            $('.delete_machines').click(function () {
                var id = $($(this).parent().parent()).data('id');
                max_id = max_id - 1;
                $($(this).parent().parent().parent()['0']).remove();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{!! route('removeMachines') !!}",
                    data: {
                        'data':id
                    },
                    method: 'POST',
                });
            });
        });
        $("#resetPassword").click(function(){
            var _id = <?php echo json_encode($customer['id']) ?>;
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
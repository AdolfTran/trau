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
    <div class="col-xs-2">
        <select class="form-control" id="search_date">
            @if(!empty($listDate))
                @foreach($listDate as $_listDate)
                    <option {!! $_m == $_listDate ? "selected" : "" !!} value="{!! $_listDate !!}">{!! $_listDate !!}</option>
                @endforeach
            @else
                <option value="{!! date('m/Y') !!}">{!! date('m/Y') !!}</option>
            @endif
        </select>
    </div>
    <div class="col-xs-4">
        <a style="color: red" href="{!! route('showReceive', $id) !!}">
        {!! __("messages.so_tien_can_thanh_toan") !!} {!! !empty($totalMoney) && $totalMoney > 0 ? number_format($totalMoney, 2, ",", " ") : 0  !!} VND
        </a>
    </div>
</div>
<div class="box box-primary" style="overflow: scroll; max-height: 550px;margin-bottom: 0px;padding-bottom: 10px;">
<div class="col-xs-12">
<hr>
    <table class="table table-responsive" id="customer-devices-table">
        <thead>
        <tr class="main_table">
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
        <?php $i = 1;
            $loaiThanhToan = [
              '1' => 'Thu tiền',
              '2' => 'Phụ thu',
              '3' => 'Hoàn tiền máy off'
            ];
        ?>
        @foreach($machines as $machine)
            <tr class="main_table" id="m_{!! $machine->id !!}">
                <td>{!! $i++ !!}</td>
                <td>{!! $machine->name !!}</td>
                <td>{!! $machine->date !!}</td>
                <td>{!! $machine->status !!}</td>
                <td>{!! $machine->ip !!}</td>
                <td>{!! $machine->sale_place !!}</td>
                <td>{!! $machine->code !!}</td>
                <td data-id="{!! $machine->machine_type_id !!}">{!! $machine->machine_type_id && !empty($machineTypes[$machine->machine_type_id]) ? $machineTypes[$machine->machine_type_id] : '' !!}</td>
                <td>{!! $machine->machine_number !!}</td>
                <td data-id="{!! $machine->id !!}">
                    <div class='btn-group'>
                        <button type="button" data-money="{!! !empty($machine->machine_type_id) && !empty($listPrice[$machine->machine_type_id]) ? $listPrice[$machine->machine_type_id] : 0 !!}"
                                data-id="{!! $machine->id !!}" class="btn btn-default btn-x add_money" data-target="#modalAddMoney" data-toggle="modal" style="padding: 0px 4px;"><i class="glyphicon glyphicon-plus-sign"></i></button>
                        <button type="button" class="btn btn-default btn-x edit_machines" data-toggle="modal" style="padding: 0px 4px;"><i class="glyphicon glyphicon-edit"></i></button>
                        <a class='btn btn-danger btn-xs delete_machines'><i class="glyphicon glyphicon-trash"></i></a>
                    </div>
                </td>
            </tr>
            <tbody id="div_sub_table_{!! $machine->id !!}">
                <tr class="sub_table sub_table_{!! $machine->id !!}" style="{!! !empty($listReceives) && !empty($listReceives[$machine->id]) ? "" : "display:none" !!}">
                    <th></th>
                    <th>Số giờ</th>
                    <th>Số tiền</th>
                    <th>Cho tháng</th>
                    <th>Ngày gửi</th>
                    <th>Người gửi</th>
                    <th>Người nhận</th>
                    <th>Ghi chú</th>
                    <th>Loại thanh toán</th>
                    <th colspan="3">Action</th>
                </tr>
            <?php $total = 0;
                if(!empty($listPrice) && !empty($machine->machine_type_id) && !empty($listPrice[$machine->machine_type_id])){
                    $total += $listPrice[$machine->machine_type_id];
                }
            ?>
            @if(!empty($listReceives) && !empty($listReceives[$machine->id]))
                @foreach($listReceives[$machine->id] as $listReceive)
                    <tr class="sub_table sub_table_{!! $machine->id !!}">
                        <td></td>
                        <td>{!! $listReceive->hours !!}</td>
                        <td data-money="{!! $listReceive->amount_money !!}" id="money_{!! $listReceive->id !!}">{!! number_format($listReceive->amount_money, 2, ",", " ") !!} VND</td>
                        <?php
                            if($listReceive->tralai == 3){

                                $total -= $listReceive->amount_money;
                            } else {

                                $total += $listReceive->amount_money;
                            }
                        ?>
                        <td>{!! $listReceive->months !!}</td>
                        <td>{!! $listReceive->date !!}</td>
                        <td>{!! $listReceive->sender !!}</td>
                        <td>{!! $listReceive->receiver !!}</td>
                        <td>{!! $listReceive->description !!}</td>
                        <td>{!! $loaiThanhToan[$listReceive->tralai] !!}</td>
                        <td data-id="{!! $listReceive->id !!}" data-parent="{!! $machine->id !!}" data-tralai="{!! $listReceive->tralai !!}">
                            <div class='btn-group'>
                                <a class='btn btn-danger btn-xs delete_receives'><i class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
            <tr id="div_total_{!! $machine->id !!}">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Total</td>
                <td colspan="5"><span class="total_{!! $machine->id !!}">{!! number_format($total, 2, ",", " ") !!}</span> VND</td>
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
                    <h5 class="modal-title"></h5>
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

<div class="modal fade" id="modalAddMoney" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thanh toán</h5>
            </div>
            <div class="modal-body col-sm-12">
                <div class="form-group col-sm-6">
                    <label for="name_machines">Trả lại</label>
                    <select class="form-control" name="tralai" id="receives_tralai">
                        <option value="2">Phụ thu</option>
                        <option value="3">Hoàn tiền máy off</option>
                    </select>
                </div>
                <div class="form-group col-sm-6" id="input_hours" style="display: none">
                    <label for="name_machines">Số giờ</label>
                    <input class="form-control" name="hours" type="text" id="receives_hours">
                </div>
                <div class="form-group col-sm-6">
                    <label for="name_machines">Số tiền*</label>
                    <input class="form-control" name="amount_money" type="number" id="receives_amount_money">
                </div>
                <div class="form-group col-sm-6">
                    <label for="name_machines">Cho tháng*</label>
                    <input class="form-control" name="months" type="text" id="receives_months" data-provide = 'datepicker' data-date-format ='mm/yyyy'>
                </div>
                <div class="form-group col-sm-6">
                    <label for="name_machines">Ngày</label>
                    <input class="form-control" name="date" type="text" id="receives_date" data-provide = 'datepicker' data-date-format ='dd/mm/yyyy'>
                </div>
                <div class="form-group col-sm-6">
                    <label for="name_machines">Người gửi</label>
                    <input class="form-control" name="sender" type="text" id="receives_sender">
                </div>
                <div class="form-group col-sm-6">
                    <label for="name_machines">Người thu</label>
                    <input class="form-control" name="receiver" type="text" id="receives_receiver">
                </div>
                <div class="form-group col-sm-6">
                    <label for="name_machines">Ghi chú</label>
                    <input class="form-control" name="description" type="text" id="receives_description">
                </div>
                <input class="form-control" name="customer_devices_id" type="hidden" id="customer_devices_id">
                <input class="form-control" type="hidden" id="receives_money">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_money" data-dismiss="modal">{!! __('messages.close') !!}</button>
                <button type="button" class="btn btn-primary" id="add_money">{!! __('messages.add') !!}</button>
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
                    var _html = "<tr class='main_table' id='ip_" + ip + "'><td>"+max_id+"</td>";
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
                    $('#customer-devices-table tbody:last').append(_html);
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
                    success: function(data) {
                        location.reload();
                    }
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
                if(!confirm('Chắc chắn muốn xóa máy này?')){
                    return false;
                }
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
                    success: function(data) {
                        location.reload();
                    }
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

        $(document).ready(function(){
            $('.add_money').click(function(){
                $('#customer_devices_id').val($(this).data('id'));
                $('#receives_money').val($(this).data('money'));
            });
           $('#add_money').click(function (){
               var amount_money = $('#receives_amount_money').val();
               var months = $('#receives_months').val();
               var date = $('#receives_date').val();
               var sender = $('#receives_sender').val();
               var receiver = $('#receives_receiver').val();
               var description = $('#receives_description').val();
               var tralai = $('#receives_tralai').val();
               var customer_devices_id = $('#customer_devices_id').val();
               var insertId = 0;
               var hours = 0;
               if(tralai == 3){
                   hours = $('#receives_hours').val();
               }
               $.ajax({
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                   url: "{!! route('addReceives') !!}",
                   data: {
                       'amount_money': amount_money,
                       'months': months,
                       'date': date,
                       'sender': sender,
                       'receiver': receiver,
                       'description': description,
                       'tralai': tralai,
                       'customer_devices_id': customer_devices_id,
                       'hours': hours,
                       'user_id': "{!! $customer['id'] !!}"
                   },
                   method: 'POST',
                   success: function (data) {
                       insertId = data;
                   }
               });
               $('#receives_amount_money').val('');
               $('#receives_months').val('');
               $('#receives_date').val('');
               $('#receives_sender').val('');
               $('#receives_receiver').val('');
               $('#receives_description').val('');
               $('#modalAddMoney').modal('hide');
               // add row vao table.
               var _html = "<tr><td></td>";
               _html +=
                   "<td>"+hours+"</td>" +
                   "<td>"+ number_format(amount_money, 2, ",", " ") +" VND</td>" +
                   "<td>"+months+"</td>" +
                   "<td>"+date+"</td>" +
                   "<td>"+sender+"</td>" +
                   "<td>"+receiver+"</td>" +
                   "<td>"+description+"</td>";
                   if(tralai == 1){
                       _html += "<td>Thu tiền</td>";
                   } else if (tralai == 2)  {
                       _html += "<td>Phụ thu</td>";
                   } else {

                       _html += "<td>Hoàn tiền máy off</td>";
                   }
               _html += "<td id='ip_"+insertId+"'>\n" +
                   "<div class='btn-group'>\n" +
                   "<a href=\"\" class='btn btn-danger btn-xs delete_receives'><i class=\"glyphicon glyphicon-trash\"></i></a>\n" +
                   "</div>\n" +
                   "</td>";
               _html += "</tr>";
               var div = $('#div_sub_table_' + customer_devices_id).find('tr');
               if(div.length == 1) {
                   $('.sub_table_' + customer_devices_id).css("display", "");
               }
               $('#div_sub_table_' + customer_devices_id).append(_html);
               var totalMoney = $('span.total_' + customer_devices_id).text();

               totalMoney = totalMoney.replace(',', '.').replace(/ /g, '');
               if(tralai == 3){

                   totalMoney = parseFloat(parseFloat(totalMoney) - parseFloat(amount_money)).toFixed(2);
               } else {

                   totalMoney = parseFloat(parseFloat(totalMoney) + parseFloat(amount_money)).toFixed(2);
               }
               $('span.total_' + customer_devices_id).text(number_format(totalMoney, 2, ",", " "));
           });
            $('.delete_receives').click(function () {
                if(!confirm('Chắc chắn muốn xóa máy này?')){
                    return false;
                }
                var id = $($(this).parent().parent()).data('id');
                var parent_id = $($(this).parent().parent()).data('parent');
                var tralai = $($(this).parent().parent()).data('tralai');
                var money = $('#money_' +id).data('money');
                var totalMoney = $('span.total_' + parent_id).text();
                totalMoney = totalMoney.replace(',', '.').replace(/ /g, '');
                if(tralai == 3){

                    totalMoney = parseFloat(parseFloat(totalMoney) + parseFloat(money)).toFixed(2);
                } else {

                    totalMoney = parseFloat(parseFloat(totalMoney) - parseFloat(money)).toFixed(2);
                }
                $('span.total_' + parent_id).text(number_format(totalMoney, 2, ",", " "));
                $($(this).parent().parent().parent()['0']).remove();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{!! route('removeReceives') !!}",
                    data: {
                        'data':id
                    },
                    method: 'POST',
                });
            });
            $('#receives_tralai').on('change', function(){
               if($('#receives_tralai').val() == 3){
                   $('#receives_amount_money').prop('disabled', true);
                   $('#input_hours').css('display', 'block');
               } else {
                   $('#receives_amount_money').prop('disabled', false);
                   $('#input_hours').css('display', 'none');
               }
            });

            $('#receives_hours').on('change', function(){
                var money = $('#receives_money').val();
                var hours = $('#receives_hours').val();
                var _money = money/30.5/24 * hours;
                $('#receives_amount_money').val(parseFloat(_money).toFixed(2));
            });
            $('#search_date').change(function(){
                window.location.replace('{!! route('addCustomers', [$customer->id]) !!}?date=' + $(this).val());
            });
        });

        function number_format(number, decimals, dec_point, thousands_sep) {
            // +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
            // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
            // +     bugfix by: Michael White (http://getsprink.com)
            // +     bugfix by: Benjamin Lupton
            // +     bugfix by: Allan Jensen (http://www.winternet.no)
            // +    revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
            // +     bugfix by: Howard Yeend
            // +    revised by: Luke Smith (http://lucassmith.name)
            // +     bugfix by: Diogo Resende
            // +     bugfix by: Rival
            // +      input by: Kheang Hok Chin (http://www.distantia.ca/)
            // +   improved by: davook
            // +   improved by: Brett Zamir (http://brett-zamir.me)
            // +      input by: Jay Klehr
            // +   improved by: Brett Zamir (http://brett-zamir.me)
            // +      input by: Amir Habibi (http://www.residence-mixte.com/)
            // +     bugfix by: Brett Zamir (http://brett-zamir.me)
            // +   improved by: Theriault
            // +   improved by: Drew Noakes
            // *     example 1: number_format(1234.56);
            // *     returns 1: '1,235'
            // *     example 2: number_format(1234.56, 2, ',', ' ');
            // *     returns 2: '1 234,56'
            // *     example 3: number_format(1234.5678, 2, '.', '');
            // *     returns 3: '1234.57'
            // *     example 4: number_format(67, 2, ',', '.');
            // *     returns 4: '67,00'
            // *     example 5: number_format(1000);
            // *     returns 5: '1,000'
            // *     example 6: number_format(67.311, 2);
            // *     returns 6: '67.31'
            // *     example 7: number_format(1000.55, 1);
            // *     returns 7: '1,000.6'
            // *     example 8: number_format(67000, 5, ',', '.');
            // *     returns 8: '67.000,00000'
            // *     example 9: number_format(0.9, 0);
            // *     returns 9: '1'
            // *    example 10: number_format('1.20', 2);
            // *    returns 10: '1.20'
            // *    example 11: number_format('1.20', 4);
            // *    returns 11: '1.2000'
            // *    example 12: number_format('1.2000', 3);
            // *    returns 12: '1.200'
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                toFixedFix = function (n, prec) {
                    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
                    var k = Math.pow(10, prec);
                    return Math.round(n * k) / k;
                },
                s = (prec ? toFixedFix(n, prec) : Math.round(n)).toString().split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

    </script>
@endsection
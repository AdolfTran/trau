<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="col-lg-12">
    <div class="col-lg-6">
        <span> Số tiền phải nộp tháng {{ date('m/Y', strtotime(now())) }}: {!! isset($revenueMonth) ? number_format("$revenueMonth",0,",",".") : 0 !!} VND</span>
    </div>
    <div class="col-lg-6">
        <span>Tổng số tiền phải trả: {!! isset($totalMoney) ? number_format("$totalMoney",0,",",".") : 0 !!} VND</span>
    </div>
</div>
<table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;padding:0;margin:0 auto;background-color:#ebebeb;font-size:14px; text-align: center">
    <thead style="background: #ddd; font-size: 16px;">
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
            <td data-id="{!! $machine->machine_type_id !!}">{!! $machine->machine_type_id && !empty($types[$machine->machine_type_id]) ? $types[$machine->machine_type_id] : '' !!}</td>
            <td>{!! $machine->machine_number !!}</td>
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
        <td colspan="2"><span class="total_{!! $machine->id !!}">{!! number_format($total, 2, ",", " ") !!}</span> VND</td>
    </tr>
    @endforeach
    </tbody>
</table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="/js/app.js"></script>
</body>
</html>
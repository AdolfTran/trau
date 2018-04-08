@extends('layouts.app')

@section('content')
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h4>{!! isset($revenueMonth) ? number_format("$revenueMonth",0,",",".") : 0 !!} VND</h4>
                        <p>{{ __('messages.expected_amount_of_month_x') . date('m/Y', strtotime(now())) }}</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <a href="{!! url('') !!}/customers" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h4>{!! isset($totalMoney) ? number_format("$totalMoney",0,",",".") : 0 !!} VND</h4>
                        <p>{{ __('messages.total_money_you_have_to_pay_x') . date('m/Y', strtotime(now())) }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">{{ __('messages.machine_statistics') }}</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <table class="table table-striped">
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>{{ __('messages.type') }}</th>
                                    <th style="width: 80px">{{ __('messages.number') }}</th>
                                </tr>

                                <?php $i = 1; ?>
                                @foreach($listMachines as $_name => $_number)
                                    <?php
                                    if($i % 4 == 1){
                                        $_class = 'red';
                                    } elseif ($i % 4 == 2){
                                        $_class = 'yellow';
                                    } elseif ($i % 4 == 3) {
                                        $_class = 'blue';
                                    } else {
                                        $_class = 'green';
                                    }
                                    ?>
                                    <tr>
                                        <td>{!! $i++ !!}</td>
                                        <td>{!! $_name !!}</td>
                                        <td style="text-align: center"><span class="badge bg-{!! $_class !!}">{!! $_number !!}</span></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
        <h4>Danh sách máy</h4>
        <div class="row box box-primary">
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
        </div>
        <h4>Lịch sử nạp tiền</h4>
        <div class="row box box-primary">
            <table class="table table-responsive" id="customer-devices-table">
                <thead>
                <?php $i =1; ?>
                <tr class="main_table">
                    <th>#</th>
                    <th>Số tiền</th>
                    <th>Tháng</th>
                    <th>Ngày nạp</th>
                    <th>Người nạp</th>
                    <th>Người thu</th>
                    <th>Ghi chú</th>
                </tr>
                </thead>
                <tbody>
                @foreach($listNapTien as $_listNapTien)
                    <tr>
                        <td>{!! $i++ !!}</td>
                        <td>{!! number_format($_listNapTien->amount_money, 2, ",", " ") !!} VND</td>
                        <td>{!! $_listNapTien->months !!}</td>
                        <td>{!! $_listNapTien->date !!}</td>
                        <td>{!! $_listNapTien->sender !!}</td>
                        <td>{!! $_listNapTien->receiver !!}</td>
                        <td>{!! $_listNapTien->description !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

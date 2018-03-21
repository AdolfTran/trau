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
    </div>
@endsection

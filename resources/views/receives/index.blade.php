@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Lich sử nạp tiền của {!! $name !!}</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! url('') !!}/receives/add/{!! $id !!}">Nạp tiền</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('receives.table')
            </div>
        </div>
        <div class="text-center">
            <a  style="float:left" href="{!! url('') !!}/customers/add/{!! $id !!}" class="btn btn-default">Quay lại</a>
        </div>
    </div>
@endsection


@extends('layouts.app')

@section('content')
    <section class="content-header" style="height: 40px">
        <h1>
            {{ __('messages.customers') }}
        </h1>
    </section>
    <div class="content">
        {{--<div class="box box-primary">--}}
            <div class="box-body" style="overflow: hidden">
                <div class="row">
                    @include('machines.show_fields')
                </div>
            </div>
        {{--</div>--}}
        <div class="col-xs-12">
            <div class="col-xs-10">
                &nbsp;
            </div>
            <div class="col-xs-2">
                <button class="btn btn-primary" id="save_machines" style="margin-left: 80px;">{!! __('messages.save') !!}</button>
                <a href="{!! route('customers.index') !!}" class="btn btn-default">{!! __('messages.back') !!}</a>
            </div>
        </div>
    </div>
@endsection

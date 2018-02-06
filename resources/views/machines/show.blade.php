@extends('layouts.app')

@section('content')
    <section class="content-header" style="height: 40px">
        <div class="col-xs-12">
            <div class="col-xs-10" style="margin-top: -20px;">
            <h1>
                {{ __('messages.customers') }}
            </h1>
            </div>
            <div class="col-xs-2">
            <button class="btn btn-primary" id="save_machines">Save</button>
            <a href="{!! route('customers.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('machines.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection

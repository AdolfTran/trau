@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ __('messages.customers') }}
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    {!! Form::model($customer, ['route' => ['machines.update', $customer->id], 'method' => 'patch']) !!}
                    @include('machines.show_fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

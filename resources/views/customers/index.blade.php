@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">{{ __('messages.customers') }}</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('customers.create') !!}">{{ __('messages.add_new') }}</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">

                <form class="example" action="{!! url('') !!}/customers">
                    <input type="text" class="search_btn" name="search" placeholder="Search.." value="{!! !empty($search) ? $search : '' !!}">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
                    @include('customers.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection


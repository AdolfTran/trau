@extends('layouts.app')

@section('content')
    <section class="content-header" style="height: 40px">
        <h1>
            {{ __('messages.customers') }}
        </h1>
    </section>
    <div class="content">
        <div class="box-body" style="overflow: hidden">
            <div class="row">
                @include('machines.show_fields')
            </div>
        </div>
    </div>
@endsection

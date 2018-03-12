@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ __('messages.cost') }}
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::model($cost, ['route' => ['cost.update', $cost->id], 'method' => 'patch']) !!}

                    @include('cost.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
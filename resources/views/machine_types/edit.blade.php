@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {!! __('messages.machines_type') !!}
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($machineType, ['route' => ['machineTypes.update', $machineType->id], 'method' => 'patch']) !!}

                        @include('machine_types.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
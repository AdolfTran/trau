@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Machine
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($machine, ['route' => ['machines.update', $machine->id], 'method' => 'patch']) !!}

                        @include('machines.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
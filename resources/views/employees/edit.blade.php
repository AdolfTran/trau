@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ __('messages.employees') }}
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body" style="overflow: hidden">
               <div class="row">
                   {!! Form::model($employee, ['route' => ['employees.update', $employee->id], 'method' => 'patch']) !!}

                        @include('employees.edit_fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
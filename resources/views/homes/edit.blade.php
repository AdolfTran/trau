@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Home
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($home, ['route' => ['homes.update', $home->id], 'method' => 'patch']) !!}

                        @include('homes.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
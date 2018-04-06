@extends('layouts.app')

@section('content')
   <div class="content">
       @include('adminlte-templates::common.errors')

       <section class="content-header">
           <h1>
               Danh sách thay đổi loại máy
           </h1>
       </section>
       <div class="box box-primary">
           <div class="box-body">
               <table class="table table-responsive" id="machineTypes-table">
                   <thead>
                   <tr>
                       <th>{!! __('messages.id') !!}</th>
                       <th>{!! __('messages.name') !!}</th>
                       <th>Price</th>
                       <th>Cho tháng</th>
                   </tr>
                   </thead>
                   <tbody>
                   @foreach($lists as $list)
                       <tr>
                           <td>{!! $list->id !!}</td>
                           <td>{!! $list->name !!}</td>
                           <td>{!! $list->price !!}</td>
                           <td>{!! $list->date !!}</td>
                       </tr>
                   @endforeach
                   </tbody>
               </table>
           </div>
       </div>

       <section class="content-header">
           <h1>
               {!! __('messages.machines_type') !!}
           </h1>
       </section>
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($machineType, ['route' => ['machineTypes.update', $machineType->id], 'method' => 'patch']) !!}

                        @include('machine_types.field')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
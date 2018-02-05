@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">{{ __('messages.machines') }}</h1>
        {{--<h1 class="pull-right">--}}
           {{--<a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('machines.create') !!}">Add New</a>--}}
        {{--</h1>--}}
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('machines.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

@section('scripts')
    <script type="application/javascript">
        $(document).ready(function() {
            var dataTable = $('#machines-table').DataTable({
                "processing": false,
                // "serverSide": true,
                "paging": false,
                "searching": false,
                // "bInfo" : false,
                "bDestroy": true,
                "ordering": true,
                "order": [[ 4, "desc" ]],
                "sZeroRecords":":|",
                "ajax":{
                    url :"data_json"
                },
                "createdRow": function ( row, data, index ) {
                    if (data[9] == 'SUCCESS' ) {
                        if (data[4] < 13000 ) {
                            $('td', row).addClass('highlight-warning');
                        }else {
                            $('td', row).addClass('highlight-ok');
                        }
                    }else {
                        $('td', row).addClass('highlight-failed');
                    }

                    var arr = data[5].split('|');
                    arr.sort();
                    $('td', row).eq(5).text(arr.length);
                    $('td', row).eq(6).text(arr[arr.length-1]);
                },
                // "columnDefs": [{
                //     "targets": 10,
                //     "data": null,
                //     "defaultContent": "<a class='btn btn-default btn-xs' data-type='edit'><i class=\"glyphicon glyphicon-edit\"></i></a>" +
                //     "<a class='btn btn-danger btn-xs' data-type='delete'><i class=\"glyphicon glyphicon-trash\"></i></a>"
                // }]
            });

            setInterval(function(){
                dataTable.ajax.reload();
            }, 60000);

            $('#machines-table tbody').on( 'click', 'a', function () {
                var data = dataTable.row( $(this).parents('tr') ).data();
                var id = data[10] ? data[10] : null;
                var type = $(this).data("type");
                if(type == 'view'){
                    window.location.href = "/machines/" + id;
                } else if(type == 'delete'){
                    var r = confirm("Are you sure?");
                    if (r == true) {
                        console.log(1);
                        window.location.href = "/deleted/" + id;
                    }
                } else {
                    window.location.href = "/machines/" + id + '/edit';
                }
            } );
        } );
    </script>
@endsection


<table class="table table-responsive" id="homes-table">
    <thead>
        <tr>
            <th>worker1</th>
            <th>ip</th>
            <th>type</th>
            <th>pool1</th>
            <th>hash_rate_5s</th>
            <th>temp</th>
            <th>temp</th>
            <th>elapsed</th>
            <th>update_time</th>
            <th>status</th>
            {{--<th colspan="3">Action</th>--}}
        </tr>
    </thead>
    <tbody>
    @foreach($homes as $home)
        <tr>
            <td>{!! $home->worker1 !!}</td>
            <td>{!! $home->ip !!}</td>
            <td>{!! $home->type !!}</td>
            <td>{!! $home->pool1 !!}</td>
            <td>{!! $home->hash_rate_5s !!}</td>
            <td>{!! $home->temp !!}</td>
            <td>{!! $home->temp !!}</td>
            <td>{!! $home->elapsed !!}</td>
            <td>{!! $home->update_time !!}</td>
            <td>{!! $home->status !!}</td>
            {{--<td>--}}
                {{--{!! Form::open(['route' => ['homes.destroy', $home->id], 'method' => 'delete']) !!}--}}
                {{--<div class='btn-group'>--}}
                    {{--<a href="{!! route('homes.show', [$home->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    {{--<a href="{!! route('homes.edit', [$home->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>--}}
                    {{--{!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}--}}
                {{--</div>--}}
                {{--{!! Form::close() !!}--}}
            {{--</td>--}}
        </tr>
    @endforeach
    </tbody>
</table>
{{--<?php if(Auth::user() &&  Auth::user()->role == 1){ ?>--}}
{{--<li class="{{ Request::is('homes*') ? 'active' : '' }}">--}}
    {{--<a href="{!! route('homes.index') !!}"><i class="fa fa-edit"></i><span>{!! __('messages.home') !!}</span></a>--}}
{{--</li>--}}
{{--<?php } ?>--}}

<li class="{{ Request::is('machines*') ? 'active' : '' }}">
    <a href="{!! route('machines.index') !!}"><i class="fa fa-edit"></i><span>{!! __('messages.a_machines') !!}</span></a>
</li>

<li class="{{ Request::is('pc*') ? 'active' : '' }}">
    <a href="#"><i class="fa fa-edit"></i><span>{!! __('messages.a_pc') !!}</span></a>
</li>

<?php if(Auth::user() &&  (Auth::user()->role == 1 || Auth::user()->role == 2)){ ?>
<li class="{{ Request::is('machineTypes*') ? 'active' : '' }}">
    <a href="{!! route('machineTypes.index') !!}"><i class="fa fa-edit"></i><span>{!! __('messages.a_machines_type') !!}</span></a>
</li>
<li class="{{ Request::is('customers*') ? 'active' : '' }}">
    <a href="{!! route('customers.index') !!}"><i class="fa fa-edit"></i><span>{!! __('messages.a_customers') !!}</span></a>
</li>
<?php } ?>

<?php if(Auth::user() &&  Auth::user()->role == 1){ ?>
<li class="{{ Request::is('employees*') ? 'active' : '' }}">
    <a href="{!! route('employees.index') !!}"><i class="fa fa-edit"></i><span>{!! __('messages.a_employees') !!}</span></a>
</li>
<?php } ?>

<li class="{{ Request::is('revenue*') ? 'active' : '' }}">
    <a href="#"><i class="fa fa-edit"></i><span>{!! __('messages.a_revenue') !!}</span></a>
</li>

<li class="{{ Request::is('items*') ? 'active' : '' }}">
    <a href="#"><i class="fa fa-edit"></i><span>{!! __('messages.a_items') !!}</span></a>
</li>

<li class="{{ Request::is('report*') ? 'active' : '' }}">
    <a href="#"><i class="fa fa-edit"></i><span>{!! __('messages.a_report') !!}</span></a>
</li>

<li class="{{ Request::is('order*') ? 'active' : '' }}">
    <a href="#"><i class="fa fa-edit"></i><span>{!! __('messages.a_order') !!}</span></a>
</li>


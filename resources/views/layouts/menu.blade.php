<li class="{{ Request::is('/') ? 'active' : '' }}">
    <a href="{!! url('') !!}/"><i class="fa fa-edit"></i><span>{!! __('messages.dashboard') !!}</span></a>
</li>

<li class="{{ Request::is('machines*') ? 'active' : '' }}">
    <a href="{!! route('machines.index') !!}"><i class="fa fa-edit"></i><span>{!! __('messages.asic_live') !!}</span></a>
</li>

<?php if(Auth::user() &&  (Auth::user()->role == 1 || Auth::user()->role == 2)){ ?>
<li class="{{ Request::is('machineTypes*') ? 'active' : '' }}">
    <a href="{!! route('machineTypes.index') !!}"><i class="fa fa-edit"></i><span>{!! __('messages.a_machines_type') !!}</span></a>
</li>
<li class="{{ Request::is('customers*') ? 'active' : '' }}">
    <a href="{!! route('customers.index') !!}"><i class="fa fa-edit"></i><span>{!! __('messages.a_customers') !!}</span></a>
</li>
<li class="{{ Request::is('cost*') ? 'active' : '' }}">
    <a href="{!! route('cost.index') !!}"><i class="fa fa-edit"></i><span>{!! __('messages.a_costs') !!}</span></a>
</li>
<?php } ?>

<?php if(Auth::user() &&  Auth::user()->role == 1){ ?>
<li class="{{ Request::is('employees*') ? 'active' : '' }}">
    <a href="{!! route('employees.index') !!}"><i class="fa fa-edit"></i><span>{!! __('messages.a_employees') !!}</span></a>
</li>
<?php } ?>


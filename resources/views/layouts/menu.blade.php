<?php if(Auth::user() &&  Auth::user()->role == 1){ ?>
<li class="{{ Request::is('homes*') ? 'active' : '' }}">
    <a href="{!! route('homes.index') !!}"><i class="fa fa-edit"></i><span>{!! __('messages.home') !!}</span></a>
</li>
<?php } ?>

<?php if(Auth::user() &&  (Auth::user()->role == 1 || Auth::user()->role == 2)){ ?>
<li class="{{ Request::is('customers*') ? 'active' : '' }}">
    <a href="{!! route('customers.index') !!}"><i class="fa fa-edit"></i><span>{!! __('messages.customers') !!}</span></a>
</li>
<?php } ?>

<li class="{{ Request::is('machines*') ? 'active' : '' }}">
    <a href="{!! route('machines.index') !!}"><i class="fa fa-edit"></i><span>{!! __('messages.machines') !!}</span></a>
</li>

<?php if(Auth::user() &&  Auth::user()->role == 1){ ?>
<li class="{{ Request::is('employees*') ? 'active' : '' }}">
    <a href="{!! route('employees.index') !!}"><i class="fa fa-edit"></i><span>{!! __('messages.employees') !!}</span></a>
</li>
<?php } ?>












<li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('users.index') !!}"><i class="nav-icon icon-cursor"></i><span>Users</span></a>
</li>
<li class="nav-item {{ Request::is('sessions*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('sessions.index') !!}"><i class="nav-icon icon-cursor"></i><span>Sessions</span></a>
</li>
<li class="nav-item {{ Request::is('deviceTypes*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('deviceTypes.index') !!}"><i class="nav-icon icon-cursor"></i><span>DeviceTypes</span></a>
</li>
<li class="nav-item {{ Request::is('devices*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('devices.index') !!}"><i class="nav-icon icon-cursor"></i><span>Devices</span></a>
</li>
<li class="nav-item {{ Request::is('instances*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('instances.index') !!}"><i class="nav-icon icon-cursor"></i><span>Instances</span></a>
</li>

<li class="nav-item {{ Request::is('attributeGroups*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('attributeGroups.index') !!}"><i class="nav-icon icon-cursor"></i><span>AttributeGroups</span></a>
</li>

<li class="nav-item {{ Request::is('attributes*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('attributes.index') !!}"><i class="nav-icon icon-cursor"></i><span>Attributes</span></a>
</li>
<li class="nav-item {{ Request::is('attributables*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('attributables.index') !!}"><i class="nav-icon icon-cursor"></i><span>Attributables</span></a>
</li>

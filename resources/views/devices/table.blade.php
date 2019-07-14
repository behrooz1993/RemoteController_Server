<div class="table-responsive-sm">
    <table class="table table-striped" id="devices-table">
        <thead>
            <th>Device Type Id</th>
        <th>Name</th>
            <th colspan="3">Action</th>
        </thead>
        <tbody>
        @foreach($devices as $device)
            <tr>
                <td>{!! $device->device_type_id !!}</td>
            <td>{!! $device->name !!}</td>
                <td>
                    {!! Form::open(['route' => ['devices.destroy', $device->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('devices.show', [$device->id]) !!}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{!! route('devices.edit', [$device->id]) !!}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
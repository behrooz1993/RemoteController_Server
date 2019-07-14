<div class="table-responsive-sm">
    <table class="table table-striped" id="instances-table">
        <thead>
            <th>Device Id</th>
        <th>Mobile</th>
        <th>Serial</th>
            <th colspan="3">Action</th>
        </thead>
        <tbody>
        @foreach($instances as $instance)
            <tr>
                <td>{!! $instance->device_id !!}</td>
            <td>{!! $instance->mobile !!}</td>
            <td>{!! $instance->serial !!}</td>
                <td>
                    {!! Form::open(['route' => ['instances.destroy', $instance->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('instances.show', [$instance->id]) !!}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{!! route('instances.edit', [$instance->id]) !!}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
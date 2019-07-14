<div class="table-responsive-sm">
    <table class="table table-striped" id="deviceTypes-table">
        <thead>
            <th>Name</th>
            <th colspan="3">Action</th>
        </thead>
        <tbody>
        @foreach($deviceTypes as $deviceType)
            <tr>
                <td>{!! $deviceType->name !!}</td>
                <td>
                    {!! Form::open(['route' => ['deviceTypes.destroy', $deviceType->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('deviceTypes.show', [$deviceType->id]) !!}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{!! route('deviceTypes.edit', [$deviceType->id]) !!}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
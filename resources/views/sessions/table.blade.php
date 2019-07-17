<div class="table-responsive-sm">
    <table class="table table-striped" id="sessions-table">
        <thead>
            <th>User Id</th>
        <th>Session</th>
        <th>Useragent</th>
            <th colspan="3">Action</th>
        </thead>
        <tbody>
        @foreach($sessions as $session)
            <tr>
                <td>{!! $session->user_id !!}</td>
            <td>{!! $session->session !!}</td>
            <td>{!! $session->useragent !!}</td>
                <td>
                    {!! Form::open(['route' => ['sessions.destroy', $session->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('sessions.show', [$session->id]) !!}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{!! route('sessions.edit', [$session->id]) !!}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
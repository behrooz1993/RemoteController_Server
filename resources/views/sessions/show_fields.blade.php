<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $session->id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $session->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $session->updated_at !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{!! $session->user_id !!}</p>
</div>

<!-- Session Field -->
<div class="form-group">
    {!! Form::label('session', 'Session:') !!}
    <p>{!! $session->session !!}</p>
</div>

<!-- Useragent Field -->
<div class="form-group">
    {!! Form::label('useragent', 'Useragent:') !!}
    <p>{!! $session->useragent !!}</p>
</div>

<!-- Fingerprint Field -->
<div class="form-group">
    {!! Form::label('fingerprint', 'Fingerprint:') !!}
    <p>{!! $session->fingerprint !!}</p>
</div>


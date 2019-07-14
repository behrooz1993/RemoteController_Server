<!-- Mobile Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mobile', 'Mobile:') !!}
    {!! Form::text('mobile', null, ['class' => 'form-control']) !!}
</div>

<!-- Serial Field -->
<div class="form-group col-sm-6">
    {!! Form::label('serial', 'Serial:') !!}
    {!! Form::text('serial', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('instances.index') !!}" class="btn btn-default">Cancel</a>
</div>

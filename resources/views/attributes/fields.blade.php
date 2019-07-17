<!-- Attribute Group Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('attribute_group_id', 'Attribute Group Id:') !!}
    {!! Form::text('attribute_group_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Permisson Field -->
<div class="form-group col-sm-6">
    {!! Form::label('permisson', 'Permisson:') !!}
    {!! Form::number('permisson', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('attributes.index') !!}" class="btn btn-default">Cancel</a>
</div>

<!-- Class ID Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'ID:') !!}
    <p>{{ $classes->id }}</p>
</div>

<!-- Class Name Field -->
<div class="col-sm-12">
    {!! Form::label('class_name', 'Class name:') !!}
    <p>{{ $classes->class_name }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created at:') !!}
    <p>{{ $classes->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated at:') !!}
    <p>{{ $classes->updated_at }}</p>
</div>


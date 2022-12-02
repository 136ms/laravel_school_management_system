<!-- Subject ID Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'ID:') !!}
    <p>{{ $subject->id }}</p>
</div>

<!-- Subject Name Field -->
<div class="col-sm-12">
    {!! Form::label('subject_name', 'Subject name:') !!}
    <p>{{ $subject->subject_name }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created at:') !!}
    <p>{{ $subject->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated at:') !!}
    <p>{{ $subject->updated_at }}</p>
</div>


<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'ID:') !!}
    <p>{{ $user->id }}</p>
</div>

<!-- Fname Field -->
<div class="col-sm-6">
    {!! Form::label('fname', 'First name:') !!}
    <p>{{ $user->fname }}</p>
</div>

<!-- Lname Field -->
<div class="col-sm-6">
    {!! Form::label('lname', 'Last name:') !!}
    <p>{{ $user->lname }}</p>
</div>

<!-- Phonenum Field -->
<div class="col-sm-6">
    {!! Form::label('phonenum', 'Phone number:') !!}
    <p>{{ $user->phonenum }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-6">
    {!! Form::label('email', 'E-mail:') !!}
    <p>{{ $user->email }}</p>
</div>

<!-- Address Field -->
<div class="col-sm-6">
    {!! Form::label('address', 'Address:') !!}
    <p>{{ $user->address }}</p>
</div>

<!-- Birthdate Field -->
<div class="col-sm-6">
    {!! Form::label('birthdate', 'Birth date:') !!}
    <p>{{ date_format($user->birthdate, "d.m.Y") }}</p>
</div>

<!-- Gender Field -->
<div class="col-sm-12">
    {!! Form::label('gender', 'Gender:') !!}
    <p>{{ $user->gender }}</p>
    <br>
</div>
<!-- Created At Field -->
<div class="col-sm-4">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $user->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-4">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $user->updated_at }}</p>
</div>

<!-- Email Verified At Field -->
<div class="col-sm-4">
    {!! Form::label('email_verified_at', 'Email Verified At:') !!}
    <p>{{ $user->email_verified_at }}</p>
</div>


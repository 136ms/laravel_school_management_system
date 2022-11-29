<!-- Fname Field -->
<div class="col-sm-12">
    {!! Form::label('fname', 'Fname:') !!}
    <p>{{ $user->fname }}</p>
</div>

<!-- Lname Field -->
<div class="col-sm-12">
    {!! Form::label('lname', 'Lname:') !!}
    <p>{{ $user->lname }}</p>
</div>

<!-- Birthdate Field -->
<div class="col-sm-12">
    {!! Form::label('birthdate', 'Birthdate:') !!}
    <p>{{ $user->birthdate }}</p>
</div>

<!-- Adress Field -->
<div class="col-sm-12">
    {!! Form::label('adress', 'Adress:') !!}
    <p>{{ $user->adress }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $user->email }}</p>
</div>

<!-- Gender Field -->
<div class="col-sm-12">
    {!! Form::label('gender', 'Gender:') !!}
    <p>{{ $user->gender }}</p>
</div>

<!-- Phonenum Field -->
<div class="col-sm-12">
    {!! Form::label('phonenum', 'Phonenum:') !!}
    <p>{{ $user->phonenum }}</p>
</div>

<!-- Password Field -->
<div class="col-sm-12">
    {!! Form::label('password', 'Password:') !!}
    <p>{{ $user->password }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $user->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $user->updated_at }}</p>
</div>

<!-- Email Verified At Field -->
<div class="col-sm-12">
    {!! Form::label('email_verified_at', 'Email Verified At:') !!}
    <p>{{ $user->email_verified_at }}</p>
</div>


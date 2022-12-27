@extends('errors::minimal')

@section('title', __('You need a different role'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'You need different role'))

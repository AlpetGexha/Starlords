@extends('errors::minimal')

@section('code', '429')
@section('code_error', __('Too Many Requests'))
@section('message', __('Sorry, you are making too many requests to our servers.'))

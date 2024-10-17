@php
$container = 'container-xxl';
$containerNav = 'container-xxl';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Créditos')

@section('content')

<livewire:cadastro-creditos.creditos.show />

@endsection
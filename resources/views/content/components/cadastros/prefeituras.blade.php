@php
$container = 'container-xxl';
$containerNav = 'container-xxl';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Cadastros')

@section('content')

<livewire:cadastro.prefeituras.show />

@endsection
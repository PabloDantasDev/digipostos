@php
$container = 'container-xxl';
$containerNav = 'container-xxl';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Relatórios - baixas')

@section('content')

<livewire:relatorios.baixas />

@endsection
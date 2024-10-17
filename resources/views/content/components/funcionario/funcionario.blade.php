@php
$isMenu = false;
$navbarHideToggle = false;
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Área do Frentista')

@section('content')

<livewire:pages.funcionario.home :user="$user" :credId="$credId" />

@endsection

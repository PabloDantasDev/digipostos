@php
$isMenu = false;
$navbarHideToggle = false;
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Página do servidor')

@section('content')

<livewire:pages.servidor.home :user="$user"/>

@endsection

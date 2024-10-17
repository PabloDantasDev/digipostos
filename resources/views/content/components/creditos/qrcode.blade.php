@php
$container = 'container-xxl';
$containerNav = 'container-xxl';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'QRCode')

@section('content')

<h4>{{ $placa }}</h4>
<div class="row bg-dark" style="width:400px; height:400px; max-width: 98vw;">
    <img src="{{ $qrcode }}" alt="">
</div>

@endsection
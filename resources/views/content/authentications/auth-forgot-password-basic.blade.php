@extends('layouts/blankLayout')

@section('title', 'Forgot Password Basic - Pages')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-4">

      <!-- Forgot Password -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
            <a href="{{url('/')}}" class="app-brand-link gap-2">
              <div class="" style="display: flex; flex-direction: column; align-items: center;">
                <span class="app-brand-logo demo"><img src="{{ $logo }}" style="max-height: 100px; max-width: 150px; margin-bottom: 1rem"/></span>
                <span class="app-brand-text demo text-body fw-bold">{{ $name }}</span>
              </div>
            </a>
          </div>
          <!-- /Logo -->
          <h4 class="mb-2">Esqueceu a senha? 🔒</h4>
          <p class="mb-4">Digite o seu e-mail e enviaremos instruções para a redefinição da senha</p>
          <form id="formAuthentication" class="mb-3" action="{{url('/')}}" method="GET">
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Digite o seu e-mail" autofocus>
            </div>
            <button class="btn btn-primary d-grid w-100">Enviar o link de redefinição</button>
          </form>
          <div class="text-center">
            <a href="{{url('auth/login-basic')}}" class="d-flex align-items-center justify-content-center">
              <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
              Voltar para o login
            </a>
          </div>
        </div>
      </div>
      <!-- /Forgot Password -->
    </div>
  </div>
</div>
@endsection

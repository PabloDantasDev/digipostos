@extends('layouts/blankLayout')

@section('title', 'Register Basic - Pages')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection


@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <!-- Register Card -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
            <a href="{{url('/')}}" class="app-brand-link gap-2">
              {{-- <span class="app-brand-logo demo">@include('_partials.macros',["width"=>25,"withbg"=>'var(--bs-primary)'])</span> --}}
              <h3 class="demo text-body fw-bold">Postos Canguaremata</h3>
            </a>
          </div>
          <!-- /Logo -->
          <h4 class="mb-2">Faça sua conta aqui!</h4>
          <p class="mb-4">Preencha com seus dados.</p>

          <form id="formAuthentication" class="mb-3" action="{{ route('auth.register') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="username" class="form-label">Nome</label>
              <input type="text" class="form-control" id="username" name="name" placeholder="Digite o seu nome" autofocus>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Digite seu email">
            </div>
            <div class="mb-3 form-password-toggle">
              <label class="form-label" for="password">Senha</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>
            <div class="mb-3 form-password-toggle">
              <label class="form-label" for="password">Repetir senha</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>

            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms">
                <label class="form-check-label" for="terms-conditions">
                  Concordo com a 
                  <a href="javascript:void(0);">política de privacidade e termos</a>
                </label>
              </div>
            </div>
            <button type="submit" class="btn btn-primary d-grid w-100">
              Cadastrar
            </button>
          </form>

          <p class="text-center">
            <span>Já tem uma conta?</span>
            <a href="{{url('auth/login-basic')}}">
              <span>Faça login</span>
            </a>
          </p>
        </div>
      </div>
      <!-- Register Card -->
    </div>
  </div>
</div>
@endsection

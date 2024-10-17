@extends('layouts/blankLayout')

@section('title', 'Login Basic - Pages')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <!-- Register -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
            <a href="{{url('/')}}" class="app-brand-link gap-2" style="display: flex; flex-direction: column;">
              {{-- <span class="app-brand-logo demo">@include('_partials.macros',["width"=>25,"withbg"=>'var(--bs-primary)'])</span> --}}
              <td><img src="{{ $logo }}" style="max-height: 100px; max-width: 150px"/></td>
              <h4 class="demo text-body fw-bold">{{ $name }}</h4>
            </a>
          </div>
          <!-- /Logo -->
          <h4 class="mb-2">Bem-vindo ao cadastro de crédito!</h4>
          <p class="mb-4">Faça login para poder começar uma sessão.</p>

          @error('email') <small class="text-danger">Credenciais inválidas</small> @enderror
          
          <form id="formAuthentication" class="mb-3" action="{{ route('auth.login') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Entre com o seu email" autofocus>
            </div>
            <div class="mb-3 form-password-toggle">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Senha</label>
                <a href="{{url('auth/forgot-password-basic')}}">
                  <small>Esqueceu a senha?</small>
                </a>
              </div>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>
            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember-me">
                <label class="form-check-label" for="remember-me">
                  Lembrar de mim
                </label>
              </div>
            </div>
            <div class="mb-3">
              <button class="btn btn-primary d-grid w-100" type="submit">Entrar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /Register -->
  </div>
</div>
</div>
@endsection

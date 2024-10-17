<div>
  <div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <!-- Register Card -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
              <h4 class="mb-2">Edite seu perfil!</h4>
          </div>
          <div>
          </div>
          <!-- /Logo -->

          <form id="formAuthentication" class="mb-3" action="{{ url('/auth/user') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="username" class="form-label">Nome</label>
              <input type="text" class="form-control" wire:model.defer="userName" id="username" name="name" placeholder="Digite o seu nome" autofocus>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" disabled wire:model.defer="userEmail" id="email" name="email" placeholder="Digite seu email">
            </div>
            <div class="mb-3 form-password-toggle">
              <label class="form-label" for="password">Nova Senha</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" wire:model.defer="userPassword" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>
            <button type="submit"  wire:click="update" class="btn btn-primary d-grid w-100">
              Atualizar
            </button>
          </form>
        </div>
      </div>
      <!-- Register Card -->
    </div>
  </div>
</div>
</div>
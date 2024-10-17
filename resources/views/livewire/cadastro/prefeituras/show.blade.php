<div>
    @if($user->role_id == 1)
    <livewire:cadastro.prefeituras.create />
    @endif
    
    <!-- Hoverable Table rows -->
    <div class="card">
      <h5 class="card-header">Prefeituras</h5>
      <div class="table-responsive text-nowrap">
        <table class="table table-hover" style="min-height: 215px;">
          <thead>
            <tr>
              <th>ID</th>
              <th>Logo</th>
              <th>Nome</th>
              <th>Prefeito</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @foreach($prefeituras as $prefeitura)
            <tr class="align-top">
              <td><i class="fab fa-angular fa-lg text-danger me-1"></i> <strong>{{ $prefeitura->id }}</strong></td>
              <td><img src="{{ url('storage/' . $prefeitura->logo) }}" style="max-height: 50px; max-width: 50px"/></td>
              <td><a href="{{ route('cadastros.secretarias', $prefeitura->id) }}">{{ $prefeitura->name }}</a></td>
              <td><span>{{ $prefeitura->mayor }}</span></td>
              <td>

                <livewire:cadastro.prefeituras.update :prefeitura="$prefeitura" :key="$prefeitura->id" />
                
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      
      <div class="row">
          <div class="col d-flex justify-content-center my-3">
              {{ $prefeituras->links() }}
          </div>
      </div>
    
    </div>
    
    </div>
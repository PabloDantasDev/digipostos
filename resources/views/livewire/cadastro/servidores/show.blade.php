<div>
    
    <livewire:cadastro.servidores.create />
    
    
    <!-- Hoverable Table rows -->
    <div class="card">
        <h5 class="card-header"><a href="#" wire:click="chooseSecretaria"
          style="color: #566a7f" 
          >Servidores</a> @if($secId != null) de {{ $secName }} @endif</h5>
      <div class="table-responsive text-nowrap">
        <table class="table table-hover" style="min-height: 215px;">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Placa do veiculo</th>
              <th>Secretaria</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @foreach($servidores as $servidor)
            <tr class="align-top">
              <td><i class="fab fa-angular fa-lg text-danger me-1"></i> <strong>{{ $servidor->id }}</strong></td>
              <td><span>{{ $servidor->name }}</span></td>
              <td><span>{{ $servidor->veiculo->license_plate }}</span></td>
              <td><a href="#" wire:click="chooseSecretaria('{{ $servidor->secretaria->id }}')">{{ $servidor->secretaria->name }}</a></td>
              <td>

                <livewire:cadastro.servidores.update :servidor="$servidor" :key="$servidor->id" />
                
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      
      <div class="row">
          <div class="col d-flex justify-content-center my-3">
              {{ $servidores->links() }}
          </div>
      </div>
    
    </div>
    
</div>
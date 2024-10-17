<div>
    
    <livewire:cadastro-postos.funcionarios.create />
    
    
    <!-- Hoverable Table rows -->
    <div class="card">
        <h5 class="card-header"><a href="#" wire:click="choosePosto"
          style="color: #566a7f" 
          >Funcionários</a> @if($postoId != null) de {{ $postoName }} @endif</h5>
      <div class="table-responsive text-nowrap">
        <table class="table table-hover" style="min-height: 215px;">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>posto</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @foreach($funcionarios as $funcionario)
            <tr class="align-top">
              <td><i class="fab fa-angular fa-lg text-danger me-1"></i> <strong>{{ $funcionario->id }}</strong></td>
              <td><span>{{ $funcionario->name }}</span></td>
              <td><a href="#" wire:click="choosePosto('{{ $funcionario->posto->id }}')">{{ $funcionario->posto->name }}</a></td>
              <td>

                <livewire:cadastro-postos.funcionarios.update :funcionario="$funcionario" :key="$funcionario->id" />
                
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      
      <div class="row">
          <div class="col d-flex justify-content-center my-3">
              {{ $funcionarios->links() }}
          </div>
      </div>
    
    </div>
    
</div>
<div>
    
    <livewire:cadastro-postos.combustivel.combustivel-create />
    
    
    <!-- Hoverable Table rows -->
    <div class="card">
      <h5 class="card-header">Combustíveis</h5>
      <div class="table-responsive text-nowrap">
        <table class="table table-hover" style="min-height: 215px;">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @foreach($combustiveis as $combustivel)
            <tr class="align-top">
              <td><i class="fab fa-angular fa-lg text-danger me-1"></i> <strong>{{ $combustivel->id }}</strong></td>
              <td>{{ $combustivel->name }}</a></td>
              <td>

                <livewire:cadastro-postos.combustivel.combustivel-update :combustivel="$combustivel" :key="$combustivel->id" />
                
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      
      <div class="row">
          <div class="col d-flex justify-content-center my-3">
              {{ $combustiveis->links() }}
          </div>
      </div>
    
    </div>
    
</div>
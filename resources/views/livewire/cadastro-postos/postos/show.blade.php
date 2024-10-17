<div>
    
    <livewire:cadastro-postos.postos.create />
    
    
    <!-- Hoverable Table rows -->
    <div class="card">
      <h5 class="card-header">Postos de combustível</h5>
      <div class="table-responsive text-nowrap">
        <table class="table table-hover" style="min-height: 215px;">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>cidade</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @foreach($postos as $posto)
            <tr class="align-top">
              <td><i class="fab fa-angular fa-lg text-danger me-1"></i> <strong>{{ $posto->id }}</strong></td>
              <td><a href="{{ route('cadastro-postos.funcionarios', $posto->id) }}">{{ $posto->name }}</a></td>
              <td><span>{{ $posto->city }}</span></td>
              <td>

                <livewire:cadastro-postos.postos.update :posto="$posto" :key="$posto->id" />
                
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      
      <div class="row">
          <div class="col d-flex justify-content-center my-3">
              {{ $postos->links() }}
          </div>
      </div>
    
    </div>
    
</div>
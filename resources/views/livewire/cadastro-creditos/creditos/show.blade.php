<div>
  @php
      use Carbon\Carbon;
  @endphp
  <div class="row justify-content-between">
    <livewire:cadastro-creditos.creditos.create :postos="$postos"/>
    
    <div class="col-lg-6 col-md-6">
      <div class="my-3">

        <div class="input-group mb-3">
          <div class="input-group-text cursor-pointer">
            <i class="bx bx-search fs-4 lh-0"></i>
          </div>
          <input type="text" id="search" wire:model="searchValue" class="form-control" placeholder="Pesquisar por placa" aria-label="Pesquisa">
        </div>

      </div>
    </div>
  </div>
    
    
    
    <!-- Hoverable Table rows -->
    <div class="card">
      <h5 class="card-header">Cadastros de Créditos</h5>
      <div class="table-responsive text-nowrap">
        <table class="table table-hover" style="min-height: 215px;">
          <thead>
            <tr>
              <th>ID</th>
              <th>Placa do veículo</th>
              <th>Credito(L)</th>
              <th>Validade</th>
              <th>Tipo de combustível</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @foreach($creditos as $credito)
            <tr class="align-top">
              <td><i class="fab fa-angular fa-lg text-danger me-1"></i> <strong>{{ $credito->id }}</strong></td>
              <td><span>{{ $credito->veiculo->license_plate }}</span></td>
              <td>
                <span>{{ $credito->fuel_credit }}</span>
                @if($credito->fuel_credit < $credito->veiculo->tank_capacity)
                  <div class="cursor-pointer d-inline" id="dropdownMenu1{{$credito->id}}" data-bs-toggle="dropdown">
                    <i class='bx bx-error text-warning' ></i>
                  </div>
                  <div class="dropdown-menu p-4 text-muted text-wrap" style="max-width: 200px;">
                    <p>
                      Crédito abaixo do limite do tanque, atualize o crédito.
                    </p>
                  </div>
                @endif
              </td>
              <td>
                <span>{{ Carbon::parse($credito->validity)->format('d/m/y') }}</span>
                @if(Carbon::parse($credito->validity) <= $nextToDay)
                  <div class="cursor-pointer d-inline" id="dropdownMenu2{{$credito->id}}" data-bs-toggle="dropdown">
                    <i class='bx bx-error text-warning' ></i>
                  </div>
                  <div class="dropdown-menu p-4 text-muted text-wrap" style="max-width: 200px;">
                    <p>
                      Próximo da validade, atualize o crédito.
                    </p>
                  </div>
                @endif
              </td>
              <td><span>{{ $credito->fuel }}</span></td>
              <td>

                <livewire:cadastro-creditos.creditos.update :credito="$credito" :postos="$postos" :key="$credito->id" />
                
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      
      <div class="row">
          <div class="col d-flex justify-content-center my-3">
              {{ $creditos->links() }}
          </div>
      </div>
    
    </div>
    
    <script>
      document.getElementById('search').addEventListener('change', function() {
          var searchValue = this.value;
          Livewire.emit('atualizarValor', searchValue);
      });
  </script>
  
<script>
  document.getElementById('searchInput').addEventListener('input', function() {
      // Aqui você pode adicionar o código para pesquisar com base no texto inserido no campo de entrada
      console.log('Pesquisar:', this.value);
  });

  document.getElementById('filterSelect').addEventListener('change', function() {
      // Aqui você pode adicionar o código para filtrar com base na opção selecionada no menu suspenso
      console.log('Filtrar por:', this.value);
  });
</script>

</div>
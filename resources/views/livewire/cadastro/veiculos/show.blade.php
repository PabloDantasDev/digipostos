<div>
  <div class="row justify-content-between">
    <livewire:cadastro.veiculos.create />
    
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
        <h5 class="card-header"><a href="#" wire:click="chooseSecretaria"
          style="color: #566a7f" 
          >Veículos</a> @if($secId != null) de {{ $secName }} @endif</h5>
      <div class="table-responsive text-nowrap">
        <table class="table table-hover" style="min-height: 215px;">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Placa</th>
              <th>Secretaria</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @foreach($veiculos as $veiculo)
            <tr class="align-top">
              <td><i class="fab fa-angular fa-lg text-danger me-1"></i> <strong>{{ $veiculo->id }}</strong></td>
              <td><span>{{ $veiculo->name }}</span></td>
              <td><span>{{ $veiculo->license_plate }}</span></td>
              <td><a href="#" wire:click="chooseSecretaria('{{ $veiculo->secretaria->id }}')">{{ $veiculo->secretaria->name }}</a></td>
              <td>

                <livewire:cadastro.veiculos.update :veiculo="$veiculo" :key="$veiculo->id" />
                
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      
      <div class="row">
          <div class="col d-flex justify-content-center my-3">
              {{-- {{ $veiculos->links() }} --}}
            <ul class="pagination">
              <!-- Botão "Anterior" -->
              <li class="page-item cursor-pointer {{ $veiculos->onFirstPage() ? 'disabled' : '' }}">
                  <a class="page-link" wire:click="previousPage" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                  </a>
              </li>

              <!-- Elementos de paginação -->
              @for ($i = max(1, $veiculos->currentPage() - $maxPages); $i <= min($veiculos->lastPage(), $veiculos->currentPage() + $maxPages); $i++)
                <li class="page-item {{ $i == $veiculos->currentPage() ? 'active' : '' }}">
                      <a class="page-link" wire:click="gotoPage({{ $i }})" href="#">{{ $i }}</a>
                </li>
              @endfor

              <!-- Botão "Próximo" -->
              <li class="page-item cursor-pointer {{ $veiculos->hasMorePages() ? '' : 'disabled' }}">
                  <a class="page-link" wire:click="nextPage" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                  </a>
              </li>
            </ul>
          </div>
      </div>
    
    </div>
    
    <script>
      document.getElementById('search').addEventListener('change', function() {
          var searchValue = this.value;
          Livewire.emit('atualizarValor', searchValue);
      });
  </script>

</div>
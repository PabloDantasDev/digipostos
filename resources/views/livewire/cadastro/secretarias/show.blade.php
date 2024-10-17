<div>
    
    <livewire:cadastro.secretarias.create :prefId="$prefId"/>
    
    
    <!-- Hoverable Table rows -->
    <div class="card">
        <h5 class="card-header"><a href="#" wire:click="choosePrefeitura"
          style="color: #566a7f" 
          >Secretarias</a> @if($prefId != null) de {{ $prefName }} @endif</h5>
      <div class="table-responsive text-nowrap">
        <table class="table table-hover" style="min-height: 215px;">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Prefeitura</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @foreach($secretarias as $secretaria)
            <tr class="align-top">
              <td><i class="fab fa-angular fa-lg text-danger me-1"></i> <strong>{{ $secretaria->id }}</strong></td>
              <td><a href="{{ route('cadastros.veiculos', $secretaria->id) }}">{{ $secretaria->name }}</a></td>
              <td><a href="#" wire:click="choosePrefeitura('{{$secretaria->prefeitura->id}}')">{{ $secretaria->prefeitura->name }}</a></td>
              <td>

                    <livewire:cadastro.secretarias.update :secretaria="$secretaria" :key="$secretaria->id" />
                
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      
      <div class="row">
          <div class="col d-flex justify-content-center my-3">
              {{ $secretarias->links() }}
          </div>
      </div>
    
    </div>
    
</div>
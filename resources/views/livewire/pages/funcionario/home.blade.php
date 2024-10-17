<div>
    <div class="card">
        <h5 class="card-header">Area do Frentista</h5>

        <div class="card-body">
            <div class="row my-3 align-items-center">
                <!-- <div class="col-12 col-sm-2" style="width: 100%; height: 100px;">
                    <img src="{{ asset('assets/img/branding/canguaretama.png') }}" class="w-100 mb-3" alt="logo">
                </div>
                <div class="col-12 col-sm-5">
                    <h5 class="text-wrap">Prefeitura municipal de Canguaretama</h5> nome da prefeitura
                </div> -->
                <div class="col-12 col-sm-5">
                    <h5 class="text-wrap">{{ $secretaria }}</h5> <!-- nome da secretaria -->
                </div>
            </div>
            <hr>
            <div class="row my-3">
                <div class="col-12 col-md-6 col-lg-4">
                    <h4 class="mb-0">Placa:</h4>
                    @if($notQR)
                    <div class="mb-3 mw-100" wire:ignore >
                        
                        <select class="form-select select2" id="select2" wire:model="chosenCred" wire:change="chooseCred" aria-label="Default select example">
                            <option selected value="" >Selecionar Crédito do Veículo</option>
                            @foreach ($creditos as $credito)
                            <option value="{{ $credito->id }}">{{ $credito->veiculo->license_plate }} - {{ $credito->fuel_credit }}L</option>
                            @endforeach
                        </select>

                        {{-- <input type="search" list="lista" class="form-control" id="seachField" wire:model="chosenCred" wire:change="chooseCred" placeholder="Pesquisar por crédito">
                        <datalist id="lista" >
                            @foreach ($creditos as $credito)
                            <option value="{{ $credito->id }}">
                                {{ $credito->veiculo->license_plate }} - {{ $credito->fuel_credit }}L
                            </option>
                            @endforeach
                        </datalist> --}}

                    </div>
                    @else
                    {{ $license_plate }} <!-- placa do veículo -->
                    @endif
                </div>
                <div class="col-12 col-md-6 col-lg-8 text-center">
                    <h4 class="mb-0">Capacidade do tanque(Litros):</h4><p class="mt-0">{{ $tank_capacity }}</p> 
                </div>
            </div>
            @if($credits != null && $posto != null)
            <hr>
            <div class="row mt-5 mb-3">
                <div class="col-6">
                    <h6 class="text-wrap">{{ $posto }}</h6> <!-- nome do posto -->
                    <h6 class="text-wrap">{{ $frentista }}</h6> <!-- nome do frentista -->
                </div>
                <div class="col-6 text-center">
                    <h3>Créditos disponíveis:</h3><h4>{{ $credits }}L</h4>
                </div>
            </div>
            @endif
            
            @if($credits != null && $credits > 0)
            <div class="row my-5 justify-content-center align-items-center">
                <div class="col-12 text-center">
                    <button data-bs-toggle="modal" data-bs-target="#modalCenter" class="btn btn-xl rounded-pill btn-primary">Continuar</button>
                </div>
            </div>
            @endif

            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row" style="w-100">
                                <div class="col-12 text-center">
                                    <h3>Créditos disponíveis:</h3><h4>{{ $credits }}</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Valor em litros</label>
                                    <input type="text"  onKeyUp="mascaraMoeda(this, event)" id="nameWithTitle" wire:model="liters" class="form-control" placeholder="Créditos">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Voltar</button>
                            <button wire:click="discount" type="button" class="btn btn-primary" data-bs-dismiss="modal">Descontar do crédito</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End-Modal -->
        </div>
    </div>
    
    @push('scripts')
    <script>
        
            $('#select2').on('change', function (e) {
                
                Livewire.emit('select2Updated', e.target.value);
            });
            
    </script>
    @endpush
</div>

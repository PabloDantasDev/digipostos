<div class="col-lg-4 col-md-6">
    <!-- Vertically Centered Modal -->
    <div>
        <div class="my-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
            Cadastrar Novo Crédito
            </button>

            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Novo Crédito</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="FormSelect1" class="form-label">Placa do veículo</label>
                                    <select class="form-select" id="FormSelect1" wire:model="selectedVeiculo" wire:change="chooseVeiculo" aria-label="Default select example">
                                        <option selected value="" >Selecionar Veículo</option>
                                        @foreach ($veiculos as $veiculo)
                                        <option value="{{ $veiculo->id }}">{{ $veiculo->license_plate }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Crédito de Combustível(L)</label>
                                    <input type="text" onKeyUp="mascaraMoeda(this, event)" id="nameWithTitle" wire:model.defer="fuelCredit" class="form-control" placeholder="Créditos em litros">
                                </div>
                            </div>
                            <!--<div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Tipo do Combustível</label>
                                    <select class="form-select" id="FormSelect1" wire:model="credFuel" aria-label="Default select example">
                                        <option selected value="" >Selecionar Tipo</option>
                                        <option value="GASOLINA">GASOLINA</option>
                                        <option value="ETANOL">ETANOL</option>
                                        <option value="DIESEL">DIESEL</option>
                                        <option value="GNV">GNV</option>
                                    </select>
                                </div>
                            </div>-->
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="FormSelect1" class="form-label">Combustiveis</label>
                                    <select class="form-select" id="FormSelect1" wire:model="selectedCombustivel" aria-label="Default select example">
                                        <option selected value="" >Selecionar Combustível</option>
                                        @foreach ($combustiveis as $combustivel)
                                        <option value="{{ $combustivel->id }}">{{ $combustivel->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Valor por litro</label>
                                    <input type="text" onKeyUp="mascaraMoeda2(this, event)" id="nameWithTitle" wire:model.defer="credVpl" class="form-control" placeholder="Valor por litro de combustível">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="FormSelect1" class="form-label">Posto</label>
                                    <select class="form-select" id="FormSelect1" wire:model="selectedPosto" aria-label="Default select example">
                                        <option selected value="" >Selecionar Posto</option>
                                        @foreach ($postos as $posto)
                                        <option value="{{ $posto->id }}">{{ $posto->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Validade</label>
                                    <input type="date" min="{{date("Y-m-d")}}" id="nameWithTitle" wire:model.defer="credValidity" class="form-control" placeholder="Validate dos Créditos">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button wire:click="createCredito" type="button" class="btn btn-primary" data-bs-dismiss="modal">Cadastrar Crédito</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End modal -->
</div>
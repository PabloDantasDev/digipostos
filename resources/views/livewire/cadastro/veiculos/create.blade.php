<div class="col-lg-4 col-md-6">
    <!-- Vertically Centered Modal -->
    <div>
        <div class="my-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
            Cadastrar Novo Veículo
            </button>

            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Novo Veículo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Nome</label>
                                    <input type="text" id="nameWithTitle" wire:model.defer="veicName" class="form-control" placeholder="Nome do veículo">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Placa</label>
                                    <input type="text" id="nameWithTitle" wire:model.defer="veicPlate" class="form-control" placeholder="Placa do veículo">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Modelo</label>
                                    <input type="text" id="nameWithTitle" wire:model.defer="veicModel" class="form-control" placeholder="Modelo do veículo">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Ano</label>
                                    <input type="text" onKeyUp="mascaraAno(this, value)" id="nameWithTitle" wire:model.defer="veicYear" class="form-control" placeholder="Ano do veículo">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Fabricante</label>
                                    <input type="text" id="nameWithTitle" wire:model.defer="veicProductor" class="form-control" placeholder="Fabricante do veículo">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Cor</label>
                                    <input type="text" id="nameWithTitle" wire:model.defer="veicColor" class="form-control" placeholder="Cor do veículo">
                                </div>
                            </div>
                            <!--<div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Tipo do Combustível</label>
                                    <select class="form-select" id="FormSelect1" wire:model="veicFuel" aria-label="Default select example">
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
                                    <label for="nameWithTitle" class="form-label">Capacidade do Tanque</label>
                                    <input type="text" id="nameWithTitle" wire:model.defer="veicTank" class="form-control" placeholder="Capacidade do tanque (Litros)">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Quilometragem Inicial</label>
                                    <input type="text" id="nameWithTitle" wire:model.defer="veicInitialKM" class="form-control" placeholder="Quilometragem inicial">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Quilometragem Final</label>
                                    <input type="text" id="nameWithTitle" wire:model.defer="veicFinalKM" class="form-control" placeholder="Quilometragem final">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="FormSelect1" class="form-label">Prefeitura</label>
                                    <select class="form-select" id="FormSelect1" wire:model="selectedPrefeitura" wire:change="refreshSecretarias" aria-label="Default select example">
                                        <option selected value="" >Selecionar Prefeitura</option>
                                        @foreach ($prefeituras as $prefeitura)
                                        <option value="{{ $prefeitura->id }}">{{ $prefeitura->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="FormSelect1" class="form-label">Secretarias</label>
                                    <select class="form-select" id="FormSelect1" wire:model="selectedSecretaria" aria-label="Default select example">
                                        <option selected value="" >Selecionar Secretaria</option>
                                        @foreach ($secretarias as $secretaria)
                                        <option value="{{ $secretaria->id }}">{{ $secretaria->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button wire:click="createVeiculo" type="button" class="btn btn-primary" data-bs-dismiss="modal">Cadastrar Veículo</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End modal -->
</div>
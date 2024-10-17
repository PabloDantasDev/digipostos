<div> 
    <div class="dropdown">
        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
            <div class="dropdown-menu">

            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $veicId }}">
                <i class="bx bx-edit-alt me-1"></i> 
                Editar
            </button>

            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $veicId }}">
                <i class="bx bx-trash me-1"></i> 
                Excluir
            </button>
            
        </div>
    </div>

    <!-- Modal-update -->
    <div wire:ignore.self class="modal fade" id="modalEdit{{ $veicId }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditTitle">Editar {{ $veicName }}</h5>
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
                    <button type="button" wire:click="updateVeiculo"  class="btn btn-primary">Aplicar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end Modal-update -->

    <!-- Modal-delete -->
    <div wire:ignore.self class="modal fade" id="modalDelete{{ $veicId }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditTitle">Excluir Veículo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-wrap">
                    <h4>Deseja realmente excluir o veículo "{{ $veicName}}"?</h4>
                    <p>Excluir o veículo pode acarretar na perda de dados.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" wire:click="deleteVeiculo" class="btn btn-danger" data-bs-dismiss="modal">Excluir</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal-delete -->

</div>
<div> 
    <div class="dropdown">
        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
            <div class="dropdown-menu">

            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $credId }}">
                <i class="bx bx-edit-alt me-1"></i> 
                Editar
            </button>
            
            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalAdd{{ $credId }}">
                <i class="bx bx-plus me-1"></i> 
                Adicionar
            </button>

            <a href="{{ route('qrcode', $credId) }}" target="blank" class="dropdown-item">
                <i class="bx bx-show me-1"></i> 
                Mostrar QR Code
            </a>

            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $credId }}">
                <i class="bx bx-trash me-1"></i> 
                Excluir
            </button>
            
        </div>
    </div>

    <!-- Modal-update -->
    <div wire:ignore.self class="modal fade" id="modalEdit{{ $credId }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditTitle">Editar Crédito do veículo "{{ $credito->veiculo->license_plate }}"</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Selecionar novo crédito</label>
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
                    <button type="button" wire:click="updateCredito"  class="btn btn-primary">Aplicar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end Modal-update -->
    
    <!-- Modal-Add -->
    
    <div wire:ignore.self class="modal fade" id="modalAdd{{ $credId }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditTitle">Adicionar Crédito ao veículo "{{ $credito->veiculo->license_plate }}"</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-wrap">
                    <h4>Crédito atual(L) {{ $creditoAtual }}</h4>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Adicionar Combustível(L)</label>
                            <input type="text" id="nameWithTitle" onKeyUp="mascaraMoeda(this, event)" wire:model.defer="credAdd" class="form-control" placeholder="Adicionar Crédito">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Validade</label>
                            <input type="date" min="{{date("Y-m-d")}}" id="nameWithTitle" wire:model.defer="credAddValidity" class="form-control" placeholder="Validate dos Créditos">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" wire:click="addCredito" class="btn btn-primary" data-bs-dismiss="modal">Adicionar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end Modal-add -->

    <!-- QR-Modal -->
    <div wire:ignore.self class="modal fade" id="modalQR{{ $credId }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">QR Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row" style="w-100">
                        <img src="{{ $qrcode }}" alt="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Voltar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End-QR-Modal -->

    <!-- Modal-delete -->
    <div wire:ignore.self class="modal fade" id="modalDelete{{ $credId }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditTitle">Excluir Crédito</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-wrap">
                    <h4>Deseja realmente excluir o crédito referente ao veículo "{{ $credito->veiculo->license_plate}}"?</h4>
                    <p>Excluir o crédito pode acarretar na perda de dados.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" wire:click="deleteCredito" class="btn btn-danger" data-bs-dismiss="modal">Excluir</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal-delete -->

</div>
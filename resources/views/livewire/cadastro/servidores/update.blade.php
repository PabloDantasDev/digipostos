<div> 
    <div class="dropdown">
        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
            <div class="dropdown-menu">

            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $servId }}">
                <i class="bx bx-edit-alt me-1"></i> 
                Editar
            </button>

            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $servId }}">
                <i class="bx bx-trash me-1"></i> 
                Excluir
            </button>
            
        </div>
    </div>

    <!-- Modal-update -->
    <div wire:ignore.self class="modal fade" id="modalEdit{{ $servId }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditTitle">Editar {{ $servName }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Nome</label>
                            <input type="text" id="nameWithTitle" wire:model.defer="servName" class="form-control" placeholder="Nome do Servidor">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="FormSelect1" class="form-label">Secretarias</label>
                            <select class="form-select" id="FormSelect1" wire:model="selectedSecretaria" wire:change="refreshVeiculos" aria-label="Default select example">
                                <option selected value="" >Selecionar Secretaria</option>
                                @foreach ($secretarias as $secretaria)
                                <option value="{{ $secretaria->id }}">{{ $secretaria->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="FormSelect1" class="form-label">Veiculos</label>
                            <select class="form-select" id="FormSelect1" wire:model="selectedVeiculo" aria-label="Default select example">
                                <option selected value="" >Selecionar Veiculo</option>
                                @foreach ($veiculos as $veiculo)
                                <option value="{{ $veiculo->id }}">{{ $veiculo->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Telefone</label>
                            <input type="text" onkeyup="handlePhone(event)" id="nameWithTitle" wire:model.defer="servPhone" class="form-control" placeholder="Telefone do servidor">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Celular</label>
                            <input type="text" onkeyup="handlePhone(event)" id="nameWithTitle" wire:model.defer="servCellphone" class="form-control" placeholder="Celular do servidor">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">email</label>
                            <input type="text" id="nameWithTitle" wire:model.defer="servEmail" class="form-control" placeholder="Email do servidor">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Senha</label>
                            <input type="password" id="password" name="password" wire:model.defer="servPassword" class="form-control" placeholder="******">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Termos de uso</label>
                            <textarea type="text" wire:model="servTerms" id="nameWithTitle" class="form-control" placeholder="Termos de uso" cols="30" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" wire:click="updateServidor"  class="btn btn-primary">Aplicar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end Modal-update -->

    <!-- Modal-delete -->
    <div wire:ignore.self class="modal fade" id="modalDelete{{ $servId }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditTitle">Excluir servidor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-wrap">
                    <h4>Deseja realmente excluir o servidor "{{ $servName}}"?</h4>
                    <p>Excluir o servidor pode acarretar na perda de dados.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" wire:click="deleteServidor" class="btn btn-danger" data-bs-dismiss="modal">Excluir</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal-delete -->

</div>
<div> 
    <div class="dropdown">
        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
            <div class="dropdown-menu">

            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $funcId }}">
                <i class="bx bx-edit-alt me-1"></i> 
                Editar
            </button>

            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $funcId }}">
                <i class="bx bx-trash me-1"></i> 
                Excluir
            </button>
            
        </div>
    </div>

    <!-- Modal-update -->
    <div wire:ignore.self class="modal fade" id="modalEdit{{ $funcId }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditTitle">Editar {{ $funcName }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Nome</label>
                            <input type="text" id="nameWithTitle" wire:model.defer="funcName" class="form-control" placeholder="Nome do funcionário">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Telefone</label>
                            <input type="text" onkeyup="handlePhone(event)" id="nameWithTitle" wire:model.defer="funcPhone" class="form-control" placeholder="Telefone do funcionário">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Celular</label>
                            <input type="text" onkeyup="handlePhone(event)" id="nameWithTitle" wire:model.defer="funcCellphone" class="form-control" placeholder="Celular do funcionário">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">email</label>
                            <input type="text" id="nameWithTitle" wire:model.defer="funcEmail" class="form-control" placeholder="Email do funcionário">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Senha</label>
                            <input type="password" id="password" name="password" wire:model.defer="funcPassword" class="form-control" placeholder="******">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Termos de uso</label>
                            <textarea type="text" wire:model="funcTerms" id="nameWithTitle" class="form-control" placeholder="Termos de uso" cols="30" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" wire:click="updateFuncionario"  class="btn btn-primary">Aplicar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end Modal-update -->

    <!-- Modal-delete -->
    <div wire:ignore.self class="modal fade" id="modalDelete{{ $funcId }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditTitle">Excluir funcionário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-wrap">
                    <h4>Deseja realmente excluir o funcionário "{{ $funcName}}"?</h4>
                    <p>Excluir o funcionário pode acarretar na perda de dados.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" wire:click="deleteFuncionario" class="btn btn-danger" data-bs-dismiss="modal">Excluir</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal-delete -->

</div>
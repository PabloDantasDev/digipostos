<div> 
    <div class="dropdown">
        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
            <div class="dropdown-menu">

            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $combustivel_id }}">
                <i class="bx bx-edit-alt me-1"></i> 
                Editar
            </button>

            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $combustivel_id }}">
                <i class="bx bx-trash me-1"></i> 
                Excluir
            </button>
            
        </div>
    </div>

    <!-- Modal-update -->
    <div wire:ignore.self class="modal fade" id="modalEdit{{ $combustivel_id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditTitle">Editar {{ $name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Nome</label>
                            <input type="text" id="nameWithTitle" wire:model.defer="name" class="form-control" placeholder="Nome do combustível">
                        </div>
                    </div>                    
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" wire:click="update"  class="btn btn-primary">Aplicar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end Modal-update -->

    <!-- Modal-delete -->
    <div wire:ignore.self class="modal fade" id="modalDelete{{ $combustivel_id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditTitle">Excluir Combustível</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-wrap">
                    <h4>Deseja realmente excluir o combustível "{{ $name }}"?</h4>
                    <p>Excluir o combustível pode acarretar em perda de todos os dados relacionados a ele.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" wire:click="delete" class="btn btn-danger" data-bs-dismiss="modal">Excluir</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal-delete -->

</div>
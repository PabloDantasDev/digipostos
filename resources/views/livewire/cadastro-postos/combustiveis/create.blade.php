<div>
    <!-- Vertically Centered Modal -->
    <div class="col-lg-4 col-md-6">
        <div class="my-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
            Cadastrar Novo Combustível
            </button>

            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Novo Combustível</h5>
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
                            <button wire:click="create" type="button" class="btn btn-primary" data-bs-dismiss="modal">Cadastrar Posto</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End modal -->
</div>
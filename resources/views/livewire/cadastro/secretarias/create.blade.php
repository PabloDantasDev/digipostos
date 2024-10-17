<div>
    <!-- Vertically Centered Modal -->
    <div class="col-lg-4 col-md-6">
        <div class="my-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
            Cadastrar Nova Secretaria
            </button>

            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Nova Secretaria</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Nome</label>
                                    <input type="text" id="nameWithTitle" wire:model.defer="secName" class="form-control" placeholder="Nome da Secretaria">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="FormSelect1" class="form-label">Prefeitura</label>
                                    <select class="form-select" id="FormSelect1" wire:model="selectedPrefeitura" aria-label="Default select example">
                                        <option selected value="" >Selecionar Prefeitura</option>
                                        @foreach ($prefeituras as $prefeitura)
                                        <option value="{{ $prefeitura->id }}">{{ $prefeitura->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button wire:click="saveSecretaria" type="button" class="btn btn-primary" data-bs-dismiss="modal">Criar Secretaria</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End modal -->
</div>
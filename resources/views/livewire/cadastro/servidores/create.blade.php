<div>
    <!-- Vertically Centered Modal -->
    <div class="col-lg-4 col-md-6">
        <div class="my-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
            Cadastrar Novo Servidor
            </button>

            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Novo Servidor</h5>
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
                                    <label for="nameWithTitle" class="form-label">CPF</label>
                                    <input type="text" onKeyUp="mascaraCPF(this, value)" id="nameWithTitle" wire:model.defer="servCPF" class="form-control" placeholder="CPF do servidor">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">RG</label>
                                    <input type="text" onKeyUp="mascaraRG(this, value)" id="nameWithTitle" wire:model.defer="servRG" class="form-control" placeholder="RG do servidor">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="FormSelect1" class="form-label">Sexo</label>
                                    <select class="form-select" id="FormSelect1" wire:model="servSex" aria-label="Default select example">
                                        <option selected value="" >Selecione o sexo do servidor</option>
                                        <option value="masculino">Masculino</option>
                                        <option value="feminino">Feminino</option>
                                    </select>
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
                            <button wire:click="createServidor" type="button" class="btn btn-primary" data-bs-dismiss="modal">Cadastrar Servidor</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End modal -->
</div>
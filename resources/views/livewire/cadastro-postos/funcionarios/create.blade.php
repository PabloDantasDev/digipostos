<div>
    <!-- Vertically Centered Modal -->
    <div class="col-lg-4 col-md-6">
        <div class="my-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
            Cadastrar Novo Funcionário
            </button>

            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Novo Funcionário</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Nome</label>
                                    <input type="text" id="nameWithTitle" wire:model.defer="funcName" class="form-control" placeholder="Nome do Funcionário">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">CPF</label>
                                    <input type="text" onKeyUp="mascaraCPF(this, value)" id="nameWithTitle" wire:model.defer="funcCPF" class="form-control" placeholder="CPF do Funcionário">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">RG</label>
                                    <input type="text" onKeyUp="mascaraRG(this, value)" id="nameWithTitle" wire:model.defer="funcRG" class="form-control" placeholder="RG do Funcionário">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="FormSelect1" class="form-label">Sexo</label>
                                    <select class="form-select" id="FormSelect1" wire:model="funcSex" aria-label="Default select example">
                                        <option selected value="" >Selecione o sexo do Funcionário</option>
                                        <option value="masculino">Masculino</option>
                                        <option value="feminino">Feminino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="FormSelect1" class="form-label">Postos</label>
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
                                    <label for="nameWithTitle" class="form-label">Telefone</label>
                                    <input type="text" onkeyup="handlePhone(event)" id="nameWithTitle" wire:model.defer="funcPhone" class="form-control" placeholder="Telefone do Funcionário">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Celular</label>
                                    <input type="text" onkeyup="handlePhone(event)" id="nameWithTitle" wire:model.defer="funcCellphone" class="form-control" placeholder="Celular do Funcionário">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">email</label>
                                    <input type="text" id="nameWithTitle" wire:model.defer="funcEmail" class="form-control" placeholder="Email do Funcionário">
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
                            <button wire:click="createFuncionario" type="button" class="btn btn-primary" data-bs-dismiss="modal">Cadastrar Funcionário</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End modal -->
</div>
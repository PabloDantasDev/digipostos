<div>
    <!-- Vertically Centered Modal -->
    <div class="col-lg-4 col-md-6">
        <div class="my-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
            Cadastrar Nova Prefeitura
            </button>

            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Nova Prefeitura</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Nome</label>
                                    <input type="text" id="nameWithTitle" wire:model.defer="prefName" class="form-control" placeholder="Nome da Prefeitura">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">CNPJ</label>
                                    <input type="text" onKeyUp="mascaraCNPJ(this, value)" id="nameWithTitle" wire:model.defer="prefCNPJ" class="form-control" placeholder="CNPJ da Prefeitura">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Endereço</label>
                                    <input type="text" id="nameWithTitle" wire:model.defer="prefAdress" class="form-control" placeholder="Endereço da Prefeitura">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Cidade</label>
                                    <input type="text" id="nameWithTitle" wire:model.defer="prefCity" class="form-control" placeholder="Cidade da Prefeitura">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="FormSelect1" class="form-label">UF</label>
                                    <select class="form-select" id="FormSelect1" wire:model="prefUF" aria-label="Default select example">
                                        <option selected value="" >Selecione a UF</option>
                                        <option value="AC">Acre</option>
                                        <option value="AL">Alagoas</option>
                                        <option value="AM">Amapá</option>
                                        <option value="BA">Bahia</option>
                                        <option value="CE">Ceará</option>
                                        <option value="DF">Distrito Federal</option>
                                        <option value="ES">Espírito Santo</option>
                                        <option value="GO">Goiás</option>
                                        <option value="MA">Maranhão</option>
                                        <option value="MT">Mato Grosso</option>
                                        <option value="MS">Mato Grosso do Sul</option>
                                        <option value="MG">Minas gerais</option>
                                        <option value="PA">Pará</option>
                                        <option value="PB">Paraíba</option>
                                        <option value="PR">Paraná</option>
                                        <option value="PE">Pernambuco</option>
                                        <option value="PI">Piauí</option>
                                        <option value="RJ">Rio de Janeiro</option>
                                        <option value="RN">Rio Grande do Norte</option>
                                        <option value="RS">Rio Grande do Sul</option>
                                        <option value="RO">Rondônia</option>
                                        <option value="RM">Roraima</option>
                                        <option value="SC">Santa Catarina</option>
                                        <option value="SP">São Paulo</option>
                                        <option value="SE">Sergipe</option>
                                        <option value="TO">Tocantins</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Contato</label>
                                    <input type="text" id="nameWithTitle" wire:model.defer="prefContact" class="form-control" placeholder="Nome do Contato na Prefeitura">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Prefeito</label>
                                    <input type="text" id="nameWithTitle" wire:model.defer="prefMayor" class="form-control" placeholder="Nome do Prefeito">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Telefone</label>
                                    <input type="text" onkeyup="handlePhone(event)" id="nameWithTitle" wire:model.defer="prefPhone" class="form-control" placeholder="Telefone">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Email</label>
                                    <input type="text" id="nameWithTitle" wire:model.defer="prefEmail" class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Senha</label>
                                    <input type="password" id="nameWithTitle" wire:model.defer="prefPassword" class="form-control" placeholder="******">
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-8 mb-3">
                                    <label for="formFileMultiple" class="form-label">Logo</label>
                                    <input class="form-control" wire:model="imageFile" type="file" id="formFile">
                                </div>
                                <div class="col col-4 mb-3 shadow-sm rounded d-flex justify-content-center align-items-center">
                                    @if($imageFile)
                                        <img src="{{ $imageFile->temporaryUrl() }}" alt="product image" style="max-height: 100px; max-width: 100%;">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button wire:click="createPrefeitura" type="button" class="btn btn-primary" data-bs-dismiss="modal">Cadastrar Prefeitura</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End modal -->
</div>
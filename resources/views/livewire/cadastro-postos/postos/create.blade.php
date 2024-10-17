<div>
    <!-- Vertically Centered Modal -->
    <div class="col-lg-4 col-md-6">
        <div class="my-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
            Cadastrar Novo Posto
            </button>

            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Novo Posto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Nome</label>
                                    <input type="text" id="nameWithTitle" wire:model.defer="postoName" class="form-control" placeholder="Nome do posto">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Endereço</label>
                                    <input type="text" id="nameWithTitle" wire:model.defer="postoAdress" class="form-control" placeholder="Endereço do posto">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">CNPJ</label>
                                    <input type="text" onKeyUp="mascaraCNPJ(this, value)" id="nameWithTitle" wire:model.defer="postoCNPJ" class="form-control" placeholder="CNPJ do posto">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Inscrição estadual/inscrição municipal</label>
                                    <input type="text" id="nameWithTitle" wire:model.defer="postoInsc" class="form-control" placeholder="número de inscrição">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Cidade</label>
                                    <input type="text" id="nameWithTitle" wire:model.defer="postoCity" class="form-control" placeholder="Cidade localizado o posto">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="FormSelect1" class="form-label">UF</label>
                                    <select class="form-select" id="FormSelect1" wire:model="postoUF" aria-label="Default select example">
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
                                    <label for="nameWithTitle" class="form-label">Telefone</label>
                                    <input type="text" onkeyup="handlePhone(event)" id="nameWithTitle" wire:model.defer="postoPhone" class="form-control" placeholder="Telefone">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Email</label>
                                    <input type="text" id="nameWithTitle" wire:model.defer="postoEmail" class="form-control" placeholder="Email">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button wire:click="createPosto" type="button" class="btn btn-primary" data-bs-dismiss="modal">Cadastrar Posto</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End modal -->
</div>
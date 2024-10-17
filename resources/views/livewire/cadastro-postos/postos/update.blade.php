<div> 
    <div class="dropdown">
        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
            <div class="dropdown-menu">

            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $postoId }}">
                <i class="bx bx-edit-alt me-1"></i> 
                Editar
            </button>

            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $postoId }}">
                <i class="bx bx-trash me-1"></i> 
                Excluir
            </button>
            
        </div>
    </div>

    <!-- Modal-update -->
    <div wire:ignore.self class="modal fade" id="modalEdit{{ $postoId }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditTitle">Editar {{ $postoName }}</h5>
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
                    <button type="button" wire:click="updatePosto"  class="btn btn-primary">Aplicar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end Modal-update -->

    <!-- Modal-delete -->
    <div wire:ignore.self class="modal fade" id="modalDelete{{ $postoId }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditTitle">Excluir Posto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-wrap">
                    <h4>Deseja realmente excluir o posto "{{ $postoName }}"?</h4>
                    <p>Excluir o posto pode acarretar em perda de todos os dados relacionados a ele.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" wire:click="deletePosto" class="btn btn-danger" data-bs-dismiss="modal">Excluir</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal-delete -->

</div>
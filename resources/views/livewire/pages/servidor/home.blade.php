<div>

    <div class="card">
        <h5 class="card-header">Página do servidor</h5>

        <div class="card-body">
            <div class="row my-3">
                <div class="col-12">
                    <h4 class="mb-0">{{ $name }}</h4>
                    <p class="mt-0">{{ $cpf }}</p>
                </div>
            </div>
            <hr>
            <div class="row my-3 align-items-center">
                <div class="col-12 col-sm-2" style="max-width: 100px; max-height: 100px;">
                    <img src="{{ asset('storage/' . $logo) }}" class="w-100 mb-3" alt="logo">
                </div>
                <div class="col-12 col-sm-5">
                    <h5 class="text-wrap">{{ $prefeitura }}</h5>
                </div>
                <div class="col-12 col-sm-5">
                    <h5 class="text-wrap">{{ $secretaria }}</h5>
                </div>
            </div>
            <hr>
            <div class="row my-3">
                <div class="col-12">
                    <h5 class="text-wrap">{{ $veiculoName }}</h5>
                </div>
                <div class="col-12">
                    <h4 class="mb-0">Placa:</h4><p class="mt-0">{{ $license_plate }}</p>
                </div>
                <div class="col-12">
                    <h4 class="mb-0">Capacidade do tanque(Litros):</h4><p class="mt-0">{{ $tank_capacity }}</p>
                </div>
            </div>
            @if($posto != null || $credits != null)
            <hr>
            <div class="row mt-5 mb-3">
                <div class="col-6">
                    <h6 class="text-wrap">{{ $posto }}</h6>
                </div>
                <div class="col-6 text-center">
                    <h3>Créditos:</h3><h5>{{ $credits }}(L)</h5>
                </div>
            </div>
            @endif

            <div class="row my-5 justify-content-center align-items-center">
                <div class="col-12 text-center">
                    <button wire:click="generate" data-bs-toggle="modal" data-bs-target="#modalCenter" class="btn btn-xl rounded-pill btn-primary">Gerar QR Code</button>
                </div>
            </div>

            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">QR Code</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row" style="w-100">
                                <img src="{{ $qrcode }}" alt="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Voltar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End-Modal -->
        </div>
    </div>
    
</div>

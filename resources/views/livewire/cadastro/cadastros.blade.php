<div>
    <div class="row">
    
        <div class="col-12 justify-content-around">
            <div class="mt-3">
                <!-- Buttons choose components -->
                <button type="button" wire:click="choosePrefeituras" class="btn btn-secondary">
                    Prefeituras
                </button>
                
                <button type="button" wire:click="chooseSecretarias" class="btn btn-secondary">
                    Secretarias
                </button>

                <button type="button" wire:click="chooseVeiculos" class="btn btn-secondary">
                    Veículos
                </button>

                <button type="button" wire:click="chooseServidores" class="btn btn-secondary">
                    Servidores
                </button>
    
                
            </div>
        </div>

    <hr class="my-5">

    <!-- Components -->

    @if ($table == 'prefeituras')
        <livewire:cadastro.prefeituras.show />
    @endif
    @if ($table == 'secretarias')
        <livewire:cadastro.secretarias.show :prefeituraId="$prefeituraId"/>
    @endif
    @if($table == 'veiculos')
        <livewire:cadastro.veiculos.show :secretariaId="$secretariaId" />
    @endif
    @if($table == 'servidores')
        <livewire:cadastro.servidores.show :secretariaId="$secretariaId" />
    @endif

</div>

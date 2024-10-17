<style>
  .container {
      width: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      margin-top: 50px;
      margin-bottom: 50px

    }
    .card-title {
      margin-top: 16px;
    }
  .row {
      justify-content: center;
  }
</style>
<div>
<div class="row">
  <!-- Total Revenue -->
  <div class="col-12 order-2 mb-4">
    <div class="card">
      <div class="row row-bordered g-0">
      <!--
        <div class="col-md-8">
          <h5 class="card-header m-0 me-2 pb-3">Cadastros</h5>

          <div class="card-title d-flex align-item-center justify-content-around text-center w-100">
            <div class="d-flex flex-column my-3">
              <h6>Prefeituras</h6>
              <a href="{{ route('cadastros.secretarias') }}">
                <button type="button" class="btn btn-primary my-2" style="width: 90%">
                  Secretarias
                </button>
              </a>
              <a href="{{ route('cadastros.veiculos') }}">
                <button type="button" class="btn btn-primary my-2" style="width: 90%">
                  Veículos
                </button>
              </a>
              <a href="{{ route('cadastros.servidores') }}">
                <button type="button" class="btn btn-primary my-2" style="width: 90%">
                  Servidores
                </button>
              </a>
            </div>
            <div class="d-flex flex-column my-3">
              <h6>Postos</h6>
              <a href="{{ route('cadastro-postos.postos') }}">
                <button type="button" class="btn btn-primary my-2" style="width: 90%">
                  Postos
                </button>
              </a>
              <a href="{{ route('cadastro-postos.funcionarios') }}">
                <button type="button" class="btn btn-primary my-2" style="width: 90%">
                  Frentistas
                </button>
              </a>
            </div>
            <div class="d-flex flex-column my-3">
              <h6>Creditos</h6>
              <a href="{{ route('creditos') }}">
                <button type="button" class="btn btn-primary my-2" style="width: 90%">
                  Creditos
                </button>
              </a>
            </div>
          </div>

        </div>
        <div class="col-md-4">
          
          <h5 class="card-header m-0 me-2 pb-3">Relatórios</h5>

          <div class="card-title d-flex align-item-center justify-content-around text-center w-100">
            <div class="d-flex flex-column my-3">
              <h6>Relatórios</h6>
              <a href="{{ route('baixas') }}">
                <button type="button" class="btn btn-info my-2" style="width: 90%">
                  Baixas
                </button>
              </a>
            </div>
          </div>
        </div>
        -->
        <div class="container">
          <h5 class="text-center mb4">SOLUÇÃO DE GESTÃO EM COMBUSTÍVEL</h5>
          <h1 class="text-center mb-4">Digifrotas</h1>
          <div class="row text-center">
            <div class="col-md-4">
              <div class="card">
                <h5 class="card-title"><strong> Consumo Geral: </strong></h5>                    
                  <div class="card-body">
                      <p class="card-text"><strong> TOTAL: {{ $general_consumption ? round($general_consumption, 2) : 0 }}L </strong></p>
                  </div>
              </div>
            </div>
            <div class="col-md-4">
                <div class="card">                    
                  <h5 class="card-title"><strong> Consumo de hoje: </strong></h5>
                    <div class="card-body">
                        <p class="card-text"><strong> TOTAL: {{ $today_consumption ? round($today_consumption, 2) : 0 }}L </strong></p>
                    </div>
                </div>
            </div>
        </div>
        </div>
      </div>
    </div>
  </div>
<!--
  @if($fuelLastWeekAverage != null || $fuelLastDayAverage != null)
  
  <div class="col-12 col-md-8 col-lg-4 order-3">
    <div class="row">
      <div class="col-6 mb-4">
        <div class="card">
          <div class="card-body">
            
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/cc-primary.png')}}" alt="Credit Card" class="rounded">
              </div>
            </div>
            @if (isset($fuelLastWeekAverage) && $fuelLastWeekAverage > 0)
              <span class="d-block mb-1">Consumo médio da Última semana por carro por dia</span>
              <h3 class="card-title text-nowrap mb-2">{{ $fuelLastWeekAverage }}L</h3>
              @if($fuelAveragePercent > 0)
                <small class="text-danger fw-medium"><i class='bx bx-up-arrow-alt'></i> {{ $fuelAveragePercent }}%</small>
              @else
                <small class="text-success fw-medium"><i class='bx bx-down-arrow-alt'></i> {{ $fuelAveragePercent }}%</small>
              @endif
            @else
              <span class="fw-semibold d-block mb-1">Ainda não existem da ultima semana.</span>
            @endif
          </div>
        </div>
      </div>
      <div class="col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/cc-success.png')}}" alt="Credit Card" class="rounded">
              </div>
            </div>
            @if (isset($fuelLastDayAverage) && $fuelLastDayAverage > 0)
              <span class="fw-semibold d-block mb-1">Consumo médio do dia por carro</span>
              <h3 class="card-title mb-2">{{ $fuelLastDayAverage }}L</h3>
              @if($fuelDayAveragePercent > 0)
                <small class="text-danger fw-medium"><i class='bx bx-up-arrow-alt'></i> {{ $fuelDayAveragePercent }}%</small>
              @else
                <small class="text-success fw-medium"><i class='bx bx-down-arrow-alt'></i> {{ $fuelDayAveragePercent }}%</small>
              @endif
            @else
              <span class="fw-semibold d-block mb-1">Ainda não existem registro hoje.</span>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  @else
  <div class="col-12 col-md-8 col-lg-4 order-3">
    <div class="row">
      <div class="card">
        <h3 class="my-3">Ainda não existem registros!</h3>
      </div>
    </div>
  </div>
  @endif
  -->
</div>

</div>

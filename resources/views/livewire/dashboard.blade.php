<div>
<!-- Seção de Gestão em Combustível -->
<div class="col-12 order-2 mb-3">
  <div class="card">
    <div class="row row-bordered g-0">
      <div class="container p-4 text-center"> <!-- Adicionei 'text-center' aqui -->
        <h5 class="mb-4">SOLUÇÃO DE GESTÃO EM COMBUSTÍVEL</h5>
        <h1 class="mb-4">Digifrotas</h1>
        <div class="row justify-content-center" >


        
      
        <div class="row mb-2 justify-content-around text-center" style="margin: 10px">
  <!-- Card 1 - Consumo Geral -->
  <div class="col-12 col-md-6 col-lg-4 row rounded border" style="background-color: #f8d7da; border-color: #f5c6cb; ">
      <h5 style="margin-top: 10px">Consumo geral</h5>
      <div class="col">
          <h3>{{ $general_consumption ? round($general_consumption, 2) : 0 }}L</h3>
      </div>   
  </div>

  <!-- Card 2 - Consumo de Hoje -->
  <div class="col-12 col-md-6 col-lg-4 row rounded border" style="background-color: #d4edda; border-color: #c3e6cb; margin: 0 1.9px">
      <h5 style="margin-top: 10px">Consumo de hoje</h5>
      <div class="col">
          <h3>{{ $today_consumption ? round($today_consumption, 2) : 0 }}L</h3>
      </div>
  </div>

  <!-- Card 3 - Consumo Médio/Dia -->
  <div class="col-12 col-md-6 col-lg-4 row rounded border" style="background-color: #d1ecf1; border-color: #bee5eb;">
      <h5 style="margin-top: 10px">Consumo médio/dia</h5>
      <div class="col">
          <h3>{{ $average_daily_consumption ? round($average_daily_consumption, 2) : 0 }}L</h3>
      </div>
  </div>
</div>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- Seção de Gestão em Combustível -->
<div class="col-12 order-2 mb-3">
  <div class="card">
    <div class="row row-bordered g-0">
      <div class="container p-4 text-center">
        <h5 class="mb-4">Informações Gerais Administrativas</h5>
        
        <div class="d-flex justify-content-center flex-wrap">





          <!-- Cartão 1 -->
          <div class="card shadow-sm m-2 d-flex flex-column align-items-center" style="padding: 8px; border-radius: 8px; width: 190px;">
            <!-- Ícone SVG -->
            <img src="{{asset('assets/img/icons/unicons/house.svg')}}" alt="Secretarias" class="rounded mb-2" style="width: 40px; height: 40px;">
            <p class="text-center">Secretarias: {{ $secretariaCount }}</p>
          </div>


          <!-- Cartão 1 -->
          <div class="card shadow-sm m-2 d-flex flex-column align-items-center" style="padding: 8px; border-radius: 8px; width: 190px;">
            <!-- Ícone SVG -->
            <img src="{{asset('assets/img/icons/unicons/car.svg')}}" alt="Secretarias" class="rounded mb-2" style="width: 40px; height: 40px;">
            <p class="text-center">Veiculos: {{ $countVeiculos }}</p>
          </div>
               <!-- Cartão 1 -->
               <div class="card shadow-sm m-2 d-flex flex-column align-items-center" style="padding: 8px; border-radius: 8px; width: 190px;">
            <!-- Ícone SVG -->
            <img src="{{asset('assets/img/icons/unicons/users-round.svg')}}" alt="Secretarias" class="rounded mb-2" style="width: 40px; height: 40px;">
            <p class="text-center">Servidores: {{ $countServidores }}</p>
          </div>

        
        </div>

      </div>
    </div>
  </div>
</div>













  <div class="row">
    <!-- Total Revenue -->
    <div class="col-12 col-lg-8 order-2 mb-4">
      <div class="card">
        <div class="row row-bordered g-0">
          <div class="col-md-8">
            <!-- Seção de Cadastros -->
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
                <h6>Créditos</h6>
                <a href="{{ route('creditos') }}">
                  <button type="button" class="btn btn-primary my-2" style="width: 90%">
                    Créditos
                  </button>
                </a>
              </div>
            </div>
          </div>

          <!-- Título de Relatórios -->
          <div class="col-md-4">
            <h5 class="card-header m-0 me-2 pb-3">Relatórios</h5>

            <div class="card-title d-flex align-items-center justify-content-around text-center w-100">
              <div class="d-flex flex-column my-3">
                <h6></h6>
                <a href="{{ route('baixas') }}">
                  <button type="button" class="btn btn-info my-2" style="width: 90%">
                    Acessar Painel de Relatórios
                  </button>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Seção de Consumo de Combustível -->
    @if($fuelLastWeekAverage != null || $fuelLastDayAverage != null)
    <div class="col-12 col-md-8 col-lg-4 order-3">
      <div class="row">
        <!-- Consumo médio da última semana -->
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
                <span class="fw-semibold d-block mb-1">Ainda não existem dados da última semana.</span>
              @endif
            </div>
          </div>
        </div>

        <!-- Consumo médio do dia -->
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
                <span class="fw-semibold d-block mb-1">Ainda não existem registros hoje.</span>
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
  </div>

</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lucide-icons@latest/dist/lucide.css">

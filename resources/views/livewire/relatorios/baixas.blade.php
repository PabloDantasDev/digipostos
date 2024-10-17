<div>
    @php
        use Carbon\Carbon;
    @endphp
    <!-- Hoverable Table rows -->
      <div class="card">
        <h5 class="card-header">Relatório de baixas</h5>
        <div class="card-body">

        @if ($hasBaixas)
        <form action="{{route('print')}}" target="blank" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-6 col-6 col-lg-2 my-3">
              <label for="intialDate">Data inicial</label>
              <input class="form-control" name="initialDate" wire:model="initialDate" wire:change="chooseVeiculo" max="{{$finalDate ? $finalDate : date('Y-m-d')}}" type="date">
              </div>
              <div class="col-md-6 col-6 col-lg-2 my-3">
                <label for="finalDate">Data Final</label>
                  <input class="form-control" name="finalDate" wire:model="finalDate" wire:change="chooseVeiculo" min="{{$initialDate}}" max="{{date('Y-m-d')}}" type="date">
              </div>
              <div class="col-md-6 col-12 col-lg-3 my-3">
                <label for="search">Pesquisar por secretaria</label>
                <div class="">
                  <select name="secId" id="Secretaria" wire:model="chosenSecretaria" wire:change="chooseVeiculo" class="form-control">
                    <option value="">Todas as secretarias</option>
                    @foreach ($secretarias as $secretaria)
                    <option value="{{$secretaria->id}}">{{$secretaria->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6 col-12 col-lg-2 my-3" wire:ignore >
                <label for="slect2">Pesquisar por placa</label>
                <select class="select2 form-control" id="select2" wire:change="chosenVeiculo" name="veicId" aria-label="Default select example">
                    <option selected value="" >Todas as placa</option>
                    @foreach ($veiculos as $veiculo)
                    <option value="{{ $veiculo->id }}">{{ $veiculo->license_plate }}</option>
                    @endforeach
                </select>
              </div>
              <div class="col-md-6 col-12 col-lg-3 my-3" >
                <label>Pesquisar por combustível</label>
                  <select class="form-select" id="FormSelect1" wire:model="fuelType" aria-label="Default select example">
                      <option selected value="" >Selecionar Combustível</option>
                      @foreach ($combustiveis as $combustivel)
                      <option value="{{ $combustivel->name }}">{{ $combustivel->name }}</option>
                      @endforeach
                  </select>
                <!--<select class="form-control" wire:model="fuelType" wire:change="chooseVeiculo" name="fuelType">
                    <option selected value="" >Todos os combustíveis</option>
                    <option value="GASOLINA">Gasolina</option>
                    <option value="DIESEL">Diesel</option>
                    <option value="GNV">GNV</option>
                    <option value="ETANOL">Etanol</option>
                </select>-->
              </div>
              {{-- <div class="col-sm-3 col-12 d-flex justify-content-center align-items-center">
                <button type="button" wire:click="refresh" class="btn btn-info rounded-pill btn-lg">Limpar filtros</button>
              </div> --}}
            </div>
            
            <div class="d-flex w-100 justify-content-end">
              <button type="submit" class="btn btn-success rounded-pill">Imprimir</button>
            </div>
          </form>
        {{-- averages --}}
        
        <div class="row mb-2 justify-content-around text-center" style="margin-top: 10px">
          <div class="col-12 col-md-6 col-lg-4 row rounded border">
              <h5 style="margin-top: 10px">Consumo geral </h5>
              <div class="col">
                  <h3>{{ $general_consumption ? round($general_consumption, 2) : 0 }}L</h3>
              </div>   
          </div>
          <div class="col-12 col-md-6 col-lg-4 row rounded border">
              <h5 style="margin-top: 10px">Consumo de hoje</h5>
              <div class="col">
                  <h3>{{ $today_consumption ? round($today_consumption, 2) : 0 }}L</h3>
              </div>
          </div>
          <div class="col-12 col-md-6 col-lg-4 row rounded border">
            <h5 style="margin-top: 10px">Consumo médio/dia</h5>
            <div class="col">
                <h3>{{ $average_daily_consumption ? round($average_daily_consumption, 2) : 0 }}L</h3>
            </div>
          </div>
        </div>

        <div class="row">
            <div  class="col-md-6 rounded border" style="display: flex; flex-direction:column; align-items: center; justify-content:center">
              <h5 style="margin-top: 10px;">Consumo geral de combustível</h5>
              @foreach ($fuel_consumption as $fuel)
                <strong>{{ $fuel['name'] }}: {{ $fuel['liters'] }}</strong>
              @endforeach
            </div>
            <div class="col-md-6 rounded border">
              <canvas id="myChart" class="mb-3" style="max-height: 40vh" width="400" height="400"></canvas>
            </div>
        </div>

        <div class="row">

          <div class="col-12 col-sm-6 col-md-6 mb-4">
            <div class="card">
              <div class="card-body">
                
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img src="{{asset('assets/img/icons/unicons/cc-success.png')}}" alt="Credit Card" class="rounded">
                  </div>
                </div>
                <span class="d-block mb-1">Consumo médio por placa de hoje</span>
                <h3 class="card-title text-nowrap mb-2">{{ $fuelLastDayAverage }}L</h3>
                @if($fuelDayAveragePercent > 0)
                  <small class="text-danger fw-medium"><i class='bx bx-up-arrow-alt'></i> {{ $fuelDayAveragePercent }}%</small>
                @else
                  <small class="text-success fw-medium"><i class='bx bx-down-arrow-alt'></i> {{ $fuelDayAveragePercent }}%</small>
                @endif
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-6 mb-4">
            <div class="card">
              <div class="card-body">
                
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img src="{{asset('assets/img/icons/unicons/cc-success.png')}}" alt="Credit Card" class="rounded">
                  </div>
                </div>
                <span class="d-block mb-1">Consumo total de hoje</span>
                <h3 class="card-title text-nowrap mb-2">{{ $fuelDayTotal }}L</h3>
              </div>
            </div>
          </div>
          
        </div>
        {{-- /averages --}}

        <div class="table-responsive text-nowrap">
          <table id="tabela-imprimir" class="table table-hover" style="min-height: 215px;">
            <thead>
              <tr>
                <th>ID</th>
                <th>Placa do veículo</th>
                <th>Combustível(L)</th>
                <th>Secretaria</th>
                <th>Frentista</th>
                <th>Data/hora</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @foreach($baixas as $baixa)
              <tr class="align-top">
                <td><i class="fab fa-angular fa-lg text-danger me-1"></i> <strong>{{ $baixa->id }}</strong></td>
                <td><span>{{ $baixa->veiculo->license_plate }}</span></td>
                <td><span>{{ number_format($baixa->liters, 1, ',', '') }}</span></td>
                <td><span>{{ $baixa->veiculo->secretaria->name }}</span></td>
                <td><span>{{ $baixa->funcionario->name }}</span></td>
                <td><span>{{ Carbon::parse($baixa->date)->setTimezone('-03:00')->format('d/m/Y H:i:s') }}</span></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        
        {{-- <div class="row">
            <div class="col d-flex justify-content-center my-3">
                {{ $baixas->links() }}
            </div>
        </div> --}}
        
          <div class="row">
            <div class="col d-flex justify-content-center my-3">
                {{-- {{ $veiculos->links() }} --}}
              <ul class="pagination">
                <!-- Botão "Anterior" -->
                <li class="page-item cursor-pointer {{ $baixas->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" wire:click="previousPage" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <!-- Elementos de paginação -->
                @for ($i = max(1, $baixas->currentPage() - $maxPages); $i <= min($baixas->lastPage(), $baixas->currentPage() + $maxPages); $i++)
                  <li class="page-item {{ $i == $baixas->currentPage() ? 'active' : '' }}">
                        <a class="page-link" wire:click="gotoPage({{ $i }})" href="#">{{ $i }}</a>
                  </li>
                @endfor

                <!-- Botão "Próximo" -->
                <li class="page-item cursor-pointer {{ $baixas->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" wire:click="nextPage" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
              </ul>
            </div>
          </div>

        </div>
      </div>

      @else
      <div class="row justify-content-center">
        <h3 class="my-3 col-12 text-center">Ainda não existem registros!</h3>
      </div>
      @endif

      @push('scripts')
        <script>
          document.addEventListener('livewire:load', function () {
              var labels = []; // Array para armazenar as labels
              var datasets = []; // Array para armazenar os datasets

              // Inicialmente, preenchemos labels e datasets
              var baixasData = @this.baixasData;
              Object.keys(baixasData).forEach(function(tipo) {
                  labels = Object.keys(baixasData[tipo]);
                  var backgroundColor;
                  var borderColor;

                  // Define cores com base no tipo de combustível
                  if (tipo.toUpperCase() === 'GASOLINA') {
                      backgroundColor = 'rgba(0, 200, 0, 0.2)';
                      borderColor = 'rgba(0, 200, 0, 1)';
                  } else if (tipo.toUpperCase() === 'DIESEL') {
                      backgroundColor = 'rgba(255, 255, 0, 0.2)';
                      borderColor = 'rgba(200, 200, 0, 1)';
                  } else if (tipo.toUpperCase() === 'GNV') {
                      backgroundColor = 'rgba(255, 165, 0, 0.2)';
                      borderColor = 'rgba(255, 165, 0, 1)';
                  } else if (tipo.toUpperCase() === 'ETANOL') {
                      backgroundColor = 'rgba(255, 0, 255, 0.2)';
                      borderColor = 'rgba(255, 0, 255, 1)';
                  } else if (tipo.toUpperCase() === 'TOTAL') {
                      backgroundColor = 'rgba(54, 162, 235, 0.2)';
                      borderColor = 'rgba(54, 162, 235, 1)';
                  }

                  datasets.push({
                      label: tipo,
                      data: Object.values(baixasData[tipo]),
                      backgroundColor: backgroundColor,
                      borderColor: borderColor,
                      borderWidth: 1
                  });
              });

              var labels = []; // Array para armazenar as labels
              var datasets = []; // Array para armazenar os datasets
              baixasData.forEach(function (fuel) {
                labels.push(fuel.name);
                datasets.push(fuel.liters);
              });
              var ctx = document.getElementById('myChart').getContext('2d');
              var myChart = new Chart(ctx, {
                  type: 'pie',
                  data: {
                    labels: labels,
                    datasets: [{
                      label: 'Litros',
                      data: datasets,
                      hoverOffset: 4
                    }],
                    options: {
                      plugins: {
                        legend: {
                          position: 'top',
                        },
                        title: {
                          display: true,
                          text: 'Consumo geral por combustível'
                        }
                      }
                    }
                  }
              });

              Livewire.on('refreshChart', function () {
                  var baixasData = @this.baixasData;
                  
                  datasets = []; // Limpa os datasets antigos
                  Object.keys(baixasData).forEach(function(tipo) {
                      labels = Object.keys(baixasData[tipo]);
                      var backgroundColor;
                      var borderColor;

                      // Define cores com base no tipo de combustível
                      if (tipo.toUpperCase() === 'TOTAL') {
                          backgroundColor = 'rgba(54, 162, 235, 0.2)';
                          borderColor = 'rgba(54, 162, 235, 1)';
                      } else if (tipo.toUpperCase() === 'GASOLINA') {
                          backgroundColor = 'rgba(0, 255, 0, 0.2)';
                          borderColor = 'rgba(0, 255, 0, 1)';
                      } else if (tipo.toUpperCase() === 'DIESEL') {
                          backgroundColor = 'rgba(255, 255, 0, 0.2)';
                          borderColor = 'rgba(200, 200, 0, 1)';
                      } else if (tipo.toUpperCase() === 'GNV') {
                          backgroundColor = 'rgba(255, 165, 0, 0.2)';
                          borderColor = 'rgba(255, 165, 0, 1)';
                      } else if (tipo.toUpperCase() === 'ETANOL') {
                          backgroundColor = 'rgba(255, 0, 255, 0.2)';
                          borderColor = 'rgba(255, 0, 255, 1)';
                      }

                      datasets.push({
                          label: tipo,
                          data: Object.values(baixasData[tipo]),
                          backgroundColor: backgroundColor,
                          borderColor: borderColor,
                          borderWidth: 1
                      });
                  });

                  var labels = []; // Array para armazenar as labels
                  var datasets = []; // Array para armazenar os datasets
                  myChart.data.labels.pop();
                  myChart.data.datasets.forEach((dataset) => {
                      dataset.data.pop();
                  });
                  baixasData.forEach(function (fuel) {
                    myChart.data.datasets.forEach((dataset) => {
                        dataset.data.push(fuel.liters);
                    });
                  });

                  // Atualiza o gráfico com os novos datasets e labels
                  //myChart.data.labels = labels;
                  //myChart.data.datasets = datasets;
                  myChart.update();
              });
          });
            
            
            $('#select2').on('change', function (e) {
                
                Livewire.emit('chooseVeiculo', e.target.value);
            });
            
        </script>
      @endpush
</div>

@php
    use Carbon\Carbon;
    use App\Models\Veiculo;
    use App\Models\Secretaria;

@endphp
@extends('layouts/blankLayout')

@section('title', 'Relatório')

@section('content')

<div class="my-3 mx-2">
    <div class="mb-2">
        <span style="font-weight: bold;">Filtros: </span>
        @if($initialDate)
            <span>a partir de: "{{ Carbon::parse($initialDate)->format('d/m/Y') }}". </span>
        @endif
        @if($finalDate)
            <span>até: "{{ Carbon::parse($finalDate)->format('d/m/Y') }}". </span>
        @endif
        @if($veicId)
            <span>Placa: "{{ Veiculo::find($veicId)->license_plate }}". </span>
        @endif
        @if($secId)
            <span>Secretaria: "{{ Secretaria::find($secId)->name }}". </span>
        @endif
        @if($fuelType)
            <span>Combustível: "{{ $fuelType }}". </span>
        @endif
    </div>
    <div class="row mb-2 justify-content-around text-center">
        <div class="col-4 row rounded border">
            <h5>Consumo médio por dia </h5>
            @if($veicFuelAverage)
                <div class="col">
                    <h6>do veículo:</h6>
                    <h3>{{ $veicFuelAverage }}L</h3>
                </div>
            @endif
            <div class="col">
                <h6>Geral:</h6>
                <h3>{{ $fuelAverage }}L</h3>
            </div>
        </div>
        <div class="col-4 row rounded border">
            <h5>Consumo Total</h5>
            @if($veicTotalFuel)
                <div class="col">
                    <h6>do veículo:</h6>
                    <h3>{{ $veicTotalFuel }}L</h3>
                </div>
            @endif
            <div class="col">
                <h6>geral:</h6>
                <h3>{{ $totalGeralFuel }}L</h3>
            </div>
        </div>
        <div class="col-4 row rounded border">
            <h5>Consumo de combustível</h5>
            @if($totalGasolina)
                <div class="col">
                    <h6>Gasolina</h6>
                    <h3>{{ $totalGasolina }}L</h3>
                </div>
            @endif
            @if($totalDiesel)
                <div class="col">
                    <h6>Diesel</h6>
                    <h3>{{ $totalDiesel }}L</h3>
                </div>
            @endif
        </div>
    </div>
    <canvas id="myChart" style="max-height: 40vh;" width="400" height="400"></canvas>
</div>


<div class="table-responsive text-wrap">
    <table id="tabela-imprimir" class="table table-hover" style="min-height: 215px;">
      <thead>
        <tr>
          <th>Placa do veículo</th>
          <th>Combustível(L)</th>
          <th>Tipo</th>
          <th>Secretaria</th>
          <th>Frentista</th>
          <th>Data/hora</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($baixas as $baixa)
        <tr class="align-top">
          <td><span>{{ $baixa->veiculo->license_plate }}</span></td>
          <td><span>{{ number_format($baixa->liters, 1, ',', '') }}</span></td>
          <td><span>{{ strToUpper($baixa->veiculo->fuel) }}</span></td>
          <td><span>{{ strToUpper($baixa->veiculo->secretaria->name) }}</span></td>
          <td><span>{{ $baixa->funcionario->name }}</span></td>
          <td><span>{{ Carbon::parse($baixa->date)->setTimezone('-03:00')->format('d/m/Y H:i:s') }}</span></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  

@push('scripts')
<script>
    var labels = []; // Array para armazenar as labels
    var datasets = []; // Array para armazenar os datasets

    var baixasData = {!! json_encode($baixasData) !!};
    
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

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: datasets
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    window.onload = function() {
        setTimeout(function () {
            window.print();
        }, 1300);
    };
</script>
@endpush
@endsection

<!DOCTYPE html>

<html lang="pt-br" class="light-style layout-menu-fixed" data-theme="theme-default" data-assets-path="{{ asset('/assets') . '/' }}" data-base-url="{{url('/')}}" data-framework="laravel" data-template="vertical-menu-laravel-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>@yield('title')</title>
  <meta name="description" content="{{ config('variables.templateDescription') ? config('variables.templateDescription') : '' }}" />
  <meta name="keywords" content="{{ config('variables.templateKeyword') ? config('variables.templateKeyword') : '' }}">
  <!-- laravel CRUD token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Canonical SEO -->
  <link rel="canonical" href="{{ config('variables.productPage') ? config('variables.productPage') : '' }}">
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/canguaretama.ico') }}" />

  

  <!-- Include Styles -->
  @include('layouts/sections/styles')
  @livewireStyles
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
  
  <!-- Include Scripts for customizer, helper, analytics, config -->
  @include('layouts/sections/scriptsIncludes')
</head>

<body>
  

  <!-- Layout Content -->
  @yield('layoutContent')
  <!--/ Layout Content -->

  

  <!-- Include Scripts -->
  @include('layouts/sections/scripts')
  @livewireScripts
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    String.prototype.reverse = function(){
        return this.split('').reverse().join(''); 
    };

    function mascaraMoeda(campo,evento){
        var tecla = (!evento) ? window.event.keyCode : evento.which;
        var valor  =  campo.value.replace(/[^\d]+/gi,'').reverse();
        var resultado  = "";
        var mascara = "########.##".reverse();
        for (var x=0, y=0; x<mascara.length && y<valor.length;) {
            if (mascara.charAt(x) != '#') {
            resultado += mascara.charAt(x);
            x++;
            } else {
            resultado += valor.charAt(y);
            y++;
            x++;
            }
    }
    campo.value = resultado.reverse();
    }

    function mascaraMoeda2(campo,evento){
        var tecla = (!evento) ? window.event.keyCode : evento.which;
        var valor  =  campo.value.replace(/[^\d]+/gi,'').reverse();
        var resultado  = "";
        var mascara = "########.##".reverse();
        for (var x=0, y=0; x<mascara.length && y<valor.length;) {
            if (mascara.charAt(x) != '#') {
            resultado += mascara.charAt(x);
            x++;
            } else {
            resultado += valor.charAt(y);
            y++;
            x++;
            }
        }
    campo.value = resultado.reverse();
    }

    function mascaraData(campo,evento){
        var tecla = (!evento) ? window.event.keyCode : evento.which;
        var valor  =  campo.value.replace(/[^\d]+/gi,'').reverse();
        var resultado  = "";
        var mascara = "##/##/####".reverse();
        for (var x=0, y=0; x<mascara.length && y<valor.length;) {
            if (mascara.charAt(x) != '#') {
            resultado += mascara.charAt(x);
            x++;
            } else {
            resultado += valor.charAt(y);
            y++;
            x++;
            }
        }
    campo.value = resultado.reverse();
    }

    const handlePhone = (event) => {
      let input = event.target
      input.value = phoneMask(input.value)
    }

    const phoneMask = (value) => {
      if (!value) return ""
      value = value.replace(/\D/g,'')
      value = value.replace(/(\d{2})(\d)/,"($1) $2")
      value = value.replace(/(\d)(\d{4})$/,"$1-$2")
      return value
    }

    function mascaraCNPJ(campo,evento){
        var tecla = (!evento) ? window.event.keyCode : evento.which;
        var valor  =  campo.value.replace(/[^\d]+/gi,'').reverse();
        var resultado  = "";
        var mascara = "##.###.###/####-##".reverse();
        for (var x=0, y=0; x<mascara.length && y<valor.length;) {
            if (mascara.charAt(x) != '#') {
            resultado += mascara.charAt(x);
            x++;
            } else {
            resultado += valor.charAt(y);
            y++;
            x++;
            }
        }
    campo.value = resultado.reverse();
    }
    function mascaraCPF(campo,evento){
        var tecla = (!evento) ? window.event.keyCode : evento.which;
        var valor  =  campo.value.replace(/[^\d]+/gi,'').reverse();
        var resultado  = "";
        var mascara = "###.###.###-##".reverse();
        for (var x=0, y=0; x<mascara.length && y<valor.length;) {
            if (mascara.charAt(x) != '#') {
            resultado += mascara.charAt(x);
            x++;
            } else {
            resultado += valor.charAt(y);
            y++;
            x++;
            }
        }
    campo.value = resultado.reverse();
    }
    function mascaraRG(campo,evento){
        var tecla = (!evento) ? window.event.keyCode : evento.which;
        var valor  =  campo.value.replace(/[^\d]+/gi,'').reverse();
        var resultado  = "";
        var mascara = "###.###.###".reverse();
        for (var x=0, y=0; x<mascara.length && y<valor.length;) {
            if (mascara.charAt(x) != '#') {
            resultado += mascara.charAt(x);
            x++;
            } else {
            resultado += valor.charAt(y);
            y++;
            x++;
            }
        }
    campo.value = resultado.reverse();
    }
    function mascaraAno(campo,evento){
        var tecla = (!evento) ? window.event.keyCode : evento.which;
        var valor  =  campo.value.replace(/[^\d]+/gi,'').reverse();
        var resultado  = "";
        var mascara = "####".reverse();
        for (var x=0, y=0; x<mascara.length && y<valor.length;) {
            if (mascara.charAt(x) != '#') {
            resultado += mascara.charAt(x);
            x++;
            } else {
            resultado += valor.charAt(y);
            y++;
            x++;
            }
        }
    campo.value = resultado.reverse();
    }

    
    // For Select2 4.1
    $(".select2").select2({
        theme: "bootstrap-5",
        selectionCssClass: "select2--small",
        dropdownCssClass: "select2--small",
    });
    
</script>
@stack('scripts')
</body>

</html>

<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
      <h6>{{ $time }}</h6>
</div>

<script>
    document.addEventListener('livewire:load', function () {
        setInterval(function () {
            Livewire.emit('updateTime');
        }, 1000); // Atualiza a cada 1 segundo
    });
</script>

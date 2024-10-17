
<div class="position-relative w-100">
    @if ($message)
        <div id="flash-message-div" wire:poll.5000ms="reloadMessage" class="alert alert-{{ $type }} position-fixed start-50 translate-middle-x">
            {{ $message }}
        </div>
    @endif
</div>
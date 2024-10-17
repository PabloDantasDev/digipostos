<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class ServerTime extends Component
{
    public $time;

    public function mount()
    {
        $this->updateTime();
    }

    public function updateTime()
    {
        $this->time = Carbon::now()->subHours(3)->format('d/m/Y');
    }
    
    public function render()
    {
        return view('livewire.server-time');
    }
}

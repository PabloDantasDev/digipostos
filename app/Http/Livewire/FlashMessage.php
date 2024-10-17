<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FlashMessage extends Component
{
      
    protected $listeners = ['flashMessage' => 'showMessage'];

    public $message;
    public $type;

    public function showMessage($message, $type = 'success')
    {
        $this->message = $message;
        $this->type = $type;


        $this->dispatchBrowserEvent('flash-message');
    }

    public function reloadMessage() {
        $this->message = null;

    }

    public function render()
    {
        return view('livewire.flash-message');
    }
}
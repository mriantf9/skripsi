<?php

namespace App\Http\Livewire\Counter;

use Livewire\Component;

class CounterIndex extends Component
{
    public $counter = 0;

    protected $listeners = [
        'increase',
        'decrease'
    ];

    public function increase()
    {
        // dd('trigered');
        $this->emit('increase', $this->counter++);;
    }

    public function decrease()
    {
        dd('trigered');

        if ($this->counter < 1) {

            $this->counter = 1;
        }
        $this->counter--;
    }
    public function render()
    {
        return view('livewire.counter.counter-index');
    }
}

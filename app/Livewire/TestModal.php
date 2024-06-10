<?php

namespace App\Livewire;

use Livewire\Component;

class TestModal extends Component
{
    public $confirmingTestModal = false;

    public function testModal()
    {
        $this->confirmingTestModal = true;
    }

    public function proceedWithTest()
    {
        // Your logic for proceeding with the test
        $this->confirmingTestModal = false;
    }
    public function render()
    {
        return view('livewire.test-modal');
    }
}

<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Paperwork;
use App\Models\PaperworkDetails;

class PaperworkClubStatus extends Component
{
    public function render()
    {
        $id = request()->route('id');
        return $this->show($id);
    }

    public function show($id)
    {
        $paperwork = Paperwork::find($id);
        return view('livewire.paperwork-status', compact('paperwork'));
    }
}

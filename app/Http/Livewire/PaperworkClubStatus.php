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

        // convert $paperwork->progressStates to array if not null, not using explode() because it will return an array with one element if the string is empty
        if ($paperwork->progressStates != null) {
            $paperwork->progressStates = json_decode($paperwork->progressStates);
        } else {
            $paperwork->progressStates = null;
        }

        return view('livewire.paperwork-status', compact('paperwork'));
    }
}

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

    public function updatePaperworkStatus(Request $request, $id)
    {
        $paperwork = Paperwork::find($id);

        if (auth()->user()->role == 2) {
            if ($request->paperwork_updateStatus == "Lulus") {
                $paperwork->status = 2;
                $paperwork->currentProgressState = 2;
            } else {
                $paperwork->status = 0;
                $paperwork->currentProgressState = 0;
            }
        } else if (auth()->user()->role == 0) {
            if ($request->paperwork_updateStatus == "Lulus") {
                $paperwork->status = 3;
                $paperwork->currentProgressState = 3;
            } else {
                $paperwork->status = 1;
                $paperwork->currentProgressState = 1;
            }
        }
        
        $paperwork->save();

        return redirect()->back()
            ->with('updated', 'Kertas kerja ini telah diluluskan.');
    }
}

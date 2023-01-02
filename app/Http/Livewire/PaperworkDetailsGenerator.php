<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Paperwork;
use App\Models\PaperworkDetails;

class PaperworkDetailsGenerator extends Component
{
    public function render()
    {
        $id = request()->route('id');
        return $this->generator($id);
    }

    public function generator($id)
    {
        $paperwork = Paperwork::find($id);
        $paperworkDetails = PaperworkDetails::find($paperwork->paperworkDetailsId);
        return view('livewire.paperwork-details-generator', compact('paperwork', 'paperworkDetails'));
    }

    public function update(Request $request, $id)
    {
        $paperwork = Paperwork::find($id);
        $paperworkDetails = PaperworkDetails::find($paperwork->paperworkDetailsId);

        $paperworkDetails->update($request->all());

        return redirect()->route('paperwork-club-status', $paperwork->id);
    }
}

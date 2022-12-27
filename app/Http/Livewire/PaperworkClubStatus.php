<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Paperwork;

class PaperworkClubStatus extends Component
{
    public function render()
    {
        // get the id of the paperwork from the url parameter
        $id = request()->route('id');
        // $paperwork = Paperwork::find(4);
        // return view('livewire.paperwork-status', compact('paperwork'));
        return $this->show($id);
    }

    public function show($id)
    {
        $paperwork = Paperwork::find($id);
        return view('livewire.paperwork-status', compact('paperwork'));
    }

    // public function render($view, $data = [])
    // {
    //     return view($view, $data);
    // }
    // public function view($id)
    // {
    //     $paperwork = Paperwork::find($id);
    //     return $this->render('livewire.paperwork-status', ['paperwork' => $paperwork]);
    // }
}

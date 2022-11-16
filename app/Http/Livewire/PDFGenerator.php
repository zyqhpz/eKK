<?php

namespace App\Http\Livewire;

use Livewire\Component;
use PDF;

class PDFGenerator extends Component
{
    public function render()
    {
        return view('livewire.pdf-generator');
    }

    public function viewPDF()
    {
        // $pdf = PDF::loadView('livewire.pdf-generator');
        $pdf = PDF::loadHTML('<h1>Test</h1>');
        return $pdf->stream();
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Http\Request;

use PDF;

class PDFGenerator extends Component
{
    public function render()
    {
        return view('livewire.pdf-generator');
    }

    public function viewPDF(Request $request)
    {
        // $pdf = PDF::loadView('livewire.pdf-generator');


        // get $request->all() data
        $data = $request->all();

        // dd($request->all());

        

        // var_dump

        // get program_name from request
        // $program_name = $request->program_name;

        // $program_name = $request->input('program-name');

        $title = '<h1>Kertas Kerja</h1>' . $data['program_name'];

        // $date_type = $data['program_date_type'];

        if ($request->has('program_date_type')) {
            $date = $data['program_date'];
        } else {
            $date = $data['program_date_start'] . ' - ' . $data['program_date_end'];
        }

        // $date = $data['date'];
        

        $pdf = PDF::loadHTML($title . '<h2>Tarikh</h2><p>' . $date . '</p>');
        return $pdf->stream();
    }
}

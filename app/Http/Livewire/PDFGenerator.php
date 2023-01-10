<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Http\Request;

use App\Models\Paperwork;
use App\Models\PaperworkDetails;

use PDF;

class PDFGenerator extends Component
{
    public function render()
    {
        return view('livewire.pdf-generator');
    }

    public function viewGeneratedPDF($id) {

        $paperwork = Paperwork::find($id);
        $paperworkDetails = PaperworkDetails::find($paperwork->paperworkDetailsId);

        // $pdf = new PDF();

        $data = [
            'paperwork' => $paperwork,
            'paperworkDetails' => $paperworkDetails
        ];

        $pdf = PDF::loadView('livewire.paperwork-pdf', $data);

        // $pdf->set_option('defaultFont', 'Arial');
        

        // $pdf = PDF::loadHTML('<h2>Tarikh</h2>');

        // loadHTML
        // $pdf->loadHTML('<h1>Kertas Kerja</h1>' . $paperworkDetails->programName . '<h2>Tarikh</h2><p>' . $paperworkDetails->programDate . '</p>');


        // $pdf->set_default_font('dejavusans');

        $pdf->render();
        return $pdf->stream();
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

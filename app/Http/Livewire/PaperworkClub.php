<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\User;
use App\Models\Paperwork;
use App\Models\PaperworkDetails;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

use App\Mail\StatusUpdateMail;
use App\Http\Controllers\MailController;

use App\Http\Livewire\PDFGenerator;

use PDF;
use File;
use Response;

class PaperworkClub extends Component
{
    public function render()
    {
        $paperworks = null;
        // admin
        if (auth()->user()->role == 0) {
            // $paperworks = Paperwork::where('status', '>', 1)->get();
            $paperworks = Paperwork::where('currentProgressState', '>', 1)->get();
        }

        // club
        if (auth()->user()->role == 1) {
            $paperworks = Paperwork::where('clubId', auth()->user()->id)->get();
        }

        // advisor
        if (auth()->user()->role == 2) {
            $paperworks = Paperwork::where('clubId', auth()->user()->advisorOf)->where('status', '>', 0)->get();
        }

        // HEPA
        if (auth()->user()->role == 3) {
            $paperworks = Paperwork::where('currentProgressState', '>', 1)->get();
        }

        // TNC (HEPA)
        if (auth()->user()->role == 4) {
            $paperworks = Paperwork::where('currentProgressState', '>', 2)->get();
        }

        // NC
        if (auth()->user()->role == 5) {
            $paperworks = Paperwork::where('currentProgressState', '>', 3)->where('status', '>=', 1)->get();
        }

        return view('livewire.paperwork-club', compact('paperworks'));
    }

    public function show($id)
    {
        $paperwork = Paperwork::find($id);
        return view('livewire.paperwork-club-status', compact('paperwork'));
    }

    public function viewStatus()
    {
        // $paperworks = Paperwork::all();
        // return view('livewire.paperwork-status', compact('paperworks'));
        return view('livewire.paperwork-status');
    }

    public function viewFinanceDetails($id){
        $paperwork = Paperwork::find($id);

        // open file
        $file = public_path('paperworks/' . $paperwork->filePath);

        // run python script
        $process = new Process(['python', 'python/detector.py', $file]);
        $process->run();

        $output = $process->getOutput();

        // redirect to previous page with the output
        return redirect()->back()->with('output', $output);
    }

    public function viewPDF($id)
    {
        $paperwork = Paperwork::find($id);
        // load the file in $path and stream it
        return Response::make(file_get_contents(public_path('paperworks/' . $paperwork->filePath)), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$paperwork->filePath.'"'
        ]);

    }

    public function store(Request $request)
    {
        $name = $request->paperwork_name;

        // get the value of the radio paperwork_isGenerated and convert it to boolean value
        $isGenerated = $request->input('paperwork_isGenerated') == '1' ? true : false;
        $filePath = $request->paperwork_file;

        // get user id from User session 
        $userId = auth()->user()->id;
        $clubId = $userId;

        if ($request->hasFile('paperwork_file')) {
            $doc = $request->file('paperwork_file');
            $path = 'KK'.date('YmdHis').'.'.$doc->getClientOriginalExtension();
            $doc->move('paperworks/', $path); 
        } else {
            $path = "-";
        }


        PaperworkDetails::create([
        ]);

        // get the last inserted paperworkDetails id
        $paperworkDetailsId = PaperworkDetails::latest()->first()->id;
        
        Paperwork::create([
            'name' => $name,
            'isGenerated' => $isGenerated,
            'filePath' => $path,
            'clubId' => $clubId,
            'status' => 0,
            'progressStates' => "[]",
            'currentProgressState' => 0,
            'isOneDay' => 1,
            'paperworkDetailsId' => $paperworkDetailsId
        ]);

        // redirect to previous page
        return redirect()->back()
            ->with('created', 'Kertas kerja telah berjaya ditambah.');
    }

    public function update(Request $request, $id) 
    {
        $paperwork = Paperwork::find($id);

        if ($request->hasFile('paperwork_file')) {
            $doc = $request->file('paperwork_file');
            $path = 'KK'.date('YmdHis').'.'.$doc->getClientOriginalExtension();
            $doc->move('paperworks/', $path); 
        } else {
            $path = "-";
        }

        // if $request->name is null, use the old name
        $paperwork->name = $request->paperwork_name ?? $paperwork->name;
        $paperwork->isGenerated = $request->paperwork_isGenerated ?? $paperwork->isGenerated;
        $paperwork->filePath = $path ?? $paperwork->filePath;

        $paperwork->save();

        return redirect()->back()
            ->with('updated', 'Kertas kerja berjaya dikemaskini.');
    }

    public function delete($id)
    {
        $paperwork = Paperwork::find($id);
        $paperwork->delete();

        return redirect()->back()
            ->with('deleted', 'Kertas kerja berjaya dipadam.');
    }

    public function submit(Request $request, $id)
    {
        $paperwork = Paperwork::find($id);
        $paperworkDetails = PaperworkDetails::find($paperwork->paperworkDetailsId);
        $paperwork->status = 1;

        $progression = array(
            0 => "Draf",
            1 => "Penasihat Kelab",
            2 => "HEPA",
            3 => "TNC (HEPA)"
        );

        $progression_NC = array(
            0 => "Draf",
            1 => "Penasihat Kelab",
            2 => "HEPA",
            3 => "TNC (HEPA)",
            4 => "NC",
        );

        if ($paperwork->isGenerated == 1) {

            $pdf_generator = new PDFGenerator();
            if ($paperworkDetails->financialImplication != null && $paperworkDetails->financialImplication != "") {

                $financialImplication = $pdf_generator->calculateTotalImplication($paperworkDetails->financialImplication);

                $total_all = 0;
        
                foreach ($financialImplication['totalByRemark'] as $key => $value) {
                    $total_all += $value;
                }
    
                if ($total_all >= 20000) {
                    $paperwork->progressStates = json_encode($progression_NC);
                } else {
                    $paperwork->progressStates = json_encode($progression);
                }
            } else {
                return redirect()->back()
                    ->with('error', 'Sila isi maklumat dengan lengkap terlebih dahulu.');
                    // ->with('error', 'Sila isi maklumat kewangan terlebih dahulu.');
            }
        } else {

            // use AI Python Detector

            // open file
            $file = public_path('paperworks/' . $paperwork->filePath);
                        
            try {
                // run python script
                if (config('app.env') == 'local')
                    $process = new Process(['python', 'python/detector.py', $file]);
                else
                    $process = new Process(['python3', 'python/detector.py', $file]);
                // $process->run();
                $process->mustRun();

                $output = $process->getOutput();
            } catch (ProcessFailedException $exception) {
                $message = $exception->getMessage();
            }

            // remove comma from string
            $int_string = filter_var($output, FILTER_SANITIZE_NUMBER_INT);

            $new_int = intval($int_string) / 100;

            if ($new_int >= 20000) {
                $paperwork->progressStates = json_encode($progression_NC);
            } else {
                $paperwork->progressStates = json_encode($progression);
            }

            $program_date = "";

            try {
                if (config('app.env') == 'local')
                    $process = new Process(['python', 'python/date-detector.py', $file]);
                else
                    $process = new Process(['python3', 'python/date-detector.py', $file]);

                $process->mustRun();

                $program_date = $process->getOutput();
            } catch (ProcessFailedException $exception) {
                $message = $exception->getMessage();
            }

            // check if program_date has [] or not
            if (strpos($program_date, '[') !== false) {

                // remove [] from string
                $program_date = str_replace("[", "", $program_date);
                $program_date = str_replace("]", "", $program_date);

                // convert string to array
                $program_date = explode(",", $program_date);

                // remove ' and space from string
                foreach ($program_date as $key => $value) {
                    $program_date[$key] = str_replace("'", "", $value);
                    $program_date[$key] = str_replace(" ", "", $program_date[$key]);
                }

                $paperwork->programDateStart = $program_date[0];
                $paperwork->programDateEnd = $program_date[1];

                $paperwork->isOneDay = 0;
            } else {
                $paperwork->programDate = $program_date;

                $paperwork->isOneDay = 1;
            }
        }

        $mailController = new MailController();
        $mailController->sendEmail($paperwork->id,"update");
        $paperwork->currentProgressState = 1;

        $paperwork->save();

        return redirect()->back()
            ->with('submitted', 'Kertas kerja berjaya dihantar.');
    }
}

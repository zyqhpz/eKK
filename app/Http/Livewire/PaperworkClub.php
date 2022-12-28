<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Paperwork;

use Symfony\Component\Process\Process;

use PDF;
use File;
use Response;

class PaperworkClub extends Component
{
    public function render()
    {
        $paperworks = Paperwork::all();
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
        // $file = public_path('paperworks/' . $paperwork->filePath);
        $file = file_get_contents(public_path('paperworks/' . $paperwork->filePath));

        // run the python script in resources/python/detector.py
        $process = new Process(['python', 'resources/python/detector.py', $file]);
        $process->run();

        // get the output of the python script
        $output = $process->getOutput();

        dd($output);

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
        
        Paperwork::create([
            'name' => $name,
            'isGenerated' => $isGenerated,
            'filePath' => $path,
            'clubId' => $clubId,
        ]);

        // redirect to previous page
        return redirect()->back()
            ->with('success', 'Paperwork created successfully.');
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
            ->with('success', 'Kertas kerja berjaya dikemaskini.');
    }

    public function delete($id)
    {
        $paperwork = Paperwork::find($id);
        $paperwork->delete();

        return redirect()->back()
            ->with('success', 'Paperwork deleted successfully.');
    }
}

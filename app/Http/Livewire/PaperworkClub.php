<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Paperwork;

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
            $path = $request->file('paperwork_file')->store('public/paperworks');
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
        $paperwork->update([
            'name' => $request->paperwork_name,
            'filePath' => $request->paperwork_file
        ]);

        return redirect()->back()
            ->with('success', 'Paperwork updated successfully.');
    }

    public function delete($id)
    {
        $paperwork = Paperwork::find($id);
        $paperwork->delete();

        return redirect()->back()
            ->with('success', 'Paperwork deleted successfully.');
    }
}

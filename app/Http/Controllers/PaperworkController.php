<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paperwork;
use App\Models\User;

class PaperworkController extends Controller
{
    public function index()
    {
        return view('paperwork.index');
    }

    public function create()
    {
        return view('paperwork.create');
    }
    
    public function store(Request $request)
    {
        $name = $request->paperwork_name;

        // get the value of the radio paperwork_isGenerated and convert it to boolean value
        $isGenerated = $request->input('paperwork_isGenerated') == '1' ? true : false;
        $filePath = $request->paperwork_file;
        // try {

        // get user id from User session 
        $userId = auth()->user()->id;

        $clubId = $userId;
        // } catch (\Throwable $th) {
        //     $filePath = null;
        // }

        // print in console
        // dd($name, $isGenerated, $filePath);

        // validate the request data, filePath is required if isGenerated is false
        // $request->validate([
        //     'name' => 'required',
        //     'isGenerated' => 'required',
        //     'filePath' => 'required_if:isGenerated,false',
        // ]);

        if ($request->hasFile('paperwork_file')) {
            // $request->validate([
            //     'paperwork_file' => 'required|mimes:pdf|max:2048',
            // ]);
            
            $path = $request->file('paperwork_file')->store('public/paperworks');
        } else {
            $path = "-";
        }

        // $path = $request->file('paperwork_file')->store('public/paperworks');
        
        Paperwork::create([
            'name' => $name,
            'isGenerated' => $isGenerated,
            'filePath' => $path,
            'clubId' => $clubId,
        ]);

        // redirect to previous page
        return redirect()->back()
            ->with('success', 'Paperwork created successfully.');

        // return redirect()->route('paperwork.index')
        //     ->with('success', 'Paperwork created successfully.');
    }
}

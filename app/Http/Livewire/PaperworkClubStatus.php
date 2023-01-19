<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\User;
use App\Models\Paperwork;
use App\Models\PaperworkDetails;

use App\Http\Controllers\MailController;

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
        $club = User::find($paperwork->clubId);

        // convert $paperwork->progressStates to array if not null, not using explode() because it will return an array with one element if the string is empty
        if ($paperwork->progressStates != null) {
            $paperwork->progressStates = json_decode($paperwork->progressStates);
        } else {
            $paperwork->progressStates = null;
        }

        return view('livewire.paperwork-status', compact('paperwork', 'club'));
    }

    public function updatePaperworkStatus(Request $request, $id)
    {
        $paperwork = Paperwork::find($id);

        $mailController = new MailController();

        // Admin
        if (auth()->user()->role == 0) {
            // if ($request->paperwork_updateStatus == "Lulus") {
            //     $paperwork->status = 1;
            //     $paperwork->currentProgressState = 3;
            // } else {
            //     $paperwork->status = 0;
            //     $paperwork->currentProgressState = 0;
            // }
        }
        // advisor
        else if (auth()->user()->role == 2) {
            if ($request->paperwork_updateStatus == "Lulus") {
                $paperwork->status = 1;
                $paperwork->currentProgressState = 2;
                $mailController->sendEmail($paperwork->id, "Update");
            } else {
                $paperwork->status = 0;
                $paperwork->currentProgressState = 0;
            }
        }
        // HEPA
        else if (auth()->user()->role == 3) {
            if ($request->paperwork_updateStatus == "Lulus") {
                $paperwork->status = 1;
                $paperwork->currentProgressState = 3;
                $mailController->sendEmail($paperwork->id, "Update");
            } else {
                $paperwork->status = 0;
                $paperwork->currentProgressState = 0;
            }
        }
        // TNC (HEPA)
        else if (auth()->user()->role == 4) {
            if ($request->paperwork_updateStatus == "Lulus") {

                if (count(json_decode($paperwork->progressStates)) == 4) {
                    $paperwork->status = 2;
                    $mailController->sendEmail($paperwork->id, "Lulus");
                } else {
                    $paperwork->status = 1;
                    $mailController->sendEmail($paperwork->id, "Update");
                }

                $paperwork->currentProgressState = 4;
            } else {
                $paperwork->status = 0;
                $paperwork->currentProgressState = 0;
            }
        }
        // NC
        else if (auth()->user()->role == 5) {
            if ($request->paperwork_updateStatus == "Lulus") {
                $paperwork->status = 2;
                $paperwork->currentProgressState = 5;
                $mailController->sendEmail($paperwork->id, "Lulus");
            } else {
                $paperwork->status = 0;
                $paperwork->currentProgressState = 0;
            }
        }
    
        $paperwork->save();

        if ($request->paperwork_updateStatus == "Lulus") {
            return redirect()->back()
            ->with('updated', 'Kertas kerja ini telah diluluskan.');
        } else {
            return redirect()->route('paperwork-club');
        }
    }
}

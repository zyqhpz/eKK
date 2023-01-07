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

        if ($paperwork->isOneDay == 0) {
            $paperwork->isOneDay = 0;
        } else if ( $paperwork->isOneDay == 1) {
            $paperwork->isOneDay = 1;
        } else {
            $paperwork->isOneDay = 1;
        }

        $rows = array(
            'background' => 0,
            'objective' => 0,
            'targetGroup' => 0
        );
        
        // background - convert string to json
        if ( $paperworkDetails->background != null) {
            $paperworkDetails->background = json_decode($paperworkDetails->background);

            // get how many rows
            $rows['background'] = count($paperworkDetails->background);
        } else {
            $paperworkDetails->background = null;
        }

        // objective - convert string to json
        if ( $paperworkDetails->objective != null) {
            $paperworkDetails->objective = json_decode($paperworkDetails->objective);

            // get how many rows
            $rows['objective'] = count($paperworkDetails->objective);
        } else {
            $paperworkDetails->objective = null;
        }

        // targetGroup - convert string to json
        if ( $paperworkDetails->targetGroup != null) {
            $paperworkDetails->targetGroup = json_decode($paperworkDetails->targetGroup);

            // get how many rows
            $rows['targetGroup'] = count($paperworkDetails->targetGroup);
        } else {
            $paperworkDetails->targetGroup = null;
        }

        // // dateVenueTime - convert string to json
        // if ( $paperworkDetails->dateVenueTime != null) {
        //     $paperworkDetails->dateVenueTime = json_decode($paperworkDetails->dateVenueTime);
        // } else {
        //     $paperworkDetails->dateVenueTime = null;
        // }

        $rows = (object) $rows;

        // dd($rows);

        return view('livewire.paperwork-details-generator', compact('paperwork', 'paperworkDetails', 'rows'));
    }

    public function update(Request $request, $id)
    {
        $paperwork = Paperwork::find($id);
        $paperworkDetails = PaperworkDetails::find($paperwork->paperworkDetailsId);

        $paperworkDetails->update($request->all());

        return redirect()->route('paperwork-club-status', $paperwork->id);
    }

    public function updatePaperwork(Request $request, $id)
    {
        // dd($request->all());
        $paperwork = Paperwork::find($id);
        $paperworkDetails = PaperworkDetails::find($paperwork->paperworkDetailsId);

        $paperwork->name = $request->program_name = $paperwork->name;
        $paperwork->isGenerated = $request->paperwork_isGenerated ?? $paperwork->isGenerated;
        $paperwork->filePath = $request->paperwork_file ?? $paperwork->filePath;

        if ($request->paperwork_isOneDay == 'on') {
            $paperwork->isOneDay = 1;
            $paperwork->programDate = $request->paperwork_programDate;
            $paperwork->programDateStart = null;
            $paperwork->programDateEnd = null;
        } else {
            $paperwork->isOneDay = 0;
            $paperwork->programDateStart = $request->paperwork_programDateStart;
            $paperwork->programDateEnd = $request->paperwork_programDateEnd;
            $paperwork->programDate = null;
        }

        $paperwork->venue = $request->paperwork_venue ?? null;
        $paperwork->collaborations = $request->paperwork_collaborations ?? null;
        $paperwork->status = $request->paperwork_status ?? $paperwork->status;
        $paperwork->currentProgressState = $request->paperwork_currentProgressState ?? $paperwork->currentProgressState;
        $paperwork->progressStates = $request->paperwork_progressStates ?? $paperwork->progressStates;
        
        $paperwork->save();

        // update paperoworkDetails
        $paperworkDetails->introduction = $request->paperwork_introduction ?? $paperworkDetails->introduction;
        
        // dynamic inputs
        $paperworkDetails->background = $request->paperwork_background ?? null;
        $paperworkDetails->background = json_encode($paperworkDetails->background);

        $paperworkDetails->objective = $request->paperwork_objective ?? null;
        $paperworkDetails->objective = json_encode($paperworkDetails->objective);

        $paperworkDetails->targetGroup = $request->paperwork_targetGroup ?? null;
        $paperworkDetails->targetGroup = json_encode($paperworkDetails->targetGroup);

        $paperworkDetails->learningOutcome = $request->paperwork_learningOutcome ?? null;
        $paperworkDetails->theme = $request->paperwork_theme ?? null;
        $paperworkDetails->organizedBy = $request->paperwork_organizedBy ?? null;

        $paperworkDetails->dateVenueTime = $request->paperwork_dateVenueTime ?? null;

        $paperworkDetails->tentativeFirebaseId = $request->paperwork_tentativeFirebaseId ?? $paperworkDetails->tentativeFirebaseId;
        $paperworkDetails->financialImplicationFirebaseId = $request->paperwork_financialImplicationFirebaseId ?? $paperworkDetails->financialImplicationFirebaseId;
        $paperworkDetails->programCommittee = $request->paperwork_programCommittee ?? $paperworkDetails->programCommittee;
        $paperworkDetails->signature = $request->paperwork_signature ?? $paperworkDetails->signature;
        $paperworkDetails->closing = $request->paperwork_closing ?? $paperworkDetails->closing;

        $paperworkDetails->save();

        return redirect()->back()
            ->with('updated', 'Kertas kerja berjaya dikemaskini.');

    }
}

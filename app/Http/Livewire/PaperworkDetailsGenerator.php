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

        
        // convert string to json
        if ( $paperworkDetails->background != null) {
            $paperworkDetails->background = json_decode($paperworkDetails->background);
        } else {
            $paperworkDetails->background = null;
        }

        return view('livewire.paperwork-details-generator', compact('paperwork', 'paperworkDetails'));
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

        $paperwork->name = $request->paperwork_name ?? $paperwork->name;
        $paperwork->isGenerated = $request->paperwork_isGenerated ?? $paperwork->isGenerated;
        $paperwork->filePath = $request->paperwork_file ?? $paperwork->filePath;
        $paperwork->isOneDay = $request->paperwork_isOneDay ?? $paperwork->isOneDay;

        if ($request->paperwork_isOneDay == 1) {
            $paperwork->programDate = $request->paperwork_programDate ?? $paperwork->programDate;
            $paperwork->startDate = NULL;
            $paperwork->endDate = NULL;
        } else {
            $paperwork->programDate = NULL;
            $paperwork->startDate = $request->paperwork_startDate ?? $paperwork->startDate;
            $paperwork->endDate = $request->paperwork_endDate ?? $paperwork->endDate;
        }

        // $paperwork->programDate = $request->paperwork_programDate ?? $paperwork->programDate;
        // $paperwork->startDate = $request->paperwork_startDate ?? $paperwork->startDate;
        // $paperwork->endDate = $request->paperwork_endDate ?? $paperwork->endDate;
        // $paperwork->venue = $request->paperwork_venue ?? $paperwork->venue;
        $paperwork->status = $request->paperwork_status ?? $paperwork->status;
        $paperwork->currentProgressState = $request->paperwork_currentProgressState ?? $paperwork->currentProgressState;
        $paperwork->progressStates = $request->paperwork_progressStates ?? $paperwork->progressStates;
        
        $paperwork->save();

        // update paperoworkDetails
        $paperworkDetails->introduction = $request->paperwork_introduction ?? $paperworkDetails->introduction;
        $paperworkDetails->objective = $request->paperwork_objective ?? $paperworkDetails->objective;
        $paperworkDetails->background = $request->paperwork_backgrounds ?? $paperworkDetails->background;
        $paperworkDetails->learningOutcome = $request->paperwork_learningOutcome ?? $paperworkDetails->learningOutcome;
        $paperworkDetails->theme = $request->paperwork_theme ?? $paperworkDetails->theme;
        $paperworkDetails->organizedBy = $request->paperwork_organizedBy ?? $paperworkDetails->organizedBy;
        $paperworkDetails->targetGroup = $request->paperwork_targetGroup ?? $paperworkDetails->targetGroup;
        $paperworkDetails->dateVenueTime = $request->paperwork_dateVenueTime ?? $paperworkDetails->dateVenueTime;
        $paperworkDetails->tentativeId = $request->paperwork_tentativeId ?? $paperworkDetails->tentativeId;
        $paperworkDetails->financialImplicationId = $request->paperwork_financialImplicationId ?? $paperworkDetails->financialImplicationId;
        $paperwork->programCommittee = $request->paperwork_programCommittee ?? $paperworkDetails->programCommittee;
        $paperwork->closing = $request->paperwork_closing ?? $paperworkDetails->closing;

        $paperworkDetails->save();

        return redirect()->back()
            ->with('updated', 'Kertas kerja berjaya dikemaskini.');

    }
}

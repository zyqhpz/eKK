<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
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

        $paperworkDetails->tentativeFirebaseId = $paperworkDetails->tentativeFirebaseId;
        // $paperworkDetails->tentativeFirebaseId = json_decode($paperworkDetails->tentativeFirebaseId);
        // $paperworkDetails->tentativeFirebaseId = Response::json($paperworkDetails->tentativeFirebaseId);

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

        // dd($request->all());

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

        // Tentative Program
        $tentatives = null;

        if ($request->program_duration != null) {
            // split $request->program_tentatives string to int array by comma and count the length
            $program_itemPerDay = explode(',', $request->program_tentatives); // num items per day
            $program_duration = count(explode(',', $request->program_tentatives)); // num days
            
            $tentatives = array(
                'duration' => $program_duration,
                'timeAndItem' => array()
            );

            $k=0;

            $totalItems = count($request->tentatives_time);

            for ($i=0; $i < $program_duration; $i++) {
                $tentatives['timeAndItem'][$i] = $program_itemPerDay[$i];
            }

            // tentative - data format v1
            // for ($i=0; $i < $program_duration; $i++) {
            //     for ($j=0; $j < $program_itemPerDay[$i]; $j++) {
            //         $items[$j] = array(
            //             'time' => $request->tentatives_time[$k],
            //             'item' => $request->tentatives_item[$k]
            //         );
            //         $k++;
            //     }
            //     $tentatives['timeAndItem'][$i] = $items;
            // }

            // tentative - data format v2
            for ($i=0; $i < $program_duration; $i++) {
                $items = array();
                for ($j=0; $j < $program_itemPerDay[$i]; $j++) {
                    $items[$j] = array(
                        $request->tentatives_time[$k] => $request->tentatives_item[$k]
                    );
                    // echo 'row: '.$k . ' ' . $request->tentatives_time[$k] . ' ' . $request->tentatives_item[$k] . '<br>';
                    $k++;
                }
                $tentatives['timeAndItem'][$i] = $items;
            }
            $paperworkDetails->tentativeFirebaseId = json_encode($tentatives);
            // dd($totalItems, $program_itemPerDay, $paperworkDetails->tentativeFirebaseId);
        } else {
            $paperworkDetails->tentativeFirebaseId = null;
        }

        // Implication
        $name_implication = $request->implication_titles;
        $item_implication = $request->implication_item;
        $item_quantity = $request->implication_quantity;
        $item_pricePerUnit = $request->implication_pricePerUnit;
        $implication_remark = $request->implication_remark;

        $implication_titles_size = count($request->implication_titles);

        $financialImplication = array(
            'name' => $request->implication_titles,
            'item' => $item_implication,
            'items' => $request->implication_count_items,
            'quantity' => $item_quantity,
            'pricePerUnit' => $item_pricePerUnit,
            'remark' => $implication_remark,
            'details' => $request->implication_details,
            'single' => $request->single_implication,
            'multiple' => $request->multiple_implication
        );

        $singleImplication = $request->single_implication;
        $multipleImplication = $request->multiple_implication;

        $implication_array = array(
            'implications_count' => $implication_titles_size,
            'implications' => array(),
        );

        $implication_multiple_item_counter = 0;

        $implication_multiple_item_by_title = explode(',', $request->implication_count_items);

        for ($i=0; $i < $implication_titles_size; $i++) {
            
            // check if $request->implication_titles in $multipleImplication
            if (in_array($request->implication_titles[$i], $multipleImplication)) {

                // get index in array
                $index = array_search($request->implication_titles[$i], $multipleImplication);

                $title = $request->implication_titles[$i];
                $isSingle = false;

                $implication = array(
                    'title' => $title,
                    'isSingle' => $isSingle,
                    'item' => array(),
                    'remark' => $request->implication_remark[$i],
                );

                for ($j = 0; $j < $implication_multiple_item_by_title[$index]; $j++) {
                    $item = array(
                        'name' => $request->implication_item[$implication_multiple_item_counter],
                        'quantity' => $request->implication_quantity[$i],
                        'pricePerUnit' => $request->implication_pricePerUnit[$i],
                    );
                    array_push($implication['item'], $item);

                    $implication_multiple_item_counter++;
                }
                array_push($implication_array['implications'], $implication);
            } else {

                $index = array_search($request->implication_titles[$i], $singleImplication);

                $title = $request->implication_titles[$i];
                $isSingle = true;

                $implication = array(
                    'title' => $title,
                    'isSingle' => $isSingle,
                    'quantity' => $request->implication_quantity[$i],
                    'pricePerUnit' => $request->implication_pricePerUnit[$i],
                    'remark' => $request->implication_remark[$i],
                );
                array_push($implication_array['implications'], $implication);
            }
        }

        $paperworkDetails->financialImplicationFirebaseId = json_encode($implication_array) ?? $paperworkDetails->financialImplicationFirebaseId;
        
        // $paperworkDetails->tentativeFirebaseId = $request->paperwork_tentativeFirebaseId ?? $paperworkDetails->tentativeFirebaseId;
        // $paperworkDetails->financialImplicationFirebaseId = $request->paperwork_financialImplicationFirebaseId ?? $paperworkDetails->financialImplicationFirebaseId;

        // $paperworkDetails->financialImplicationFirebaseId = $request->paperwork_financialImplicationFirebaseId ?? $paperworkDetails->financialImplicationFirebaseId;

        $paperworkDetails->programCommittee = $request->paperwork_programCommittee ?? $paperworkDetails->programCommittee;
        $paperworkDetails->signature = $request->paperwork_signature ?? $paperworkDetails->signature;
        $paperworkDetails->closing = $request->paperwork_closing ?? $paperworkDetails->closing;

        $paperwork->save();
        $paperworkDetails->save();

        return redirect()->back()
            ->with('updated', 'Kertas kerja berjaya dikemaskini.');

    }
}

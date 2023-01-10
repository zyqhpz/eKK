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

        $paperwork->name = $request->program_name ?? $paperwork->name;
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
        $paperwork->collaborations = $request->program_collaborations ?? null;
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

        // dd($financialImplication);

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

                // var_dump( $implication_multiple_item_by_title);

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

        // dd($implication_array);

        $paperworkDetails->financialImplicationFirebaseId = json_encode($implication_array) ?? $paperworkDetails->financialImplicationFirebaseId;

        // AJK
        if ($request->committee_row != null) {

            $committee = array();

            $ajk_position_counter = 0;
            $ajk_name_counter = 0;

            // get row of ajk
            $ajk_countPerRow = explode(',', $request->committee_row[0]); // num items per row
            $ajk_row = count(explode(',', $request->committee_row[0])); // total items

            // dd($ajk_countPerRow);

            for ($ajk_counter = 0; $ajk_counter < $ajk_row; $ajk_counter++) {

                $committee_item = array();


                if ($ajk_countPerRow[$ajk_counter] != 0) {
                    if ($ajk_countPerRow[$ajk_counter] > 1) {

                        $ajk_name_array = array();

                        for ($i=0; $i < $ajk_countPerRow[$ajk_counter]; $i++) {
                            // echo $request->committee_name[$ajk_name_counter];
                            array_push($ajk_name_array, $request->committee_name[$ajk_name_counter]);
                            $ajk_name_counter++;
                        }

                        $committee_item = array(
                            $request->committee_position[$ajk_position_counter] => $ajk_name_array
                        );

                        // var_dump( $ajk_name_array);

                        $ajk_position_counter++;

                    } else {
                        $committee_item = array(
                            $request->committee_position[$ajk_position_counter] => $request->committee_name[$ajk_name_counter]
                        );

                        $ajk_position_counter++;
                        $ajk_name_counter++;
                    }

                    array_push($committee, $committee_item);
                }
            }
        }
        // dd(json_encode($committee), $committee, $ajk_countPerRow, $ajk_row, $request->committee_row, $request->committee_position, $request->committee_name);
        // dd($request->committee_row, $request->committee_position, $request->committee_name);
        $paperworkDetails->programCommittee = json_encode($committee) ?? $paperworkDetails->programCommittee;

        
        // $paperworkDetails->tentativeFirebaseId = $request->paperwork_tentativeFirebaseId ?? $paperworkDetails->tentativeFirebaseId;
        // $paperworkDetails->financialImplicationFirebaseId = $request->paperwork_financialImplicationFirebaseId ?? $paperworkDetails->financialImplicationFirebaseId;

        // $paperworkDetails->financialImplicationFirebaseId = $request->paperwork_financialImplicationFirebaseId ?? $paperworkDetails->financialImplicationFirebaseId;

        // Signature
        $writer_name = null;
        $writer_position = null;
        $writer_phone = null;
        $writer_email = null;

        $president_name = null;
        $president_position = null;
        $president_phone = null;
        $president_email = null;

        if ($request->program_signature[0] != null) {
            $writer_name = $request->program_signature[0];
        }
        if ($request->program_signature[1] != null) {
            $writer_position = $request->program_signature[1];
        }

        if ($request->program_signature[2] != null) {
            $writer_phone = $request->program_signature[2];
        }

        if ($request->program_signature[3] != null) {
            $writer_email = $request->program_signature[3];
        }

        if ($request->program_signature[4] != null) {
            $president_name = $request->program_signature[4];
        }

        if ($request->program_signature[5] != null) {
            $president_phone = $request->program_signature[5];
        }

        if ($request->program_signature[6] != null) {
            $president_email = $request->program_signature[6];
        }

        $signature = array(
            'writer_name' => $writer_name,
            'writer_position' => $writer_position,
            'writer_phone' => $writer_phone,
            'writer_email' => $writer_email,
            'president_name' => $president_name,
            'president_position' => 'Presiden',
            'president_phone' => $president_phone,
            'president_email' => $president_email,
        );

        // dd($request->program_signature, $signature);
        $paperworkDetails->signature = json_encode($signature) ?? null;

        $paperworkDetails->closing = $request->paperwork_closing ?? $paperworkDetails->closing;

        $paperwork->save();
        $paperworkDetails->save();

        return redirect()->back()
            ->with('updated', 'Kertas kerja berjaya dikemaskini.');

    }
}

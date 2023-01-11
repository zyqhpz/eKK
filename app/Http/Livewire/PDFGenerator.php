<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Paperwork;
use App\Models\PaperworkDetails;

use PDF;
use Dompdf\Dompdf;
use DateTime;
use DateInterval;
use DatePeriod;

class PDFGenerator extends Component
{
    public function render()
    {
        return view('livewire.pdf-generator');
    }

    public function viewGeneratedPDF($id) {

        $paperwork = Paperwork::find($id);
        $paperworkDetails = PaperworkDetails::find($paperwork->paperworkDetailsId);
        $user = User::find($paperwork->clubId);

        $learningOutcome = ""; 
        
        if ($paperworkDetails->learningOutcome == null || $paperworkDetails->learningOutcome == '') {
            $learningOutcome = ""; 
        } else {
        
            if ($paperworkDetails->learningOutcome == 0) {
                $learningOutcome = "<div><b>Pengurusan & Kepimpinan</b><br>Dapat mengatur, menyelaras atau mengawal pengoperasi sesuatu organisasi bagi mencapai suatu matlamat dalam keadaan yang harmoni.<div>";
            } else if ($paperworkDetails->learningOutcome == 1) {
                $learningOutcome = "Meningkatkan atau memberikan pendedahan kepada bidang teknikal seperti bidang mekanikal, teknologi maklumat, elektronik dan lain-lain serta dapat membuat perubahan atau pembaharuan daripada keupayaan kreatif yang memerlukan konsep, idea, kaedah, proses dan kegunaan baharu yang berupaya menjadikan sesuatu perkara lebih baik dari keadaan asalnya.";
            } else if ($paperworkDetails->learningOutcome == 2) {
                $learningOutcome = "Meningkatkan hubungan baik dan nilai tambah seseorang individu disamping membantu mereka yang memerlukan.";
            } else if ($paperworkDetails->learningOutcome == 3) {
                $learningOutcome = "<div><b>Akademik & Kerjaya</b><br>Perancangan dan matlamat yang baik supaya bidang kemahiran yang dipilih selari dengan matlamat yang dituju.</div>";
            }
        }

        // TENTATIVE
        if ($paperworkDetails->tentative == null || $paperworkDetails->tentative == '') {
            $tentative_html = '';
        } else {
            $tentative = json_decode($paperworkDetails->tentative, true);

            $days = ['Ahad', 'Isnin', 'Selasa', 'Rabu', 'Khamis', 'Jumaat', 'Sabtu'];

            if ($paperwork->isOneDay == 1) {

                $tentative_dayAndDate = $days[date('w', strtotime($paperwork->programDate))] . '<br>(' . date('d/m/Y', strtotime($paperwork->programDate)) . ')';

                foreach ($tentative['timeAndItem'][0] as $key => $value) {
                    $tentative_html = '<tr><td rowspan="'. count($tentative['timeAndItem']) .'" class="fw-bold">'. $tentative_dayAndDate .'</td>
                                        <td>'.$key.'</td>
                                        <td>'. $value.'</td>
                                        </tr>';
                }

                for ($i = 1; $i < count($tentative['timeAndItem']); $i++) {
                    // get key and value from array
                    foreach ($tentative['timeAndItem'][$i] as $key => $value) {
                        $tentative_html .= '<tr><td>'.$key.'</td><td>'. $value.'</td></tr>';
                    }
                }
            } else {

                $tentative_html = '';

                // get all dates between two dates 
                $start = new DateTime($paperwork->programDateStart);
                $end = new DateTime($paperwork->programDateEnd);
                $interval = new DateInterval('P1D'); // P1D means a period of 1 day
                $period = new DatePeriod($start, $interval, $end);

                $period_arr = iterator_to_array($period);
                $count = count($period_arr);

                $date_array = array();

                foreach ($period as $date) {
                    array_push($date_array, $date->format('Y-m-d'));
                }

                array_push($date_array, $end->format('Y-m-d'));

                for ($i = 0; $i < $tentative['duration']; $i++) {

                    $tentative_dayAndDate = $days[date('w', strtotime($date_array[$i]))] . '<br>(' . date('d/m/Y', strtotime($date_array[$i])) . ')';

                    foreach ($tentative['timeAndItem'][$i][0] as $key => $value) {
                        $tentative_html .= '<tr><td rowspan="'. count($tentative['timeAndItem'][$i]) .'" class="fw-bold">'. $tentative_dayAndDate .'</td>
                                            <td>'.$key.'</td>
                                            <td>'. $value.'</td>
                                            </tr>';
                    }

                    for ($k = 1; $k < count($tentative['timeAndItem'][$i]); $k++) {
                        // get key and value from array
                        foreach ($tentative['timeAndItem'][$i][$k] as $key => $value) {
                                $tentative_html .= '<tr><td>'.$key.'</td><td>'. $value.'</td></tr>';
                        }
                    }
   
                }
            }
        }

        // FINANCIAL IMPLICATION
        if ($paperworkDetails->financialImplication == null || $paperworkDetails->financialImplication == '') {
            $financialImplication = '';
        } else {
            $financialImplication = $this->calculateTotalImplication($paperworkDetails->financialImplication);
            dd($financialImplication);
        }

        $data = [
            'user' => $user,
            'paperwork' => $paperwork,
            'paperworkDetails' => $paperworkDetails,
            'tentative' => $tentative_html,
        ];
        
        $pdf = PDF::loadView('livewire.paperwork-pdf', $data);
        
        $pdf->set_option("isPhpEnabled", true);

        $pdf->render();
        return $pdf->stream();
    }

    public function calculateTotalImplication($financialImplication) {

        $financialImplication = json_decode($financialImplication, true);

        $totalEach = array();

        $totalImplication = $financialImplication['implications_count'];

        // set array size 
        // $totalByRemark = array_fill(0, $totalImplication, 0);

        // set remark to array $totalByRemark
        foreach ($financialImplication['implications'] as $key => $value) {
            $totalByRemark[$value['remark']] = 0;
        }

        $item_details = array();

        foreach ($financialImplication['implications'] as $key => $value) {

            $item = array(
                'item' => '',
                'quantity' => '',
                'pricePerUnit' => '',
                'subTotal' => '',
                'total' => '',
                'remark' => '',
            );

            $items = array(
                'item' => '',
                'detail' => '',
                'total' => '',
                'remark' => '',
            );

            if ($value['isSingle']) {
                // echo 'single';

                $subTotal = $value['quantity'] * $value['pricePerUnit'];

                $item = array(
                    'item' => $value['title'],
                    'quantity' => $value['quantity'],
                    'pricePerUnit' => $value['pricePerUnit'],
                    'subTotal' => $subTotal,
                    'total' => $subTotal,
                    'remark' => $value['remark'],
                );

                $totalByRemark[$value['remark']] += $subTotal;

                array_push($item_details, $item);
            } else {

                $values = $value['item'];

                $total = 0;

                $details = array();

                for ($i = 0; $i < count($values); $i++) {

                    $subTotal = $values[$i]['quantity'] * $values[$i]['pricePerUnit'];
                    $total += $subTotal;

                    $detail = array(
                        'item' => $values[$i]['name'],
                        'quantity' => $values[$i]['quantity'],
                        'pricePerUnit' => $values[$i]['pricePerUnit'],
                        'subTotal' => $subTotal,
                    );

                    array_push($details, $detail);
                }

                $items = array(
                    'item' => $value['title'],
                    'detail' => $detail,
                    'total' => $total,
                    'remark' => $value['remark'],
                );

                $totalByRemark[$value['remark']] += $total;

                array_push($item_details, $items);
            }
        }
        // dd($item_details);
        return array(
            "items"=> $item_details,
            "totalByRemark" => $totalByRemark,
        );
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

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

        $financial_html = '';
        $total_all = 0;

        // FINANCIAL IMPLICATION
        if ($paperworkDetails->financialImplication == null || $paperworkDetails->financialImplication == '') {
            $financial_html = '';
        } else {
            $financialImplication = $this->calculateTotalImplication($paperworkDetails->financialImplication);

            $counter = 0;
            $financial_html = '';

            foreach ($financialImplication['items'] as $key => $value) {

                if (isset($value['detail'])) {

                        $details = $value['detail'];

                        $financial_html .=  '<tr>
                                                <th scope="row">'.++$counter.'.</th>
                                                <td class="text-start">'. $value['item'] .' :-';

                                                
                                                for ($i = 0; $i < count($details); $i++) {
                                                        $financial_html .= '<br>'. $details[$i]['item'];
                                                }

                                                $financial_html .= '</td><td>';

                                                for ($i = 0; $i < count($details); $i++) {
                                                        $financial_html .= '<br>'. $details[$i]['quantity'];
                                                }

                                                $financial_html .= '</td><td>';

                                                for ($i = 0; $i < count($details); $i++) {
                                                        $financial_html .= '<br>'. $details[$i]['pricePerUnit'];
                                                }

                                                $financial_html .= '</td><td>';

                                                for ($i = 0; $i < count($details); $i++) {
                                                        $financial_html .= '<br>'. $details[$i]['subTotal'];
                                                }

                                                $financial_html .= '</td><td class="align-middle">'. $value['total'] .'</td>
                                                <td class="align-middle text-uppercase">'. $value['remark'] .'</td>
                                            </tr>';
                } else {
                        $financial_html .=   '<tr>
                                                <th scope="row">'.++$counter.'.</th>
                                                <td class="text-start align-middle">'. $value['item'] .'</td>
                                                <td class="align-middle">'. $value['quantity'] .'</td>
                                                <td class="align-middle">'. $value['pricePerUnit'] .'</td>
                                                <td class="align-middle">'. $value['subTotal'] .'</td>
                                                <td class="align-middle">'. $value['total'] .'</td>
                                                <td class="align-middle text-uppercase">'. $value['remark'] .'</td>
                                            </tr>';
                }
            }

            $total_all = 0;

            foreach ($financialImplication['totalByRemark'] as $key => $value) {
                $financial_html .= '<tr>
                                        <td colspan="5" class="align-middle"><b class="text-uppercase">JUMLAH KESELURUHAN IMPLIKASI KEWANGAN ('. $key .' SAHAJA)</b></td>
                                        <td colspan="2" class="align-middle"><b>RM'. $value .'</b></td>
                                    </tr>';

                $total_all += $value;
            }

                $financial_html .= '<tr>
                                        <td colspan="5" class="align-middle"><b>JUMLAH KESELURUHAN IMPLIKASI KEWANGAN</b></td>
                                        <td colspan="2" class="align-middle"><b>RM'. $total_all .'</b></td>
                                    </tr>';
        }

        // AJK
        $ajk_html = '';

        if ($paperworkDetails->programCommittee == null || $paperworkDetails->programCommittee == '') {
            $ajk_html = '';
        } else {
            $ajk = json_decode($paperworkDetails->programCommittee, true);

            // get key and value from array
            for ($i = 0; $i < count($ajk); $i++) {

                foreach ($ajk[$i] as $key => $value) {

                    if (is_array($value)) {

                        $ajk_html .=    '<tr height="30pt"></tr>
                                        <tr>
                                            <td width="90%"><b class="text-uppercase">'.$key.':</b></td>
                                        </tr>
                                        <tr height="10pt"></tr>
                                        <tr>
                                            <td>
                                                <table width="100%" style="text-align: center;">';
                                                for ($j = 0; $j < count($value); $j++) {
                                                    $ajk_html .= '<tr>
                                                                    <td width="5%" align="right">'.($j+1).'.</td>
                                                                    <td width="100%">&nbsp;&nbsp;&nbsp;'.$value[$j].'</td>
                                                                </tr>';
                                                }
                        $ajk_html .=            '</table>
                                            </td>
                                        </tr>';
                    } else {

                        $ajk_html .=    '<tr>
                                            <td width="90%" align="center">
                                                <b class="text-uppercase">'. $key.'</b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="90%" align="center">
                                                '.$value.'
                                            </td>
                                        </tr>';
                    }
                }

            }
        }

        $signature_html = '';

        if ($paperworkDetails->signature == null || $paperworkDetails->signature == '') {
            $signature_html = '';
        } else {
            $signature = json_decode($paperworkDetails->signature, true);
            
            $signature_html = ' <td class="col-6 text-start">
                                    <p class="fw-bold">Disediakan oleh :</p>
                                    <br><br><br>
                                    <p class="fw-bold">.................................................</p>
                                    <p class="fw-bold">('.$signature['writer_name'].')</p>
                                    <p class="fw-normal">Jawatan: '.$signature['writer_position'].'</p>
                                    <p class="fw-normal">Tarikh: ...................................</p>
                                    <p class="fw-normal">No. H/P: '.$signature['writer_phone'].'</p>
                                    <p class="fw-normal">Emel: '.$signature['writer_email'].'</p>
                                </td>
                                <td class="col-5 text-start">
                                    <p class="fw-bold">Disemak oleh :</p>
                                    <br><br><br>
                                    <p class="fw-bold">.................................................</p>
                                    <p class="fw-bold">('.$signature['president_name'].')</p>
                                    <p class="fw-normal">Jawatan: '.$signature['president_position'].'</p>
                                    <p class="fw-normal">Tarikh: ...................................</p>
                                    <p class="fw-normal">No. H/P: '.$signature['president_phone'].'</p>
                                    <p class="fw-normal">Emel: '.$signature['president_email'].'</p>
                                </td>';
        }

        $data = [
            'user' => $user,
            'paperwork' => $paperwork,
            'paperworkDetails' => $paperworkDetails,
            'tentative' => $tentative_html,
            'financialImplication' => array(
                'implikasi' => $financial_html,
                'jumlah_implikasi' => $total_all
            ),
            'ajk' => $ajk_html,
            'signature' => $signature_html,
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
                    'detail' => $details,
                    'total' => $total,
                    'remark' => $value['remark'],
                );

                $totalByRemark[$value['remark']] += $total;

                array_push($item_details, $items);
            }
        }
        return array(
            "items"=> $item_details,
            "totalByRemark" => $totalByRemark,
        );
    }
}

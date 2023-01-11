<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Paperwork;
use App\Models\PaperworkDetails;

use PDF;
use Dompdf\Dompdf;

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

        // $pdf = new PDF();

        $learningOutcome = ""; 
        
        if ($paperworkDetails->learningOutcome == null || $paperworkDetails->learningOutcome == '') {
            // $learningOutcome = json_decode($paperworkDetails->learningOutcome, true);
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

        $tentative = json_decode($paperworkDetails->tentative, true);
        // dd($tentative['duration']);

        if ($paperwork->isOneDay == 1) {
            $tentative_dayAndDate = $paperwork->programDate;

            // $tentative_html = '<tr><td rowspan="'. count($tentative['timeAndItem']) .'" class="fw-bold">'. $tentative_dayAndDate .'</td>
            //                     <td>7:30 am - 8:00 am</td>
            //                     <td >Ketibaan dan pendaftaran peserta di PPP</td>
            //                     </tr>';

            foreach ($tentative['timeAndItem'][0] as $key => $value) {
                    // echo "Key: " . $key . ", Value: " . $value . "<br>";

                $tentative_html = '<tr><td rowspan="'. count($tentative['timeAndItem']) .'" class="fw-bold">'. $tentative_dayAndDate .'</td>
                                    <td>'.$key.'</td>
                                    <td>'. $value.'</td>
                                    </tr>';
            }

            for ($i = 1; $i < count($tentative['timeAndItem']); $i++) {
                // echo $tentative['timeAndItem'][$i];
                // dd($tentative['timeAndItem'][$i]);

                // get key and value from array
                foreach ($tentative['timeAndItem'][$i] as $key => $value) {

                    $tentative_html .= '<tr><td>'.$key.'</td><td>'. $value.'</td></tr>';
                    
                    // echo $key . " => " . $value . "<br>";
                    // dd($key . " => " . $value . "<br>");

                }
            }

                // $tentative_dayAndDate = $tentative['timeAndItem'][$i];
            //     $tentative_html .= '<tr>
            //                             <td>' . $tentative['duration'][$i] . '</td>
            //                             <td>' . $tentative['activity'][$i] . '</td>
            //                         </tr>';
            // }
            // $tentative_html .= '<tr>
            //                         <td>' . $tentative['duration'][$i] . '</td>
            //                         <td>' . $tentative['activity'][$i] . '</td>
            //                     </tr>';
        } else {

        }

        // for ($i = 0; $i < $tentative['duration']; $i++) {
        //     $tentative_dayAndDate = $tentative['timeAndItem'][$i];
        //     $tentative_html .= '<tr>
        //                             <td>' . $tentative['duration'][$i] . '</td>
        //                             <td>' . $tentative['activity'][$i] . '</td>
        //                         </tr>';
        // }
        
        // $tentative_html = '<tr><td rowspan="9" class="fw-bold">Sabtu(11/2/2022)</td>
        //                         <td>7:30 am - 8:00 am</td>
        //                         <td >Ketibaan dan pendaftaran peserta di PPP</td>
        //                     </tr>
        //                     <tr>
        //                         <td>8:00 am - 8:30 am</td>
        //                         <td>Sarapan dan Taklimat</td>
        //                     </tr>
        //                     <tr>
        //                         <td>8:30 am - 3:30 pm</td>
        //                         <td>Berangkat ke UMT</td>
        //                     </tr>
        //                     <tr>
        //                         <td>3:30 pm - 4:30 pm</td>
        //                         <td>Check-in penginapan</td>
        //                     </tr>
        //                     <tr>
        //                         <td>4:30 pm - 6:45 pm</td>
        //                         <td>Slot 1:Ceramah Komunikasi</td>
        //                     </tr>
        //                     <tr>
        //                         <td>6:45 pm - 8:00 pm</td>
        //                         <td>ReSoMa</td>
        //                     </tr>
        //                     <tr>
        //                         <td>8:00 pm - 9:30 pm</td>
        //                         <td>Slot 2: Ceramah Kepimpinan</td>
        //                     </tr>
        //                     <tr>
        //                         <td>9:30 pm - 11:00 pm</td>
        //                         <td>LDK 1: Ice-breaking</td>
        //                     </tr>
        //                     <tr>
        //                         <td>11:00 pm</td>
        //                         <td>Rehat</td>
        //                     </tr>';

                            // dd($tentative_html);
        
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

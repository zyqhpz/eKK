<!DOCTYPE html>
<html>
<head>
    <title>{{ $paperwork->name }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

<style>
    * {
        font-family: Arial;
    }

    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 70%;
        }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
</style>
</head>
<body class="mx-auto d-block">

    <?php
        $days = array('Ahad', 'Isnin', 'Selasa', 'Rabu', 'Khamis', 'Jumaat', 'Sabtu');
        $months = array('Januari', 'Februari', 'Mac', 'April', 'Mei', 'Jun', 'Julai', 'Ogos', 'September', 'Oktober', 'November', 'Disember');
        if ($paperwork->isOneDay) {

        } else {
            $tarikh_main_page;

            // make it format X - X MONTH YYYY

            $tarikh_main_page = date('j', strtotime($paperwork->programDateStart)).' - '.date('j', strtotime($paperwork->programDateEnd)).' '.$months[date('n', strtotime($paperwork->programDateEnd))-1].' '.date('Y', strtotime($paperwork->programDateEnd));

            // $tarikh_main_page = $days[date('w', strtotime($paperwork->programDateStart))].', '.date('j', strtotime($paperwork->programDateStart)).' '.$months[date('n', strtotime($paperwork->programDateStart))-1].' '.date('Y', strtotime($paperwork->programDateStart));
            // $tarikh_main_page = $days[date('w', strtotime($paperwork->programDateStart))].', '.date('j', strtotime($paperwork->programDateStart)).' '.$months[date('n', strtotime($paperwork->programDateStart))-1].' '.date('Y', strtotime($paperwork->programDateStart));

            // $tarikh_main_page .= ' - '.$days[date('w', strtotime($paperwork->programDateEnd))].', '.date('j', strtotime($paperwork->programDateEnd)).' '.$months[date('n', strtotime($paperwork->programDateEnd))-1].' '.date('Y', strtotime($paperwork->programDateEnd));
        }
    ?>
    
    <div id="main-page">

        <br><br>

        <div class="mx-auto d-block text-center">
            <img class="align-middle" style="height: 140px;" src="{{ public_path('img/UTEM.png') }}" alt="">
        </div>

        <br><br>

        <div class="mx-auto d-block text-center">
            <p class="text-uppercase text-bold"><b>KERTAS KERJA <br> {{ $paperwork->name }}</b></p>
            <p class="text-uppercase text-bold"><b>TARIKH<br> {{ $tarikh_main_page }}</b></p>
            <p class="text-uppercase text-bold"><b>TEMPAT<br> {{ $paperwork->venue }}</b></p>
            <p class="text-uppercase text-bold"><b>ANJURAN<br> {{ $paperwork->collaborations }}</b></p>
            <p class="text-uppercase text-bold"><b>DISEDIAKAN OLEH : <br> {{ json_decode($paperworkDetails->signature, true)['writer_name'] }}</b></p>
        </div>

        <br><br>
        
        <table class="mx-auto">
                <td>Tarikh Program terakhir yang dilulus dan dilaksanakan</td>
                <td></td>
            </tr>
            <tr>
                <td>Status Laporan Program Terakhir</td>
                <td>Hantar/Tidak (Mesti dinyatakan)</td>
            </tr>
        </table>

        <div class="d-flex align-items-center justify-content-center" style="page-break-after: always;">

        <p class="align-items-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>

    </div>

</body>

</html>
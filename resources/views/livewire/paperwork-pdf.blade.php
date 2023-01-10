<!DOCTYPE html>
<html>
<head>
    <title>{{ $paperwork->name }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

<style>
    * {
        font-family: Arial;
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

    <div class="mx-auto d-block text-center">
        <img class="align-middle" style="height: 130px;" src="{{ public_path('img/UTEM.png') }}" alt="">
    </div>

    <br>
    <br>

    <div class="mx-auto d-block text-center">
        <p class="text-uppercase text-bold"><b>KERTAS KERJA <br> {{ $paperwork->name }}</b></p>
        <p class="text-uppercase text-bold"><b>TARIKH<br> {{ $tarikh_main_page }}</b></p>
        <p class="text-uppercase text-bold"><b>TEMPAT<br> {{ $paperwork->venue }}</b></p>
        <p class="text-uppercase text-bold"><b>ANJURAN<br> {{ $tarikh_main_page }}</b></p>
        {{-- <p class="text-uppercase text-bold"><b>{{ $paperwork->name }}</b></p> --}}
    </div>

    <div class="mt-6 mx-auto d-block text-center">
        <p>TARIKH</p>
        <p class="text-uppercase">{{ $paperwork->name }}</p>
    </div>

    <div class="mt-6 mx-auto d-block text-center">
        <p>TEMPAT</p>
        <p class="text-uppercase">{{ $paperwork->venue }}</p>
    </div>

    <div class="d-flex align-items-center justify-content-center"">

        <p class="align-items-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
</body>

</html>
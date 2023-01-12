<!DOCTYPE html>
<html>
<head>
    <title>{{ $paperwork->name }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

    <style>
        * {
            font-family: arial, sans-serif;
        }

        table {
            font-family: arial, sans-serif;
            width: 70%;
        }

        td, th {
            /* border: 1px solid #dddddd; */
            text-align: left;
            padding: 8px;
        }

        .justified {
            text-align: justify;
            margin-left: 40px;
        }

        li {
            /* border: 1px solid #000; */
            /* border-collapse: collapse; */
        }

        ol li ol {
            /* background: #000; */
            border: 0;
        }

        #table-status-lama {
            width: 70%;
            border: 1px solid #000;
        }

        #table-status-lama td, th {
            border: 1px solid #000;
        }

        #table-tentative {
            width: 100%;
            border: 1px solid #000;
        }

        #table-tentative td, th {
            border: 1px solid #000;
        }

        #table-implikasi {
            /* width: 80%; */
            border: 1px solid #000;
            font-size: 14px;
        }

        #table-implikasi td, th{
            border: 1px solid #000;
        }

        #table-ajk {
            width: 100%;
            border-collapse: collapse;
            border: 0;
            border-spacing: 0;
        }

        #table-ajk table, th, td {
            text-align: center;
        }

        #table-ajk tr td table tr td {
            text-align: left;
        }

        @page{
            margin-top: 80px;
            margin-left: 60px;
            margin-right: 60px;
            margin-bottom: 80px;
        }

        #implication @page {
            margin-top: 80px;
            margin-left: 30px;
            margin-right: 30px;
            margin-bottom: 80px;
        }
    </style>
</head>
<body class="mx-auto d-block">

    <?php
        $days = array('Ahad', 'Isnin', 'Selasa', 'Rabu', 'Khamis', 'Jumaat', 'Sabtu');
        $months = array('Januari', 'Februari', 'Mac', 'April', 'Mei', 'Jun', 'Julai', 'Ogos', 'September', 'Oktober', 'November', 'Disember');
        if ($paperwork->isOneDay) {
            $tarikh_main_page = date('j', strtotime($paperwork->programDate)).' '.$months[date('n', strtotime($paperwork->programDate))-1].' '.date('Y', strtotime($paperwork->programDate));
        } else {
            $tarikh_main_page;
            // make it format X - X MONTH YYYY
            $tarikh_main_page = date('j', strtotime($paperwork->programDateStart)).' - '.date('j', strtotime($paperwork->programDateEnd)).' '.$months[date('n', strtotime($paperwork->programDateEnd))-1].' '.date('Y', strtotime($paperwork->programDateEnd));
        }

        $learningOutcome_title = "";
        $learningOutcome_detail = "";
        
        if ($paperworkDetails->learningOutcome == null || $paperworkDetails->learningOutcome == '') {
            // $learningOutcome = json_decode($paperworkDetails->learningOutcome, true);
            $learningOutcome_title = "";
            $learningOutcome_detail = "";
        } else {
        
            if ($paperworkDetails->learningOutcome == 0) {
                $learningOutcome_title = "Pengurusan & Kepimpinan";
                $learningOutcome_detail = "Dapat mengatur, menyelaras atau mengawal pengoperasi sesuatu organisasi bagi mencapai suatu matlamat dalam keadaan yang harmoni.";
            } else if ($paperworkDetails->learningOutcome == 1) {
                $learningOutcome_title = "Teknikal & Inovasi";
                $learningOutcome_detail = "Meningkatkan atau memberikan pendedahan kepada bidang teknikal seperti bidang mekanikal, teknologi maklumat, elektronik dan lain-lain serta dapat membuat perubahan atau pembaharuan daripada keupayaan kreatif yang memerlukan konsep, idea, kaedah, proses dan kegunaan baharu yang berupaya menjadikan sesuatu perkara lebih baik dari keadaan asalnya.";
            } else if ($paperworkDetails->learningOutcome == 2) {
                $learningOutcome_title = "Sukarelawan";
                $learningOutcome_detail = "Meningkatkan hubungan baik dan nilai tambah seseorang individu disamping membantu mereka yang memerlukan.";
            } else if ($paperworkDetails->learningOutcome == 3) {
                $learningOutcome_title = "Akademik & Kerjaya";
                $learningOutcome_detail = "Perancangan dan matlamat yang baik supaya bidang kemahiran yang dipilih selari dengan matlamat yang dituju.";
            } else if ($paperworkDetails->learningOutcome == 4) {
                $learningOutcome_title = "Etika & Kerohanian";
                $learningOutcome_detail = "Menerapkan nilai-nilai keagamaan dan moral dalam diri mahasiswa/i supaya mereka dapat mengelakkan diri daripada melakukan perkara yang dilarang oleh agama dan etika budaya rakyat Malaysia.";
            } else if ($paperworkDetails->learningOutcome == 5) {
                $learningOutcome_title = "Budaya & Entiti Nasional";
                $learningOutcome_detail = "Memberikan kesedaran kepada mahasiswa menghormati perlembagaan, serta rela berkorban bagi menjaga kedaulatan dan maruah negara tanpa mengira agama, bangsa dan negara serta menerapkan perilaku dan adab dalam mahasiswa/i untuk menjadi modal yang insan melalui aktiviti kebudayaan dan muzik.";
            } else if ($paperworkDetails->learningOutcome == 6) {
                $learningOutcome_title = "Keusahawanan";
                $learningOutcome_detail = "Mahasiswa/i dilengkapi dengan ciri-ciri keusahawanan akan mampu menerokai potensi diri seterusnya mampu untuk menyumbang tenaga dan kepakaran yang lebih menyeluruh bukan sahaja kepada industri tetapi juga kepada komuniti sosial.";
            } else if ($paperworkDetails->learningOutcome == 7) {
                $learningOutcome_title = "Sukan dan Rekreasi";
                $learningOutcome_detail = "Sukan dilakukan sama ada untuk tujuan pertandingan mahupan kegiatan untuk menyihatkan badan manakala rekreasi adalah suatu kegiatan yang menyeronokkan yang boleh menyegarkan kembali kesihatan badan dan melapangkan fikiran..";
            }
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
            <p class="text-uppercase text-bold"><b>TARIKH:<br> {{ $tarikh_main_page }}</b></p>
            <p class="text-uppercase text-bold"><b>TEMPAT:<br> {{ $paperwork->venue }}</b></p>
            <p class="text-uppercase text-bold"><b>ANJURAN:<br> {{ $user->name }}</b></p>
            @if ($paperwork->collaborations != null)
                <p class="text-uppercase text-bold"><b>DENGAN KERJASAMA:<br> {{ $paperwork->collaborations }}</b></p>
            @endif
            <p class="text-uppercase text-bold"><b>DISEDIAKAN OLEH: <br> {{ json_decode($paperworkDetails->signature, true)['writer_name'] }}</b></p>
        </div>

        <br><br>
        
        <table id="table-status-lama" class="mx-auto">
                <td><b><i>Tarikh program terakhir yang dilulus dan dilaksanakan</b></i></td>
                <td></td>
            </tr>
            <tr>
                <td><b><i>Status Laporan Program Terakhir</b></i></td>
                <td style="color:red"><b><i>Hantar/Tidak (MESTI dinyatakan)</b></i></td>
            </tr>
        </table>

        <div class="d-flex align-items-center justify-content-center" id="content" style="page-break-before: always;">
            <br><br>

            <div class="mx-auto d-block text-center">
                <p class="fw-bold">MESYUARAT JAWATANKUASA<br>HAL EHWAL PELAJAR & ALUMNI (JHEPA), BIL. ..../2023</p>
            </div>
            
            <div class="mx-auto">
                <ol class="list-group list-group-numbered">
                    <li id="pendahuluan" class="fw-bold"><span>0<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><b>PENDAHULUAN</b></span></span>
                        <ol class="list-group list-group-numbered fw-normal"">
                            <li class="list-group-item d-flex align-items-start">
                                <div class="justified">
                                    Donec feugiat sagittis finibus. Sed rhoncus ipsum eu tortor vestibulum congue. Nullam sed felis nec mauris vehicula ornare. Ut id ultrices nunc. Maecenas quis arcu et quam laoreet luctus. Nullam pharetra tellus in laoreet bibendum. Quisque vestibulum a nisi a ultricies. Aenean sed urna ut nulla fringilla fermentum nec sit amet nisi. Morbi urna purus, fringilla vitae odio id, accumsan feugiat ipsum. Nam ac leo odio. Donec iaculis ante et mollis varius. Donec vulputate augue risus, et condimentum metus vulputate quis. Pellentesque at quam id orci sollicitudin convallis sit amet id justo. Donec lorem odio, congue quis turpis non, luctus facilisis risus. Vestibulum tempus justo ac risus tincidunt, non ultrices mi vestibulum.
                                </div>
                            </li>
                        </ol>
                    </li>
                    <li id="latar-belakang" class="fw-bold"><span>0<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>LATAR BELAKANG</b></span></span>
                        <ol class="list-group list-group-numbered fw-normal"">
                            <li class="list-group-item justified">Donec feugiat sagittis finibus. Sed rhoncus ipsum eu tortor vestibulum congue. Nullam sed felis nec mauris vehicula ornare. Ut id ultrices nunc. Maecenas quis arcu et quam laoreet luctus. Nullam pharetra tellus in laoreet bibendum. Quisque vestibulum a nisi a ultricies. Aenean sed urna ut nulla fringilla fermentum nec sit amet nisi. Morbi urna purus, fringilla vitae odio id, accumsan feugiat ipsum. Nam ac leo odio. Donec iaculis ante et mollis varius. Donec vulputate augue risus, et condimentum metus vulputate quis. Pellentesque at quam id orci sollicitudin convallis sit amet id justo. Donec lorem odio, congue quis turpis non, luctus facilisis risus. Vestibulum tempus justo ac risus tincidunt, non ultrices mi vestibulum.</li>
                            <li class="list-group-item justified">Donec feugiat sagittis finibus. Sed rhoncus ipsum eu tortor vestibulum congue. Nullam sed felis nec mauris vehicula ornare. Ut id ultrices nunc. Maecenas quis arcu et quam laoreet luctus. Nullam pharetra tellus in laoreet bibendum. Quisque vestibulum a nisi a ultricies. Aenean sed urna ut nulla fringilla fermentum nec sit amet nisi. Morbi urna purus, fringilla vitae odio id, accumsan feugiat ipsum. Nam ac leo odio. Donec iaculis ante et mollis varius. Donec vulputate augue risus, et condimentum metus vulputate quis. Pellentesque at quam id orci sollicitudin convallis sit amet id justo. Donec lorem odio, congue quis turpis non, luctus facilisis risus. Vestibulum tempus justo ac risus tincidunt, non ultrices mi vestibulum.</li>
                            <li class="list-group-item justified">Etiam quis volutpat nunc, eu fermentum erat. Donec bibendum at nisi in maximus. In hac habitasse platea dictumst. Ut malesuada, magna sit amet facilisis rutrum, orci augue sagittis dolor, vitae egestas erat elit quis risus. Donec a lacus ex. Maecenas in ex scelerisque, consectetur dolor sed, dictum nisi. Sed congue consectetur fringilla. Proin a neque justo.</li>
                        </ol>
                    </li>
                    <li id="objektif" class="fw-bold" style="page-break-before: always;"><span>0<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>OBJEKTIF</b></span></span>
                        <ol class="list-group list-group-numbered fw-normal">
                            <li class="list-group-item">
                                Objektif utama program diadakan adalah:
                            </li>
                            <ol type="a">
                                <li class="list-group-item justified">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Eros donec ac odio tempor orci. Vivamus arcu felis bibendum ut tristique. Eros in cursus turpis massa tincidunt. Quis risus sed vulputate odio ut.</li>
                                <li class="list-group-item justified">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Eros donec ac odio tempor orci. Vivamus arcu felis bibendum ut tristique. Eros in cursus turpis massa tincidunt. Quis risus sed vulputate odio ut.</li>
                                <li class="list-group-item justified">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Eros donec ac odio tempor orci. Vivamus arcu felis bibendum ut tristique. Eros in cursus turpis massa tincidunt. Quis risus sed vulputate odio ut.</li>
                            </ol>
                        </ol>
                    </li>
                    <li id="hasil-pembelajaran" class="fw-bold"><span>0<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>HASIL PEMBELAJARAN</b></span></span>
                        <ol class="list-group list-group-numbered fw-normal">
                            <li class="list-group-item">
                                <b>
                                    {{ $learningOutcome_title }}
                                </b>
                                <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                {{ $learningOutcome_detail }}
                            </li>
                        </ol>
                    </li>
                    <li id="tema" class="fw-bold"><span>0<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>TEMA</b></span></span>
                        <ol class="list-group list-group-numbered fw-normal">
                            <li class="list-group-item">
                                @if ($paperworkDetails != null) {{ $paperworkDetails->theme }} @endif
                            </li>
                        </ol>
                    </li>
                    <li id="anjuran" class="fw-bold"><span>0<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ANJURAN</b></span></span>
                        <ol class="list-group list-group-numbered fw-normal">
                            <li class="list-group-item">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Dolor purus non enim praesent elementum facilisis leo. Ut ornare lectus sit amet est placerat in. Est ullamcorper eget nulla facilisi etiam dignissim diam quis enim. Sollicitudin nibh sit amet commodo nulla. Diam in arcu cursus euismod quis viverra.
                            </li>
                        </ol>
                    </li>
                    <li id="kumpulan-sasaran" class="fw-bold"><span>0<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>KUMPULAN SASARAN</b></span></span>
                        <ol class="list-group list-group-numbered fw-normal">
                            <li class="list-group-item">
                                Lorem ipsum dolor sit amet
                            </li>
                            <li class="list-group-item">
                                Lorem ipsum dolor sit amet
                            </li>
                        </ol>
                    </li>
                    <li id="tarikh-tempat-masa" class="fw-bold"><span>0<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>TARIKH, TEMPAT DAN MASA</b></span></span>
                        <ol class="list-group list-group-numbered fw-normal">
                            <li class="list-group-item">
                                Tarikh:&nbsp;&nbsp;Lorem ipsum dolor sit amet
                            </li>
                            <li class="list-group-item">
                                Tempat:&nbsp;&nbsp;Lorem ipsum dolor sit amet
                            </li>
                            <li class="list-group-item">
                                Masa:&nbsp;&nbsp;Lorem ipsum dolor sit amet
                            </li>
                        </ol>
                    </li>
                    <li id="tentative" class="fw-bold" style="page-break-before: always;"><span>0<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b class="text-uppercase">TENTATIF {{ $paperwork->name }}</b></span></span>
                        <table id="table-tentative" border="3" class="fw-normal mx-auto">
                            <tr>
                            <th style="width: 80%;">TARIKH</th>
                            <th style="width: 100%;">MASA</th>
                            <th style="width: 100%;">PERKARA</th>
                            </tr>
                            <?php echo $tentative; ?>
                        </table>
                    </li>
                    <li id="implikasi-kewangan" class="fw-bold px-2 table-responsive" style="page-break-before: always;"><span>0<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>IMPLIKASI KEWANGAN</b></span></span>
                        <p class="fw-normal">Anggaran perbelanjaan keseluruhan bagi penganjuran {{ $paperwork->name }} ini adalah sebanyak <b>RM {{ $financialImplication['jumlah_implikasi'] }}</b>.</p>
                        <table class="table fw-normal mx-auto" id="table-implikasi">
                            <thead>
                                <tr>
                                <th scope="col" class="align-middle">Bil</th>
                                <th scope="col" class="align-middle">Perkara</th>
                                <th scope="col" class="align-middle">Kuantiti</th>
                                <th scope="col" class="align-middle">Harga Seunit(RM)</th>
                                <th scope="col" class="align-middle" >Jumlah(RM)</th>
                                <th scope="col" class="align-middle">Jumlah keseluruhan(RM)</th>
                                <th scope="col" class="align-middle">Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo $financialImplication['implikasi']; ?>
                            </tbody>
                        </table>
                    </li>
                    <li id="ulasan-kewangan" class="fw-bold" style="page-break-before: always;"><span>0<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ULASAN BAHAGIAN KEWANGAN</b></span></span>
                        <div>
                            TAJUK PROGRAM : {{ $paperwork->name }}
                            <br><br>
                            <div class="mx-auto" style="border: 2px solid #000; width: 100%; height: 40%">

                            </div>
                        </div>
                    </li>
                    <li class="fw-bold" style="page-break-before: always;"><span>0<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>JAWATANKUASA PROGRAM</b></span></span>
                    <table id="table-ajk" class="mx-auto fw-normal" style="text-align: center;">
                            <tr height="30pt"></tr>
                            <tr>
                                <td width="90%" align="center" style="text-align: center;">
                                    <b>JAWATANKUASA PELAKSANA</b>
                                </td>
                            </tr>
                            <tr>
                                <td width="90%" align="center" style="text-align: center;">
                                    PROGRAM BYLEAD:BOOST YOUR LEADERSHIP
                                </td>
                            </tr>
                            <tr height="10pt"></tr>

                            <tr>
                                <td width="90%" align="center">
                                    <b>PENASIHAT</b>
                                </td>
                            </tr>
                            <tr>
                                <td width="90%" align="center">
                                    IR. DR. NORAZHAR BIN ABU BAKAR
                                </td>
                            </tr>
                            <tr height="10pt"></tr>

                            <tr>
                                <td width="90%" align="center">
                                    <b>PENGURUSI</b>
                                </td>
                            </tr>

                            <tr>
                                <td width="90%" align="center">
                                    MUHAMMAD QOIYUM BIN SUHAIMI
                                </td>
                            </tr>
                            <tr height="10pt"></tr>

                            <tr>
                                <td width="90%" align="center">
                                    <b>PENGARAH</b>
                                </td>
                            </tr>

                            <tr>
                                <td width="90%" align="center">
                                    MUHAMMAD HAZIQ BIN MOHD HAPIZ
                                </td>
                            </tr>
                            <tr height="10pt"></tr>

                            <tr>
                                <td width="90%" align="center">
                                    <b>TIMBALAN PENGARAH</b>
                                </td>
                            </tr>

                            <tr>
                                <td width="90%" align="center">
                                    AZHARRUL HARIFF BIN KAMARZAMAN
                                </td>
                            </tr>
                            <tr height="10pt"></tr>

                            <tr>
                                <td width="90%" align="center">
                                    <b>SETIAUSAHA</b>
                                </td>
                            </tr>

                            <tr>
                                <td width="90%" align="center">
                                    NOOR SYAHIRAH BINTI ABDULLAH
                                </td>
                            </tr>
                            <tr height="10pt"></tr>

                            <tr>
                                <td width="90%" align="center">
                                    <b>BENDAHARI</b>
                                </td>
                            </tr>
                            <tr>
                                <td width="90%" align="center">
                                    NURFAZIRAH BINTI MUSLIMIN
                                </td>
                            </tr>
                            <tr height="30pt"></tr>
                            <tr>
                                <td width="90%"><b>BIRO PENDAFTARAN, PENGANGKUTAN DAN TEMPAT:</b></td>
                            </tr>
                            <tr height="10pt"></tr>
                            <tr>
                                <td>
                                    <table width="100%" style="text-align: center;">
                                        <tr>
                                            <td width="5%" align="right">1.</td>
                                            <td width="100%">&nbsp;&nbsp;&nbsp;MUHAMMAD NAJIHIN BIN HAMZAH</td>
                                        </tr>
                                        <tr>
                                            <td width="5%" align="right">2.</td>
                                            <td width="100%">&nbsp;&nbsp;&nbsp;NUR'AIN NATASHA BINTI HASBULLAH</td>
                                        </tr>
                                        <tr>
                                            <td width="5%" align="right">3.</td>
                                            <td width="100%">&nbsp;&nbsp;&nbsp;NUR SYAZWANI HANAFI</td>
                                        </tr>
                                        <tr>
                                            <td width="5%" align="right">4.</td>
                                            <td width="100%">&nbsp;&nbsp;&nbsp;NUR AIN SOLEHAH BT MOHD SA'AD</td>
                                        </tr>
                                        <tr>
                                            <td width="5%" align="right">5.</td>
                                            <td width="100%">&nbsp;&nbsp;&nbsp;NUR SYAZWANI BT RIZAL</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr height="20pt"></tr>
                            <tr>
                                <td width="90%"><b>BIRO TEKNIKAL & LOGISTIK:</b></td>
                            </tr>
                            <tr height="10pt"></tr>
                            <tr>
                                <td>
                                    <table width="100%">
                                        <tr>
                                            <td width="5%" align="right">1.</td>
                                            <td width="90%">&nbsp;&nbsp;&nbsp;AHMAD SUFIYAN BIN TAHIR</td>
                                        </tr>
                                        <tr>
                                            <td width="5%" align="right">2.</td>
                                            <td width="90%">&nbsp;&nbsp;&nbsp;MUHAMMAD LUQMAN BIN SA'ADON</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr height="20pt"></tr>
                            <tr>
                                <td width="90%"><b>BIRO PENGISIAN DAN PROTOKOL:</b></td>
                            </tr>
                            <tr height="10pt"></tr>
                            <tr>
                                <td>
                                    <table width="100%">
                                        <tr>
                                            <td width="5%" align="right">1.</td>
                                            <td width="90%">&nbsp;&nbsp;&nbsp;SITI NUR ALIA BINTI MOHD AZHAR</td>
                                        </tr>
                                        <tr>
                                            <td width="5%" align="right">2.</td>
                                            <td width="90%">&nbsp;&nbsp;&nbsp;MOHD RIZWAN BIN AHMAD HUSSIN</td>
                                        </tr>
                                        <tr>
                                            <td width="5%" align="right">3.</td>
                                            <td width="90%">&nbsp;&nbsp;&nbsp;S'NG JIA YU</td>
                                        </tr>
                                        <tr>
                                            <td width="5%" align="right">4.</td>
                                            <td width="90%">&nbsp;&nbsp;&nbsp;MOHAMMAD HASIF BIN MOHD TAHIR</td>
                                        </tr>
                                        <tr>
                                            <td width="5%" align="right">5.</td>
                                            <td width="90%">&nbsp;&nbsp;&nbsp;RACHEL MICHAEL</td>
                                        </tr>
                                        <tr>
                                            <td width="5%" align="right">6.</td>
                                            <td width="90%">&nbsp;&nbsp;&nbsp;IDA ROHAYU BINTI ABD KARIM</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                    </table>
                    </li>
                    <li id="penutup" class="fw-bold" style="page-break-before: always;"><span>0<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>PENUTUP</b></span></span>
                        <ol class="list-group list-group-numbered fw-normal">
                            <li class="list-group-item justified">Sehubungan dengan itu, dipohon Mesyuarat Jawatankuasa Hal Ehwal Pelajar & Alumni untuk memperakukan / menyokong kertas kerja program {{ $paperwork->name }} ini dan dipohon kelulusan daripada YBhg. Timbalan Naib Canselor (Hal Ehwal Pelajar & Alumni)</li>
                        </ol>
                    </li>
                </ol>
            </div>
        </div>

    </div>

</body>
<script type="text/php">
    if (isset($pdf) ) {
        // OLD 
        // $font = Font_Metrics::get_font("helvetica", "bold");
        // $pdf->page_text(72, 18, "{PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(255,0,0));
        // v.0.7.0 and greater
        $x = 72;
        $y = 790;
        $text = "Page {PAGE_NUM} of {PAGE_COUNT}";
        $font = $fontMetrics->get_font("Times New Roman", "bold");
        $size = 8;
        $color = array(0,0,0);
        $word_space = 0.0;  //  default
        $char_space = 0.0;  //  default
        $angle = 0.0;   //  default
        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
    }
</script>

<script>
    alert("{{ $paperwork->name }}");
</script>
</html>
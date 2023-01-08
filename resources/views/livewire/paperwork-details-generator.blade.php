<title>eKK PDF Generator</title>
<div>
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.rawgit.com/trentrichardson/jQuery-Timepicker-Addon/1.6.3/dist/jquery-ui-timepicker-addon.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <?php
            if (session('updated')) {
                echo '<div class="alert alert-success" role="alert" fade show>' . session('updated') . '</div>';
            }
        ?>
    </div>
    <div class="row">
        <div class="row">
            <div class="col-12">
                <!-- Tab -->
                <nav>
                    <div class="nav nav-tabs mb-4" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link" id="nav-info-tab" data-bs-toggle="tab" href="#nav-info" role="tab" aria-controls="nav-info" aria-selected="true">Maklumat Asas</a>
                        <a class="nav-item nav-link" id="nav-intro-tab" data-bs-toggle="tab" href="#nav-intro" role="tab" aria-controls="nav-intro" aria-selected="false">Pendahuluan</a>
                        <a class="nav-item nav-link" id="nav-tentative-tab" data-bs-toggle="tab" href="#nav-tentative" role="tab" aria-controls="nav-tentative" aria-selected="false">Tentatif</a>
                        <a class="nav-item nav-link active" id="nav-financial-tab" data-bs-toggle="tab" href="#nav-financial" role="tab" aria-controls="nav-financial" aria-selected="false">Kewangan</a>
                        <a class="nav-item nav-link" id="nav-ajk-tab" data-bs-toggle="tab" href="#nav-ajk" role="tab" aria-controls="nav-ajk" aria-selected="false">Jawatankuasa</a>
                        <a class="nav-item nav-link" id="nav-signature-tab" data-bs-toggle="tab" href="#nav-signature" role="tab" aria-controls="nav-signature" aria-selected="false">Tandatangan</a>
                    </div>
                </nav>
                <form id="form-paperwork" action="{{ route('paperwork-generator.save', $paperwork->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data" novalidate>
                <div class="tab-content card card-body border-0 shadow mb-4" id="nav-tabContent" >
                    @csrf
                    <div class="tab-pane fade" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab">
                        <h1>Maklumat Asas Program</h1>
                        <div class="row">
                            <div class="mb-3">
                                <label for="program-name">Nama program</label>
                                <input class="form-control" id="program-name" type="text" name="program_name"
                                    placeholder="Masukkan nama program" value="{{ $paperwork->name }}" required>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-6 mb-3">
                                <label for="program-date-type">Program satu hari?</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="program-date-type" name="paperwork_isOneDay">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="date-day col-md-6 mb-3">
                                <label for="program-date">Tarikh program</label>
                                <input class="form-control" id="program-date" type="date" name="paperwork_programDate"
                                    placeholder="dd/mm/yyyy" @if($paperwork->programDate != null) { value="{{ $paperwork->programDate }}"} @endif>
                            </div>
                            <div class="date-start col-md-6 mb-3 d-none">
                                <label for="program-date-start">Tarikh bermula</label>
                                <input class="form-control datepicker-input" id="program-date-start" type="date" name="paperwork_programDateStart"
                                    placeholder="dd/mm/yyyy" @if($paperwork->programDateStart != null) { value="{{ $paperwork->programDateStart }}"} @endif>
                            </div>
                            <div class="date-end col-md-6 mb-3 d-none">
                                <label for="program-date-end">Tarikh berakhir</label>
                                <input class="form-control datepicker-input" id="program-date-end" type="date" name="paperwork_programDateEnd"
                                    placeholder="dd/mm/yyyy" @if($paperwork->programDateEnd != null) { value="{{ $paperwork->programDateEnd }}"} @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="program-place">Tempat program</label>
                                    <input  class="form-control" id="program-place" type="text" name="paperwork_venue"
                                        placeholder="Contoh: Dewan Auditorium FKP"
                                        @if($paperwork->venue != null) { value="{{ $paperwork->venue }}"} @endif>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="program-collab">Dengan kerjasama (jika ada)</label>
                                    <input class="form-control" id="collab" type="text" name="program_collaborations"
                                        placeholder="Kelab ABC, Kelab DEF">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="program-preparedby">Disediakan oleh</label>
                                <input class="form-control" id="collab" type="text" name="program_preparedby"
                                        placeholder="Nama pengarah program atau setiausaha">
                            </div>
                        </div>
                        <h2 class="h5 my-4">Status Program Terakhir</h2>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="last-program-date">Tarikh program terakhir yang dilulus dan dilaksanakan</label>
                                    <input class="form-control" id="last-program-date" type="date" name="last_program_date"
                                        placeholder="dd/mm/yyyy">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="last-program-status">Status laporan program terakhir</label>
                                    <select class="form-select mb-0" id="last-program-status" name="last_program_status" aria-label="Pilihan status laporan">
                                        <option value="0" selected>Dilaksanakan</option>
                                        <option value="1">Hantar</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- PENDAHULUAN --}}
                    <div class="tab-pane fade" id="nav-intro" role="tabpanel" aria-labelledby="nav-intro-tab">
                        <h1>Pendahuluan</h1>
                        <div class="row">
                            <div class="mb-3">
                                <label for="program-name">Pendahuluan</label>
                                <textarea class="form-control" id="pendahuluan" name="paperwork_introduction" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            {{-- LATAR BELAKANG --}}
                            <label for="latar-belakang">Latar Belakang</label>
                            @if($paperworkDetails->background == null)
                                <input type="hidden" name="" value="{{$backgroundKey = 0}}">
                                <div class="d-flex mb-3" id="background_{{$backgroundKey+1}}">
                                    <textarea class="form-control" id="latar-belakang-{{$backgroundKey+1}}" name="paperwork_background[]" required></textarea>
                                    <button type="button" class="btn btn-outline-danger btn_remove_background w-25 h-100 px-2 ms-4" id="btn_remove_background_{{$backgroundKey+1}}" value="{{$backgroundKey+1}}" onclick="removeInputField('background_' + {{$backgroundKey+1}})">X</button>
                                </div>
                            @else
                                @foreach($paperworkDetails->background as $key => $background)
                                    <div class="d-flex mb-3" id="background_{{$key+1}}">
                                        <textarea class="form-control" id="latar-belakang-{{$key+1}}" name="paperwork_background[]" required>{{$background}}</textarea>
                                        <button type="button" class="btn btn-outline-danger btn_remove_background" id="btn_remove_background_{{$key+1}}" value="1">X</button>
                                    </div>
                                @endforeach
                            @endif
                            <hr id="background-line" hidden>
                            <div class="mb-3 row">
                                <div class="col-12 col-sm-4 col-md-4 offset-md-4">
                                    <div class="d-grid gap-2">
                                        <button type="button" class="btn btn-outline-secondary" id="btn_add_background">+ Tambah Latar Belakang</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            {{-- OBJEKTIF --}}
                            <label for="objektif-program">Objektif</label>
                            @if($paperworkDetails->objective == null)
                                <input type="hidden" name="" value="{{$objectiveKey = 0}}">
                                <div class="d-flex mb-3" id="objective_{{$objectiveKey+1}}">
                                    <textarea class="form-control" id="objektif-program-{{$objectiveKey+1}}" name="paperwork_objective[]" required></textarea>
                                    <button type="button" class="btn btn-outline-danger btn_remove_objective w-25 h-100 px-2 ms-4" id="btn_remove_objective_{{$objectiveKey+1}}" value="{{$objectiveKey+1}}" onclick="removeInputField('objective_' + {{$objectiveKey+1}})">X</button>
                                </div>
                            @else
                                @foreach($paperworkDetails->objective as $key => $objective)
                                    <div class="d-flex mb-3" id="objective_{{$key+1}}">
                                        <textarea class="form-control" id="objektif-program-{{$key+1}}" name="paperwork_objective[]" required>{{$objective}}</textarea>
                                        <button type="button" class="btn btn-outline-danger btn_remove_objective" id="btn_remove_objective_{{$key+1}}" value="1">X</button>
                                    </div>
                                @endforeach
                            @endif
                            <hr id="objective-line" hidden>
                            <div class="mb-3 row">
                                <div class="col-12 col-sm-4 col-md-4 offset-md-4">
                                    <div class="d-grid gap-2">
                                        <button type="button" class="btn btn-outline-secondary" id="btn_add_objective">+ Tambah Objektif</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <label for="hasil-pembelajaran">Hasil Pembelajaran</label>
                                <select class="form-select" aria-label="Default select example" id="hasil-pembelajaran" name="paperwork_learningOutcome">
                                    <option id="hasil-pembelajaran-0" value="0" selected hidden>Pilih hasil pembelajaran</option>
                                    <option id="hasil-pembelajaran-1" value="1">Pengurusan & Kepimpinan</option>
                                    <option id="hasil-pembelajaran-2" value="2">Teknikal & Inovasi</option>
                                    <option id="hasil-pembelajaran-3" value="3">Sukarelawan</option>
                                    <option id="hasil-pembelajaran-4" value="4">Akademik & Kerjaya</option>
                                    <option id="hasil-pembelajaran-5" value="5">Etika & Kerohanian</option>
                                    <option id="hasil-pembelajaran-6" value="6">Budaya & Entiti Nasional</option>
                                    <option id="hasil-pembelajaran-7" value="7">Keusahawanan</option>
                                    <option id="hasil-pembelajaran-8" value="8">Sukan dan Rekreasi</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <label for="tema-program">Tema</label>
                                <input type="text" class="form-control" id="tema-program" name="paperwork_theme" required/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <label for="anjuran">Anjuran</label>
                                <textarea class="form-control" id="anjuran" name="paperwork_organizedBy" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            {{-- KUMPULAN SASARAN --}}'
                            <label for="kumpulan-sasaran">Kumpulan Sasaran</label>
                            @if($paperworkDetails->targetGroup == null)
                                <input type="hidden" name="" value="{{$targetGroupKey = 0}}">
                                <div class="d-flex mb-3" id="targetGroup_{{$targetGroupKey+1}}">
                                    <input type="text" class="form-control" id="kumpulan-sasaran-{{$targetGroupKey+1}}" name="paperwork_targetGroup[]" required/>
                                    <button type="button" class="btn btn-outline-danger btn_remove_targetGroup w-25 h-100 px-2 ms-4" id="btn_remove_targetGroup_{{$targetGroupKey+1}}" value="{{$targetGroupKey+1}}" onclick="removeInputField('targetGroup_' + {{$targetGroupKey+1}})">X</button>
                                </div>
                            @else
                                @foreach($paperworkDetails->targetGroup as $key => $targetGroup)
                                    <div class="d-flex mb-3" id="targetGroup_{{$key+1}}">
                                        <input type="text" class="form-control" id="kumpulan-sasaran-{{$key+1}}" name="paperwork_targetGroup[]" required value="{{$targetGroup}}"/>
                                        <button type="button" class="btn btn-outline-danger btn_remove_targetGroup" id="btn_remove_targetGroup_{{$key+1}}" value="1">X</button>
                                    </div>
                                @endforeach
                            @endif
                            <hr id="targetGroup-line" hidden>
                            <div class="mb-3 row">
                                <div class="col-12 col-sm-4 col-md-4 offset-md-4">
                                    <div class="d-grid gap-2">
                                        <button type="button" class="btn btn-outline-secondary" id="btn_add_targetGroup">+ Tambah Kumpulan Sasaran</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            {{-- TARIKH, TEMPAT, DAN MASA --}}
                            <div class="mb-3">
                                <label for="tarikh-tempat-masa">Tarikh, Tempat dan Masa</label>
                                <div class="mb-3 d-flex">
                                    <label for="program_date">Tarikh</label>
                                    <input type="text" class="form-control" id="program_date"
                                    value="<?php if ($paperwork->programDate != null) {
                                        // format date to dd/mm/yyyy
                                        $date = date_create($paperwork->programDate);
                                        $paperwork->programDate = date_format($date, "d/m/Y");
                                        echo $paperwork->programDate;
                                    } else if ($paperwork->programDateStart != null && $paperwork->programDateEnd != null) { 
                                        // format date to dd/mm/yyyy
                                        $date = date_create($paperwork->programDateStart);
                                        $paperwork->programDateStart = date_format($date, "d/m/Y");
                                        $date = date_create($paperwork->programDateEnd);
                                        $paperwork->programDateEnd = date_format($date, "d/m/Y");
                                        echo $paperwork->programDateStart . " - " . $paperwork->programDateEnd;
                                    } else {
                                        echo "Sila masukkan tarikh program pada bahagian Maklumat Asas";
                                    }  ?>" disabled />
                                </div>
                                <div class="mb-3 d-flex">
                                    <label for="program_location">Tempat</label>
                                    <input type="text" class="form-control" id="program_location"
                                    value="<?php if ($paperwork->venue != null) {
                                        echo $paperwork->venue;
                                    } else {
                                        echo "Sila masukkan tempat program pada bahagian Maklumat Asas";
                                    }  ?>" disabled />
                                </div>
                                <div class="mb-3 d-flex">
                                    <label for="program_time">Masa</label>
                                    <input type="text" class="form-control" id="program_time" name="paperwork_dateVenueTime" placeholder="Contoh: 9:00 pagi - 5:00 petang"
                                    value="<?php if ($paperworkDetails->dateVenueTime != null) {
                                        echo $paperworkDetails->dateVenueTime;
                                    }?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- TENTATIF --}}
                    <div class="tab-pane fade" id="nav-tentative" role="tabpanel" aria-labelledby="nav-tentative-tab">
                        <h1>Tentatif Program</h1>
                        {{-- if program-date-start input and program-date-end input are blank, show a message to user--}}
                        <p class="text-danger" id="warning-dateNotFilled">Sila isikan tarikh program terlebih dahulu pada <strong>Maklumat Asas</strong></p>
                        <div id="tentative">
                            <input type="text" name="program_duration" id="program-duration" hidden>
                            <input type="text" name="program_tentatives" id="program-tentatives-item" hidden>
                            <div id="tentative-inputs">
                            </div>
                        </div>
                    </div>
                    {{-- IMPLIKASI KEWANGAN --}}
                    <div class="tab-pane fade show active" id="nav-financial" role="tabpanel" aria-labelledby="nav-financial-tab">
                        <h1>Implikasi Kewangan</h1>
                        <div class="table-responsive py-4">
                            <table class="table table-flush" id="implicationTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Bil.</th>
                                        <th scope="col">Perkara</th>
                                        <th scope="col">Kuantiti</th>
                                        <th scope="col">Harga Seunit (RM)</th>
                                        <th scope="col">Catatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table-primary">
                                        <th scope="col">Contoh </th>
                                        <td>Makan/Minum :-
                                            <br>
                                            <ul>
                                                <li>Minum Pagi</li>
                                                <li>Makan Tengahari</li>
                                            </ul>
                                        </td>
                                        <td scope="col">
                                            <br>
                                            <ul style="list-style: none;">
                                                <li>100</li>
                                                <li>100</li>
                                            </ul>
                                        </td>
                                        <td scope="col">
                                            <br>
                                            <ul style="list-style: none;">
                                                <li>5.00</li>
                                                <li>7.00</li>
                                            </ul>
                                        </td>
                                        <td>
                                            <br>
                                            HEPA
                                        </td>
                                    </tr>
                                    <hr id="implication-line" hidden>
                                </tbody>
                            </table>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-12 col-sm-4 col-md-4 offset-md-4">
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal-addNewItemImplication">+ Tambah Perkara Baru</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- JAWATANKUASA PROGRAM --}}
                    <div class="tab-pane fade" id="nav-ajk" role="tabpanel" aria-labelledby="nav-ajk-tab">
                        <h1>Senarai Jawatankuasa Program</h1>
                        <p>Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa eiusmod
                            Pinterest in do umami readymade swag.</p>
                        <p>Day handsome addition horrible sensible goodness two contempt. Evening for married his account removal. Estimable me disposing of be moonlight cordially curiosity.</p>
                    </div>
                    {{-- TANDATANGAN --}}
                    <div class="tab-pane fade" id="nav-signature" role="tabpanel" aria-labelledby="nav-signature-tab">
                        <h1>Tandatangan</h1>
                        <div class="row">
                            <h5>Maklumat Penyedia Kertas Kerja</h5>
                            <div class="col-md-6 mb-3">
                                <label for="program-signature-preparedBy">Nama Penuh</label>
                                <input class="form-control" id="program-signature-preparedBy" type="text" name="program_signature[]" placeholder="Nama pengarah program atau setiausaha">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="program-signature-preparedBy">Jawatan</label>
                                <input class="form-control" id="program-signature-preparedBy" type="text" name="program_signature[]" placeholder="Jawatan dalam program atau kelab">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="program-signature-preparedBy">No. H/P</label>
                                <input class="form-control" id="program-signature-preparedBy" type="text" name="program_signature[]" placeholder="No. H/P">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="program-signature-preparedBy">Emel</label>
                                <input class="form-control" id="program-signature-preparedBy" type="text" name="program_signature[]" placeholder="Alamat emel">
                            </div>
                            <canvas id="signature-pad" width="200" height="200" style="border:1px solid">
                                
                            </canvas>
                        </div>
                        <div class="row">
                            <h5>Maklumat Presiden Kelab</h5>
                            <div class="col-md-6 mb-3">
                                <label for="program-signature-preparedBy">Nama Penuh</label>
                                <input class="form-control" id="program-signature-preparedBy" type="text" name="program_signature[]" placeholder="Nama presiden kelab">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="program-signature-preparedBy">Jawatan</label>
                                <input class="form-control" id="program-signature-preparedBy" type="text" name="program_signature[]" placeholder="Jawatan dalam program atau kelab" value="Presiden" disabled>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="program-signature-preparedBy">No. H/P</label>
                                <input class="form-control" id="program-signature-preparedBy" type="text" name="program_signature[]" placeholder="No. H/P">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="program-signature-preparedBy">Emel</label>
                                <input class="form-control" id="program-signature-preparedBy" type="text" name="program_signature[]" placeholder="Alamat emel">
                            </div>
                        </div>
                    </div>
                    <div class="flex mt-3">
                        <input type="submit" class="btn btn-primary mt-2 animate-up-2" value="Simpan"/>
                        {{-- <button type="button" class="btn btn-primary mt-2 animate-up-2" id="btn-save">Simpan</button> --}}
                        <button type="button" class="btn btn-secondary mt-2 animate-up-2">Hantar</button>
                        <button type="button" class="btn btn-gray-100 mt-2 animate-up-2">Lihat PDF</button>
                        <button type="button" class="btn btn-danger mt-2 animate-up-2">Batal</button>
                    </div>
                </div>
            </form>
                <!-- End of tab -->
            </div>
        </div>
    </div>
</div>

{{-- modal to add new item in implication --}}
<div class="modal fade" id="modal-addNewItemImplication" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h2 class="h6 modal-title">Tambah Perkara Baru</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- add radio button to add new single item or multiple item --}}
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="item_type" id="singleItem" value="0">
                    <label class="form-check-label" for="singleItem">
                        Tambah satu perkara baru
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="item_type" id="multipleItem" value="1" checked>
                    <label class="form-check-label" for="multipleItem">
                        Tambah beberapa perkara baru
                    </label>
                </div>
                
                {{-- add input field for naming item if multipleItem is checked --}}
                <div class="form-group mb-3" id="implicationIsMultiple">
                    <hr>
                    <div class="form-group mb-3">
                        <label class="form-label required">Perkara baru</label>
                        <input type="text" class="form-control" name="item_implication_title" id="item_implication_title" placeholder="Nama perkara baru" autocomplete="off" required>
                    </div>
                </div>
                        
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary" id="addImplication">Tambah</button>
                <button type="button" class="btn btn-link text-gray ms-auto" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

{{-- <script src="/public/js/implication.js"></script> --}}

{{-- Implication Tab Script --}}
<script>
    // $(document).ready(function() {

    // })
</script>

<script>

    // canvas for signature
    // select canvas#signature-pad in jquery
    var canvas = document.querySelector("canvas");

    var signaturePad = new SignaturePad(canvas);

    function resizeCanvas() {
  const ratio =  Math.max(window.devicePixelRatio || 1, 1);
  canvas.width = canvas.offsetWidth * ratio;
  canvas.height = canvas.offsetHeight * ratio;
  canvas.getContext("2d").scale(ratio, ratio);
  signaturePad.fromData(signaturePad.toData());
}
    window.onresize = resizeCanvas;
    resizeCanvas();

    // put border to canvas
    // canvas.style.border = "1px solid black";

    var isOneDayProgram;
    // var program-date-start = $("#program-date-start").val();
    var programDate;
    var programDateStart;
    var programDateEnd;

    var count_row_background = {{ $rows->background }};
    var count_row_objective = {{ $rows->objective }};
    var count_row_targetGroup = {{ $rows->targetGroup }};

    var count_row_implication = 1;

    var row_background = 1;

    var count_tentatives;

    var count_row_tentative = 1;

    var duration;
    var timeAndItems = [];

    var dayAndDate = [];

    var monthNames = ["Januari", "Februari", "Mac", "April", "Mei", "Jun", "Julai", "Ogos", "September", "Oktober", "November", "Disember"];
    var days = ["Ahad", "Isnin", "Selasa", "Rabu", "Khamis", "Jumaat", "Sabtu"];

    $(document).ready(function() {
        
        // set isOneDay to false based on $paperwork->isOneDay and call onChange of #program-date-type
        if ({{ $paperwork->isOneDay }} == 1) {
            isOneDayProgram = true;
            $("#program-date-type").prop('checked', true);
            $("#program-date-type").change();

        } else {
            isOneDayProgram = false;
            $("#program-date-type").prop('checked', false);
            $("#program-date-type").change();
        }

        if ({{ $paperworkDetails->learningOutcome }} != null) {
            setSelectedLearningOutcome({{ $paperworkDetails->learningOutcome }});
        }

        $("#program-date-start").change(checkDates);
        $("#program-date-start").change(createInputFieldTentative);
        $("#program-date-end").change(checkDates);
        $("#program-date-end").change(createInputFieldTentative);

        // if program-date is changed, call createInputFieldTentative()
        $("#program-date").change(createInputFieldTentative);

        // disable remove button for background 1
        $('#btn_remove_background_1').prop('disabled', true);

        // disable remove button for objective 1
        $('#btn_remove_objective_1').prop('disabled', true);

        // disable remove button for target group 1
        $('#btn_remove_targetGroup_1').prop('disabled', true);

        $("#timepicker").timepicker();

    });

    // implication
    $(document).ready(function() {     
        var implicationIsSingle = false;
        
        // add input field in implication table
        $('#addImplication').click(function() {
            if (implicationIsSingle) {
                var html = `<tr id="implication_` + count_row_implication + `"><th scope="col">` + count_row_implication + `.</th>
                                    <td><input class="form-control" type="text" name="implication_title[]" id="implication_col_1">
                                        <div class="d-grid gap-2 my-2">
                                            <button type="button" class="btn btn-outline-danger" id="btn_remove_implication" onclick="removeInputField('implication_` + count_row_implication + `')">- Buang Perkara</button>
                                        </div>
                                    </td>
                                    <td scope="col"><input class="form-control" type="text" name="implication_quantity[]" id="implication_col_2"></td>
                                    <td scope="col"><input class="form-control" type="text" name="implication_pricePerUnit[]" id="implication_col_3"></td>
                                    <td><input class="form-control" type="text" name="implication_remark[]" id="implication_col_4"></td></tr>`;

                var lastRow = $('#implicationTable tr').last();
                lastRow.after(html);
                count_row_implication++;

                // close or dismiss modal
                $('#modal-addNewItemImplication').modal('hide');
            } else {

                // check if implication_item_title is empty or null
                if ($('#item_implication_title').val() == '' || $('#item_implication_title').val() == null) {

                    // add class is-invalid to #implication_item_title
                    $('#item_implication_title').addClass('is-invalid');

                    // append invalid-feedback after #implication_item_title
                    $('#item_implication_title').after(`<div class="invalid-feedback">Sila isi tajuk perkara</div>`);

                    // remove invalid-feedback after 3 seconds
                    setTimeout(function() {
                        $('.invalid-feedback').remove();
                    }, 3000);

                    // remove class is-invalid after 3 seconds
                    setTimeout(function() {
                        $('#item_implication_title').removeClass('is-invalid');
                    }, 3000);

                }

                else {

                    // get value of implication_item_title
                    var implication_item_title = $('#item_implication_title').val();

                    // make implication_item_title empty
                    $('#item_implication_title').val('');

                    var html = `<tr id="implication_` + count_row_implication + `"><th scope="col">` + count_row_implication + `.</th>
                                <td>
                                    <div class="h-2" name="implication_title[]">` + implication_item_title + ` :-</div>
                                    <br>
                                    <ul class="" id="implication_`+ count_row_implication +`_col_1">
                                        <li>
                                            <input class="form-control" type="text" name="implication_item[]" id="implication_col_1">
                                        </li> 
                                    </ul>
                                    <div class="d-grid gap-2 my-2">
                                        <button type="button" class="btn btn-outline-primary" id="btn_add_implication_item">+ Tambah Maklumat</button>
                                        <button type="button" class="btn btn-outline-danger" id="btn_remove_implication_item" onclick="removeInputField('implication_`+ count_row_implication +`_1_col_1')">- Buang Maklumat</button>
                                        <button type="button" class="btn btn-outline-danger" id="btn_remove_implication" onclick="removeInputField('implication_` + count_row_implication + `')">- Buang Perkara</button>
                                    </div>
                                </td>
                                <td scope="col">
                                    <div class="h-2">-</div>
                                    <br>
                                    <ul class="" style="list-style: none;" id="implication_`+ count_row_implication +`_col_2">
                                        <li id="implication_`+ count_row_implication +`_1_col_2">
                                            <input class="form-control" type="text" name="implication_quantity[]">
                                        </li>
                                    </ul>
                                </td>
                                <td scope="col">
                                    <div class="h-2">-</div>
                                    <br>
                                    <ul class="" style="list-style: none;" id="implication_`+ count_row_implication +`_col_3">
                                        <li id="implication_`+ count_row_implication +`_1_col_3">
                                            <input class="form-control" type="text" name="implication_pricePerUnit[]" id="implication_col_3">
                                        </li>
                                    </ul>
                                </td>
                                <td><input class="form-control h-4" type="text" name="implication_remark[]" id="implication_col_4"></td>
                            </tr>`;

                    var lastRow = $('#implicationTable tr').last();
                    lastRow.after(html);
                    count_row_implication++;

                    // close or dismiss modal
                    $('#modal-addNewItemImplication').modal('hide');

                     // onclick #btn_add_implication_item, add new item to multiple implication to ul li id="implication_1_col_1"
                    $('#btn_add_implication_item').click(function() {
                        // var html = `<li id="implication_` + count_row_implication + `_1_col_2">
                        //                 <input class="form-control" type="text" name="implication_item[]" id="implication_col_1">
                        //             </li>`;

                        // var lastRow = $('#implication_1_col_1 li').last();
                        // lastRow.after(html);
                        // // count_row_implication++;

                        // console.log(count_row_implication);

                        // console.log(count_row_implication);

                        // var row = $(this).closest('tr');
                        var row = count_row_implication - 1;

                        var html1 = `<li>
                                        <input class="form-control" type="text" name="implication_item[]" id="implication_col_1">
                                    </li>`;

                        var lastRow_col_1 = $('#implication_'+ row +'_col_1 li').last();
                        // console.log(lastRow_col_1);
                        lastRow_col_1.after(html1);

                        var html2 = `<li>
                                        <input class="form-control" type="text" name="implication_quantity[]">
                                    </li>`;
                        var lastRow_col_2 = $('#implication_'+ row +'_col_2 li').last();
                        lastRow_col_2.after(html2);

                        var html3 = `<li>
                                        <input class="form-control" type="text" name="implication_pricePerUnit[]" id="implication_col_3">
                                    </li>`;
                        var lastRow_col_3 = $('#implication_'+ row +'_col_3 li').last();
                        lastRow_col_3.after(html3);
                    });

                    // onclick #btn_remove_implication_item, remove last line from ul li id="implication_1_col_1"
                    $('#btn_remove_implication_item').click(function() {
                        var row = count_row_implication - 1;

                        var lastRow_col_1 = $('#implication_'+ row +'_col_1 li').last();
                        lastRow_col_1.remove();

                        var lastRow_col_2 = $('#implication_'+ row +'_col_2 li').last();
                        lastRow_col_2.remove();

                        var lastRow_col_3 = $('#implication_'+ row +'_col_3 li').last();
                        lastRow_col_3.remove();
                    });
                }
            }

        });

        $('#multipleItem').click(function() {
            implicationIsSingle = false;
            $('#implicationIsMultiple').show();
        });
        $('#singleItem').click(function() {
            implicationIsSingle = true;
            $('#implicationIsMultiple').hide();
        });



    });

    // remove input field
    function removeInputField(field_id){
        $("#" + field_id).remove();
        
        // if field_id has background, decrement count_row_background
        if (field_id.includes("background")) {
            count_row_background--;
        }

        // if field_id has objective, decrement count_row_objective
        if (field_id.includes("objective")) {
            count_row_objective--;
        }

        // if field_id has targetGroup, decrement count_row_targetGroup
        if (field_id.includes("targetGroup")) {
            count_row_targetGroup--;
        }

        // if field_id has tentative, decrement count_row_tentative
        if (field_id.includes("tentative")) {
            count_row_tentative--;
        }

        // if field_id has format like tentatives_day_X_Y, get value of X and Y
        if (field_id.includes("tentatives_day")) {
            var split = field_id.split("_");
            var day = split[2];
            timeAndItems[day]--;
            updateTimeAndItemsValue();
        }

        if (field_id.includes("implication")) {
            count_row_implication--;

            // update tr all with an id #implication_X, exclude the first row and ignore it from the loop (i = 1)
            var trs = $('#implicationTable tr');
            for (var i = 0; i < trs.length; i++) {
                var tr = trs[i];
                var id = tr.id;
                if (id.includes("implication")) {
                    var split = id.split("_");
                    var number = split[1];
                    var newId = "implication_" + (i - 1);
                    tr.id = newId;
                    var th = tr.children[0];
                    th.innerHTML = (i - 1) + ".";
                }
            }
        }

        if (field_id.includes("implication" && "col")) {

            // text format is implication_X_Y_col_Z, get value of X, Y and Z
            var split = field_id.split("_");
            var x = split[1];
            var y = split[2]; // y is the row number
            var col = split[4];

            console.log("x: " + x + ", y: " + y + ", col: " + col);

            if (y != 1) {
                $("#implication_" + x + "_" + y + "_col_1").remove();
                $("#implication_" + x + "_" + y + "_col_2").remove();
                $("#implication_" + x + "_" + y + "_col_3").remove();
            }
        }
    }

    function getDayAndDate(date) {
        var date = new Date(date);
        var dateArray = [];
        var day = date.getDay();
        var month = date.getMonth();
        var year = date.getFullYear();
        // format like this: Ahad, 1 Januari 2020
        var dayAndDate = days[day] + ", " + date.getDate() + " " + monthNames[month] + " " + year;
        dateArray.push(dayAndDate);

        return dateArray;
    }

    function getDaysAndDate(programDateStart, programDateEnd, duration) {
        var dateStart = new Date(programDateStart);
        var dateEnd = new Date(programDateEnd);
        var dateArray = [];
        for (var i = 0; i < duration; i++) {
            var day = dateStart.getDay();
            var month = dateStart.getMonth();
            var year = dateStart.getFullYear();
            // format like this: Ahad, 1 Januari 2020
            var dayAndDate = days[day] + ", " + dateStart.getDate() + " " + monthNames[month] + " " + year;
            dateArray.push(dayAndDate);
            dateStart.setDate(dateStart.getDate() + 1);
        }
        return dateArray;
    }

    // add input fields in tentative div
    function createInputFieldTentative() {
        // get the value of program-date

        $("#tentative").show();

        // hide #warning-dateNotFilled
        $("#warning-dateNotFilled").hide();

        if (isOneDayProgram) {

            var programDate = $("#program-date").val();

            // get days array
            var dayAndDate = getDayAndDate(programDate, 1);

            // set count_tentatives array based on dayAndDate array
            count_tentatives = new Array(dayAndDate.length);

            // format program-date to dd Month yyyy
            var date = new Date(programDate);
            var programDate = date.getDate() + " " + monthNames[date.getMonth()] + " " + date.getFullYear();    
            $("#program_date").val(programDate);

            duration = 1;

            // clear tentative-inputs div
            $("#tentative-inputs").empty();

            // append input fields after tentative-inputs div based on dayAndDate array
            count_tentatives[0] = 0;

            // push duration to timeAndItems array
            timeAndItems = new Array(duration);

            // set 0s to timeAndItems array
            for (var i = 0; i < duration; i++) {
                timeAndItems[i] = 1;
            }

            updateTimeAndItemsValue();
            
            $("#tentative-inputs").append(
                `<div class="row">
                    <div class="mb-3">
                        <label for="tentatives_day_0">`+dayAndDate[0]+`</label>
                        <div class="d-flex m-2" id="tentatives_day_0_` + count_tentatives[0] + `">
                            <input type="text" class="form-control me-2" placeholder="Masa (format 24 jam, contoh: 08:30)" id="timepicker" name="tentatives_time[]" required/>
                            <input type="text" class="form-control" placeholder="Perkara" id="tentatives-day-0-` + count_tentatives[0] + `" name="tentatives_item[]" required>
                            <button type="button" class="btn btn-outline-danger w-25 h-100 px-2 ms-4" onclick="removeInputField('tentatives_day_0_` + count_tentatives[0] + `')" disabled>X</button>
                        </div>
                        <hr id="tentatives-line-0" hidden>
                        <button type="button" class="btn btn-primary" id="btn_add_tentative_0" onclick="addNewInputFieldTentatives(0)">Tambah</button>
                    </div>
                </div>`
            );

        } else if ($("#program-date-start").val() != "" && $("#program-date-end").val() != "") {

            var programDateStart = $("#program-date-start").val();
            var programDateEnd = $("#program-date-end").val();

            var programDateStart = new Date(programDateStart);
            var programDateEnd = new Date(programDateEnd);

            // calculate duration of program date
            duration = Math.round((programDateEnd - programDateStart) / (1000 * 60 * 60 * 24)) + 1;

            var dayAndDate = getDaysAndDate(programDateStart, programDateEnd, duration);

            // format program-date-start to dd Month yyyy
            var programDateStart = programDateStart.getDate() + " " + monthNames[programDateStart.getMonth()] + " " + programDateStart.getFullYear();

            // format program-date-end to dd Month yyyy
            var programDateEnd = programDateEnd.getDate() + " " + monthNames[programDateEnd.getMonth()] + " " + programDateEnd.getFullYear();

            // change value of #program_date
            $("#program_date").val(programDateStart + " sehingga " + programDateEnd);

            count_tentatives = new Array(dayAndDate.length);

            // clear tentative-inputs div
            $("#tentative-inputs").empty();

            // insertBefore #tentative-inputs
            $("#tentative-inputs").append("Program ini akan berlangsung selama " + duration + " hari");
            $('#tentative-inputs').append('<br>');

            // attach duration to #program_duration value
            $("#program-duration").val(duration);

            // push duration to timeAndItems array
            timeAndItems = new Array(duration);
            
            // set 0s to timeAndItems array
            for (var i = 0; i < duration; i++) {
                timeAndItems[i] = 1;
            }

            updateTimeAndItemsValue();

            // append input fields after tentative-inputs div based on dayAndDate array
            for (var i = 0; i < dayAndDate.length; i++) {
                count_tentatives[i] = 0;
                $("#tentative-inputs").append(
                    `<div class="row">
                        <div class="mb-3">
                            <label for="tentatives_day_` + i + `">`+dayAndDate[i]+`</label>
                            <div class="d-flex m-2" id="tentatives_day_` + i + `_` + count_tentatives[i] + `">
                                <input type="text" class="form-control me-2" placeholder="Masa (format 24 jam, contoh: 08:30)" id="timepicker" name="tentatives_time[]" required/>
                                <input type="text" class="form-control" placeholder="Perkara" id="tentatives-day-` + i + `-` + count_tentatives[i] + `" name="tentatives_item[]" required>
                                <button type="button" class="btn btn-outline-danger w-25 h-100 px-2 ms-4" onclick="removeInputField('tentatives_day_` + i + `_` + count_tentatives[i] + `')" disabled>X</button>
                            </div>
                            <hr id="tentatives-line-` + i + `" hidden>
                            <button type="button" class="btn btn-primary" id="btn_add_tentative_` + i + `" onclick="addNewInputFieldTentatives(`+i+`)">Tambah</button>
                        </div>
                    </div>`
                );
            }
        }

    }

    // append current timeAndItems to #program-tentatives-item value
    function updateTimeAndItemsValue() {
        $("#program-tentatives-item").val(timeAndItems);
    }

    function addNewInputFieldTentatives(i) {
        count_tentatives[i]++;
        var clone = $("#tentatives_day_" + i + "_0").clone().insertBefore("#tentatives-line-" + i);
        clone.attr("id","tentatives_day_" + i + "_" + count_tentatives[i]);

        // change name and id of input timepicker
        clone.find("#timepicker").attr("name","tentatives_time[]");

        // clear value of input timepicker
        clone.find("#timepicker").val("");
        clone.find("#timepicker").timepicker();

        // change name and id of input tentatives
        clone.find("#tentatives-day-" + i + "-0").attr("name","tentatives_item[]");
        clone.find("#tentatives-day-" + i + "-0").attr("id","tentatives-day-" + i + "-"+count_tentatives[i]);

        // clear value of input tentatives
        clone.find("#tentatives-day-" + i + "-" + count_tentatives[i]).val("");

        // change id of button
        clone.find("button").attr("onclick","removeInputField('tentatives_day_" + i + "_" + count_tentatives[i] + "')");
        clone.find("button").attr("id","btn_remove_tentative_" + i + "_"+count_tentatives[i]);

        // enable remove button
        clone.find("button").attr("disabled",false);

        // $("#timepicker").timepicker();

        timeAndItems[i]++;
        updateTimeAndItemsValue();
    }


    function checkDates() {
        // Get the start date and end date from the input fields
        var startDate = $("#program-date-start").val();
        var endDate = $("#program-date-end").val();

        // Create Date objects from the start and end dates
        var start = new Date(startDate);
        var end = new Date(endDate);

        if (!isOneDayProgram) {
            if (end < start && endDate != "") {
                alert("Tarikh mula program tidak boleh melebihi tarikh tamat program");
                $("#program-date-end").val("");
            } else if (end < start && endDate == "") {
                alert("Tarikh mula program tidak boleh melebihi tarikh tamat program");
                $("#program-date-end").val("");
            }

            if ($("#program-date-start").val() == "" || $("#program-date-end").val() == "") {
                $("#tentative").hide();
            } else {
                // add the days to the tentative div
                $("#tentative").show();
            }
        }
    }


    $('#program-date-type').change(function() {
        if ($(this).is(":checked")) {
            $(".date-day").addClass("d-block");
            $(".date-start").addClass("d-none");
            $(".date-end").addClass("d-none");
            $(".date-day").removeClass("d-none");
            $(".date-start").removeClass("d-block");
            $(".date-end").removeClass("d-block");
            isOneDayProgram = true;
        } else {
            $(".date-day").addClass("d-none");
            $(".date-start").addClass("d-block");
            $(".date-end").addClass("d-block");
            $(".date-day").removeClass("d-block");
            $(".date-start").removeClass("d-none");
            $(".date-end").removeClass("d-none");
            isOneDayProgram = false;
        }

        if ($("#program-date-start").val() == "" || $("#program-date-end").val() == "") {
            $("#tentative").hide();
        } else {
            createInputFieldTentative();
        }

    });

    // set selected learningOutcome if $paperworkDetails->learningOutcome is not null
    function setSelectedLearningOutcome(value) {
        $("#hasil-pembelajaran-" + value).prop("selected", true);
    }

    $(function() {
        // add new input for background
        $('#btn_add_background').on('click',function(){
            count_row_background++;
            var clone = $("#background_1").clone().insertBefore("#background-line");

            console.log(count_row_background);

            clone.attr("id","background_"+count_row_background);
            clone.find("textarea").val("");
            clone.find("textarea").attr("id","background_"+count_row_background);
            clone.find("textarea").attr("name","paperwork_background[]");

            clone.find("button").attr("id","btn_remove_background_"+count_row_background);
            clone.find("button").attr("onclick","removeInputField('background_"+count_row_background+"')");
            clone.find("button").attr("disabled",false);
        });

        // add new input for objective
        $('#btn_add_objective').on('click',function(){
            count_row_objective++;
            var clone = $("#objective_1").clone().insertBefore("#objective-line");

            console.log(count_row_objective);

            clone.attr("id","objective_"+count_row_objective);
            clone.find("textarea").val("");
            clone.find("textarea").attr("id","objective_"+count_row_objective);
            clone.find("textarea").attr("name","paperwork_objective[]");

            clone.find("button").attr("id","btn_remove_objective_"+count_row_objective);
            clone.find("button").attr("onclick","removeInputField('objective_"+count_row_objective+"')");
            clone.find("button").attr("disabled",false);
        });

        // add new input for targetGroup
        $('#btn_add_targetGroup').on('click',function(){
            count_row_targetGroup++;
            var clone = $("#targetGroup_1").clone().insertBefore("#targetGroup-line");

            console.log(count_row_targetGroup);

            clone.attr("id","targetGroup_"+count_row_targetGroup);
            clone.find("input").val("");
            clone.find("input").attr("id","targetGroup_"+count_row_targetGroup);
            clone.find("input").attr("name","paperwork_targetGroup[]");

            clone.find("button").attr("id","btn_remove_targetGroup_"+count_row_targetGroup);
            clone.find("button").attr("onclick","removeInputField('targetGroup_"+count_row_targetGroup+"')");
            clone.find("button").attr("disabled",false);
        });
    });

    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
    }, 4000);

</script>
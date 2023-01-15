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
                        <a class="nav-item nav-link active" id="nav-info-tab" data-bs-toggle="tab" href="#nav-info" role="tab" aria-controls="nav-info" aria-selected="true">Maklumat Asas</a>
                        <a class="nav-item nav-link" id="nav-intro-tab" data-bs-toggle="tab" href="#nav-intro" role="tab" aria-controls="nav-intro" aria-selected="false">Pendahuluan</a>
                        <a class="nav-item nav-link" id="nav-tentative-tab" data-bs-toggle="tab" href="#nav-tentative" role="tab" aria-controls="nav-tentative" aria-selected="false">Tentatif</a>
                        <a class="nav-item nav-link" id="nav-financial-tab" data-bs-toggle="tab" href="#nav-financial" role="tab" aria-controls="nav-financial" aria-selected="false">Kewangan</a>
                        <a class="nav-item nav-link" id="nav-ajk-tab" data-bs-toggle="tab" href="#nav-ajk" role="tab" aria-controls="nav-ajk" aria-selected="false">Jawatankuasa</a>
                        <a class="nav-item nav-link" id="nav-signature-tab" data-bs-toggle="tab" href="#nav-signature" role="tab" aria-controls="nav-signature" aria-selected="false">Tandatangan</a>
                    </div>
                </nav>
                <form id="form-paperwork" action="{{ route('paperwork-generator.save', $paperwork->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data" novalidate>
                <div class="tab-content card card-body border-0 shadow mb-4" id="nav-tabContent" >
                    @csrf
                    <div class="tab-pane fade show active" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab">
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
                                        placeholder="Kelab ABC, Kelab DEF"
                                        @if($paperwork->collaborations != null) { value="{{ $paperwork->collaborations }}"} @endif>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="program-preparedby">Disediakan oleh</label>
                                <input class="form-control" id="collab" type="text" name="program_preparedby"
                                        placeholder="Nama pengarah program atau setiausaha">
                            </div>
                        </div> --}}
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
                                <textarea class="form-control" id="pendahuluan" name="paperwork_introduction" required>@if($paperworkDetails->introduction != null){{$paperworkDetails->introduction}}@endif</textarea>
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
                                <textarea class="form-control" id="anjuran" name="paperwork_organizedBy" required>@if($paperworkDetails->organizedBy != null){{$paperworkDetails->organizedBy}}@endif</textarea>
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
                    <div class="tab-pane fade" id="nav-financial" role="tabpanel" aria-labelledby="nav-financial-tab">
                        <h1>Implikasi Kewangan</h1>
                        <input type="text" name="implication_details" id="implication_details" hidden>
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
                                    <input type="text" id="implication-items-count" name="implication_count_items" hidden>
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
                        <div class="container-fluid mb-4">
                            <div class="row">
                                <div class="col-5">
                                    <h5>Jawatan</h5>
                                </div>
                                <div class="col-6">
                                    <h5>Nama Penuh</h5>
                                </div>
                                <div class="col-1">
                                </div>
                            </div>
                        </div>
                        <input type="text" class="form-control" id="committee_row_1" name="committee_row[]" hidden />
                        <div class="container-fluid mb-4" id="ajk_1">
                            <div class="row mt-2">
                                <div class="col-5">
                                    <input type="text" class="form-control" id="committee_position_1" name="committee_position[]" value="" />
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" id="committee_name_1" name="committee_name[]" value="" />
                                </div>
                                <button type="button" id="add_ajk_name_1" onclick="addNewAjkName('ajk_1')" class="btn btn-outline-primary col-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tambah Nama" disabled>
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <hr id="ajk-name-line-1" hidden>
                            <div class="row mt-2">
                                <div class="col-7"></div>
                                <button type="button" id="btn_remove_ajk_1" class="btn btn-outline-danger h-auto col-3" onclick="removeInputField('ajk_1')" disabled>
                                    Padam Jawatan
                                </button>
                            </div>
                        </div>
                        <hr id="ajk-line" hidden>
                        <div class="my-3 row">
                            <div class="col-12 col-sm-4 col-md-4 offset-md-4">
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-outline-secondary" id="btn_add_ajk">+ Tambah Jawatan Baru</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- TANDATANGAN --}}
                    <div class="tab-pane fade" id="nav-signature" role="tabpanel" aria-labelledby="nav-signature-tab">
                        <h1>Tandatangan</h1>
                        <div class="row">
                            <h5>Maklumat Penyedia Kertas Kerja</h5>
                            <div class="col-md-6 mb-3">
                                <label for="program-signature-preparedBy">Nama Penuh</label>
                                <input class="form-control" id="program-signature-preparedBy-0" type="text" name="program_signature[]" placeholder="Nama pengarah program atau setiausaha">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="program-signature-preparedBy">Jawatan</label>
                                <input class="form-control" id="program-signature-preparedBy-1" type="text" name="program_signature[]" placeholder="Jawatan dalam program atau kelab">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="program-signature-preparedBy">No. H/P</label>
                                <input class="form-control" id="program-signature-preparedBy-2" type="text" name="program_signature[]" placeholder="No. H/P">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="program-signature-preparedBy">Emel</label>
                                <input class="form-control" id="program-signature-preparedBy-3" type="text" name="program_signature[]" placeholder="Alamat emel">
                            </div>
                            <div class="col-md-6 mb-3">

                                {{-- <canvas id="signature-pad" width="200" height="200" style="border:1px solid">
                                    
                                </canvas> --}}
                            </div>
                        </div>
                        <div class="row">
                            <h5>Maklumat Presiden Kelab</h5>
                            <div class="col-md-6 mb-3">
                                <label for="program-signature-preparedBy">Nama Penuh</label>
                                <input class="form-control" id="program-signature-preparedBy-4" type="text" name="program_signature[]" placeholder="Nama presiden kelab">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="program-signature-preparedBy">Jawatan</label>
                                <input class="form-control" id="program-signature-preparedBy-5" type="text" name="program_signature[]" placeholder="Jawatan dalam program atau kelab" value="Presiden" disabled>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="program-signature-preparedBy">No. H/P</label>
                                <input class="form-control" id="program-signature-preparedBy-6" type="text" name="program_signature[]" placeholder="No. H/P">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="program-signature-preparedBy">Emel</label>
                                <input class="form-control" id="program-signature-preparedBy-7" type="text" name="program_signature[]" placeholder="Alamat emel">
                            </div>
                        </div>
                    </div>
                    <div class="flex mt-3">
                        <input type="submit" id="btn-save" class="btn btn-primary mt-2 animate-up-2" value="Simpan"/>
                        {{-- <button type="button" class="btn btn-primary mt-2 animate-up-2" id="btn-save">Simpan</button> --}}
                        <button type="button" class="btn btn-secondary mt-2 animate-up-2">Hantar</button>
                        <button type="button" id="btn-viewPDF" class="btn btn-gray-100 mt-2 animate-up-2">Lihat PDF</button>
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
                        <input type="text" class="form-control" id="input_implication_title" placeholder="Nama perkara baru" autocomplete="off" required>
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

<script>

    var isOneDayProgram;
    // var program-date-start = $("#program-date-start").val();
    var programDate;
    var programDateStart;
    var programDateEnd;

    var count_row_background = {{ $rows->background }};
    var count_row_objective = {{ $rows->objective }};
    var count_row_targetGroup = {{ $rows->targetGroup }};

    var count_row_implication = 0;
    var count_row_implication_items = new Array();

    // for (var i = 0; i < count_row_implication; i++) {
    //     count_row_implication_items[i] = 0;
    // }

    var count_row_implication_item = new Array(count_row_implication);

    var single = 0;
    var multiple = 0;

    var count_row_ajk = 1;
    var count_row_each_ajk = new Array(count_row_ajk);
    count_row_each_ajk[0] = 1;

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

        if ({{ $paperworkDetails->learningOutcome }} === '' || {{ $paperworkDetails->learningOutcome }} === null) {
        } else {
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

    $('#btn-save').click(function() {
        // append all inputs with attribute name="implication", to #implication_details value of each input
        // $('#implication_details').val(" ");
        // for (var i = 0; i <= count_row_implication; i++) {
        //     // $('#implication_details').val("i_"+ i);

        //     // append new value to #implication_details without deleting previous
        //     $('#implication_details').val($('#implication_details').val() + $('#implication_' + i).val() + " ");

        //     // append all inputs with attribute name="implication_item", to #implication_item_details value of each input
        //     // $('#implication_item_details').val("");
        // }

        updateImplicationItemsCount();

        $('#committee_row_1').val(count_row_each_ajk);

        $('#implication_details').val(count_row_implication_item);
        
        // append input with name "implication_item", to #implication_item_details value of each input
    });

    // Open PDF in new tab when Lihat PDF clicked
    $('#btn-viewPDF').click(function() {
        fetch("{{ route('paperwork-generator.viewPDF', $paperwork->id) }}")
            .then(function(response) {
                window.open(response.url, '_blank');
            });
    });

    // implication
    $(document).ready(function() {     
        var implicationIsSingle = false;

        fetchInputFieldImplications();
        
        // add input field in implication table
        $('#addImplication').click(function() {

            var implication_title = $('#input_implication_title').val();

            // check if implication_item_title is empty or null
            if ($('#input_implication_title').val() == '' || $('#input_implication_title').val() == null) {

                // add class is-invalid to #implication_item_title
                $('#input_implication_title').addClass('is-invalid');

                // append invalid-feedback after #implication_item_title
                $('#input_implication_title').after(`<div class="invalid-feedback">Sila isi tajuk perkara</div>`);

                // remove invalid-feedback after 3 seconds
                setTimeout(function() {
                    $('.invalid-feedback').remove();
                }, 3000);

                // remove class is-invalid after 3 seconds
                setTimeout(function() {
                    $('#input_implication_title').removeClass('is-invalid');
                }, 3000);

            } else {

                // make implication_item_title empty
                $('#input_implication_title').val('');

                if (implicationIsSingle) {
                var html = `<tr id="implication_` + count_row_implication + `"><th scope="col">#</th>
                                <td>
                                    <input type="text" name="single_implication[]" value="`+ implication_title +`" hidden>
                                    <input class="form-control" type="text" name="implication_titles[]" value="`+ implication_title +`" id="implication_col_1">
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

                single++;

                // close or dismiss modal
                $('#modal-addNewItemImplication').modal('hide');
                
                } else {

                    multiple++;

                    var html = `<tr id="implication_` + count_row_implication + `"><th scope="col">#</th>
                                <td>
                                    <input type="text" name="multiple_implication[]" value="` + implication_title + `" hidden>
                                    <input type="text" name="implication_titles[]" value="` + implication_title + `" hidden>
                                    <div class="h-2">` + implication_title + ` :-</div>
                                    <br>
                                    <ul class="" id="implication_`+ count_row_implication +`_col_1">
                                        <li>
                                            <input class="form-control" type="text" name="implication_item[]" id="implication_col_1">
                                        </li> 
                                    </ul>
                                    <div class="d-grid gap-2 my-2">
                                        <button type="button" class="btn btn-outline-primary" id="btn_add_implication_item_` + count_row_implication + `">+ Tambah Maklumat</button>
                                        <button type="button" class="btn btn-outline-danger" id="btn_remove_implication_item_` + count_row_implication + `">- Buang Maklumat</button>
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

                    count_row_implication_items.push(1);

                    count_row_implication++;

                    // close or dismiss modal
                    $('#modal-addNewItemImplication').modal('hide');

                    // hide #btn_remove_implication_item
                    $('#btn_remove_implication_item_' + (count_row_implication - 1)).hide();

                    // onclick #btn_add_implication_item, add new item to multiple implication to ul li id="implication_1_col_1"
                    $('#btn_add_implication_item_' + (count_row_implication - 1)).click(function() {

                        var row = count_row_implication - 1;

                        var html1 = `<li>
                                        <input class="form-control" type="text" name="implication_item[]" id="implication_col_1">
                                    </li>`;

                        var lastRow_col_1 = $('#implication_'+ row +'_col_1 li').last();
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

                        // show #btn_remove_implication_item
                        $('#btn_remove_implication_item_' + row).show();
                        
                        count_row_implication_items[count_row_implication - 1]++;
                    });

                    // onclick #btn_remove_implication_item, remove last line from ul li id="implication_1_col_1"
                    $('#btn_remove_implication_item_' +  (count_row_implication - 1)).click(function() {
                        var row = count_row_implication - 1;

                        var count_row_implication_item = $('#implication_'+ row +'_col_1 li').length;

                        if (count_row_implication_item == 1) {
                            $('#btn_remove_implication_item_' + (count_row_implication - 1)).hide();
                        } else {
                            var lastRow_col_1 = $('#implication_'+ row +'_col_1 li').last();
                            lastRow_col_1.remove();
                            
                            var lastRow_col_2 = $('#implication_'+ row +'_col_2 li').last();
                            lastRow_col_2.remove();
                            
                            var lastRow_col_3 = $('#implication_'+ row +'_col_3 li').last();
                            lastRow_col_3.remove();

                            if (count_row_implication_item == 2) {
                                $('#btn_remove_implication_item_' + row).hide();
                            }

                            count_row_implication_items[count_row_implication - 1]--;
                        }
                    });
                }
            }
        });

        $('#multipleItem').click(function() {
            implicationIsSingle = false;
            // $('#implicationIsMultiple').show();
        });
        $('#singleItem').click(function() {
            implicationIsSingle = true;
            // $('#implicationIsMultiple').hide();
        });
    });

    function updateImplicationItemsCount() {
        $('#implication-items-count').val(count_row_implication_items);
    }

    function fetchInputFieldImplications() {
        var financial = '<?php echo $paperworkDetails->financialImplication; ?>';

        if (financial != null && financial != '') {
            var financialJson = JSON.parse(financial);

            for (var i = 0; i < financialJson.implications.length; i++) {
                
                let imp = financialJson.implications[i];
                if (imp.isSingle) {
                    var html = `<tr id="implication_` + (i + 1) + `"><th scope="col">#</th>
                                    <td>
                                        <input type="text" name="single_implication[]" value="`+ imp.title +`" hidden>
                                        <input class="form-control" type="text" name="implication_titles[]" value="`+ imp.title +`" id="implication_col_1">
                                        <div class="d-grid gap-2 my-2">
                                            <button type="button" class="btn btn-outline-danger" id="btn_remove_implication" onclick="removeInputField('implication_` + (i+1) + `')">- Buang Perkara</button>
                                        </div>
                                    </td>
                                    <td scope="col"><input class="form-control" type="text" name="implication_quantity[]" value="`+ imp.quantity +`" id="implication_col_2"></td>
                                    <td scope="col"><input class="form-control" type="text" name="implication_pricePerUnit[]" value="`+ imp.pricePerUnit +`" id="implication_col_3"></td>
                                    <td><input class="form-control" type="text" name="implication_remark[]" value="`+ imp.remark +`" id="implication_col_4"></td>
                                </tr>`;

                    var lastRow = $('#implicationTable tr').last();
                    lastRow.after(html);

                    count_row_implication++;

                    single++;
                } else if (!imp.isSingle) {
                    var html = `<tr id="implication_` + (i + 1) + `"><th scope="col">#</th>
                        <td>
                            <input type="text" name="multiple_implication[]" value="` + imp.title + `" hidden>
                            <input type="text" name="implication_titles[]" value="` + imp.title + `" hidden>
                            <div class="h-2">` + imp.title + ` :-</div>
                            <br>
                            <ul class="" id="implication_`+ (i+1) +`_col_1">
                                <li>
                                    <input class="form-control" type="text" name="implication_item[]" id="implication_col_1">
                                </li> 
                            </ul>
                            <div class="d-grid gap-2 my-2">
                                <button type="button" class="btn btn-outline-primary" id="btn_add_implication_item_` + (i+1) + `">+ Tambah Maklumat</button>
                                <button type="button" class="btn btn-outline-danger" id="btn_remove_implication_item_` + (i+1) + `">- Buang Maklumat</button>
                                <button type="button" class="btn btn-outline-danger" id="btn_remove_implication" onclick="removeInputField('implication_` + (i+1)+ `')">- Buang Perkara</button>
                            </div>
                        </td>
                        <td scope="col">
                            <div class="h-2">-</div>
                            <br>
                            <ul class="" style="list-style: none;" id="implication_`+ (i+1) +`_col_2">
                                <li id="implication_`+ (i+1) +`_1_col_2">
                                    <input class="form-control" type="text" name="implication_quantity[]">
                                </li>
                            </ul>
                        </td>
                        <td scope="col">
                            <div class="h-2">-</div>
                            <br>
                            <ul class="" style="list-style: none;" id="implication_`+ (i+1) +`_col_3">
                                <li id="implication_`+ (i+1) +`_1_col_3">
                                    <input class="form-control" type="text" name="implication_pricePerUnit[]" id="implication_col_3">
                                </li>
                            </ul>
                        </td>
                        <td><input class="form-control h-4" type="text" name="implication_remark[]" id="implication_col_4" value="` +  imp.remark + `"></td>
                    </tr>`;

                    var lastRow = $('#implicationTable tr').last();
                    lastRow.after(html);

                    if (count_row_implication_items[i] == 0) {
                        count_row_implication_items[i]++;
                    } else {
                        count_row_implication_items.push(1);
                    }

                    // count_row_implication_items.push(1);
                    // count_row_implication_items[i]++;
                    count_row_implication++;

                    multiple++;

                    $('#btn_remove_implication_item_' + (i+1)).hide();

                    if (imp.item.length > 0) {
                        var row = count_row_implication;

                        for (var j=0; j < imp.item.length; j++) {
                            var html1 = `<li>
                                            <input class="form-control" type="text" name="implication_item[]" id="implication_col_1" value="` +  imp.item[j].name + `">
                                        </li>`;
    
                            var lastRow_col_1 = $('#implication_'+ row +'_col_1 li').last();
                            lastRow_col_1.after(html1);
    
                            var html2 = `<li>
                                            <input class="form-control" type="text" name="implication_quantity[]" value="` +  imp.item[j].quantity+ `">
                                        </li>`;
                            var lastRow_col_2 = $('#implication_'+ row +'_col_2 li').last();
                            lastRow_col_2.after(html2);
    
                            var html3 = `<li>
                                            <input class="form-control" type="text" name="implication_pricePerUnit[]" id="implication_col_3" value="` +  imp.item[j].pricePerUnit + `">
                                        </li>`;
                            var lastRow_col_3 = $('#implication_'+ row +'_col_3 li').last();
                            lastRow_col_3.after(html3);
    
                            // show #btn_remove_implication_item
                            $('#btn_remove_implication_item_' + row).show();
                            
                            // count_row_implication_items[count_row_implication]++;

                            // console.log(count_row_implication);
                            // console.log(count_row_implication_items);
                            // console.log(count_row_implication_items[i]);
                            // console.log(count_row_implication_items[count_row_implication]);
                            // console.log(count_row_implication_items[count_row_implication - 1]);
                        }

                        // console.log(count_row_implication_items[count_row_implication - 1]);

                        var lastRow_col_1 = $('#implication_'+ row +'_col_1 li').first();
                        lastRow_col_1.remove();
                        
                        var lastRow_col_2 = $('#implication_'+ row +'_col_2 li').first();
                        lastRow_col_2.remove();
                        
                        var lastRow_col_3 = $('#implication_'+ row +'_col_3 li').first();
                        lastRow_col_3.remove();

                        if (count_row_implication_item[i] == 2) {
                            $('#btn_remove_implication_item_' + row).hide();
                        }
                    }

                    // onclick #btn_add_implication_item, add new item to multiple implication to ul li id="implication_1_col_1"
                    $('#btn_add_implication_item_' + (i+1)).click(function() {

                        var row = count_row_implication - 1;

                        var html1 = `<li>
                                        <input class="form-control" type="text" name="implication_item[]" id="implication_col_1">
                                    </li>`;

                        var lastRow_col_1 = $('#implication_'+ row +'_col_1 li').last();
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

                        // show #btn_remove_implication_item
                        $('#btn_remove_implication_item_' + row).show();
                        
                        count_row_implication_items[count_row_implication]++;
                        console.log("after add ", count_row_implication_items[count_row_implication]);
                    });

                    // onclick #btn_remove_implication_item, remove last line from ul li id="implication_1_col_1"
                    $('#btn_remove_implication_item_' +  (i+1)).click(function() {
                        var row = count_row_implication - 1;

                        var count_row_implication_item = $('#implication_'+ row +'_col_1 li').length;

                        if (count_row_implication_item == 1) {
                            $('#btn_remove_implication_item_' + (count_row_implication - 1)).hide();
                        } else {
                            var lastRow_col_1 = $('#implication_'+ row +'_col_1 li').last();
                            lastRow_col_1.remove();
                            
                            var lastRow_col_2 = $('#implication_'+ row +'_col_2 li').last();
                            lastRow_col_2.remove();
                            
                            var lastRow_col_3 = $('#implication_'+ row +'_col_3 li').last();
                            lastRow_col_3.remove();

                            if (count_row_implication_item == 2) {
                                $('#btn_remove_implication_item_' + row).hide();
                            }

                            count_row_implication_items[count_row_implication - 1]--;
                        }
                    });
                }
            }
        } 
    }

    // committee
    $(document).ready(function() {
        var count_row_committee = 1;
        var committeeIsSingle = true;

            $('#btn_add_committee').click(function() {
                count_row_committee++;
            });

            fetchInputFieldCommittee();

            // add new input for ajk
            $('#btn_add_ajk').on('click',function(){
                count_row_ajk++;

                count_row_each_ajk.push(1);

                var clone = $("#ajk_1").clone().insertBefore("#ajk-line");

                clone.attr("id","ajk_"+count_row_ajk);

                clone.find("#committee_position_1").val("");
                clone.find("#committee_name_1").val("");
                clone.find("#committee_position_1").attr("id","committee_position_"+count_row_ajk);
                clone.find("#committee_name_1").attr("id","committee_name_"+count_row_ajk);

                clone.find("#add_ajk_name_1").attr("id","add_ajk_name_"+count_row_ajk);
                clone.find("#add_ajk_name_"+count_row_ajk).attr("onclick","addNewAjkName('ajk_"+count_row_ajk+"')");
                clone.find("#add_ajk_name_"+count_row_ajk).attr("disabled", false);

                // clone.finc("#add_ajk_name_"+count_row_ajk).attr("onclick","addInputField('ajk_name_"+count_row_ajk+"')");

                clone.find("#ajk-name-line-1").attr("id","ajk-name-line-"+count_row_ajk);

                clone.find("#btn_remove_ajk_1").attr("id","btn_remove_ajk_"+count_row_ajk);
                // clone.find("#btn_remove_ajk_name_1").attr("id","btn_remove_ajk_name_"+count_row_ajk);

                clone.find("#btn_remove_ajk_"+count_row_ajk).attr("onclick","removeInputField('ajk_"+count_row_ajk+"')");
                clone.find("#btn_remove_ajk_"+count_row_ajk).attr("disabled",false);
            });
    });

    function addNewAjkName(id) {
        // format text is ajk_X, get X from id
        var ajk_id = id.split("_")[1];
        // console.log(ajk_id);

        count_row_each_ajk[ajk_id-1]++;
        // var new_id = "ajk_" + ajk_id +  (parseInt(ajk_id) + 1);";
        var new_id = "ajk_" + ajk_id + "_" + "new";
        var html = `<div class="row mt-2" id="`+ new_id + `">
                        <div class="col-5">
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="committee_name_1_2" name="committee_name[]" value=""/>
                        </div>
                        <button type="button" class="btn btn-outline-danger col-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Padam Nama" onclick="removeInputField('`+new_id+`')">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>`;
        // console.log(html);

        // select #ajk-name-line-1, insertBefore html
        $('#ajk-name-line-' + ajk_id).before(html);
    }

    function fetchInputFieldCommittee() {
        var ajk = '<?php echo $paperworkDetails->programCommittee; ?>';

        if (ajk != null && ajk != "") {
            var ajkJson = JSON.parse(ajk);

            count_row_ajk = 0;

            for (var i = 0; i < ajkJson.length; i++) {

                for (var key in ajkJson[i]) {
                    count_row_ajk++;

                    count_row_each_ajk.push(1);

                    var clone = $("#ajk_1").clone().insertBefore("#ajk-line");

                    clone.attr("id","ajk_"+count_row_ajk);

                    clone.find("#committee_position_1").val("");
                    clone.find("#committee_name_1").val("");
                    clone.find("#committee_position_1").attr("id","committee_position_"+count_row_ajk);
                    clone.find("#committee_name_1").attr("id","committee_name_"+count_row_ajk);

                    $("#committee_position_"+count_row_ajk).val(key);

                    clone.find("#add_ajk_name_1").attr("id","add_ajk_name_"+count_row_ajk);
                    clone.find("#add_ajk_name_"+count_row_ajk).attr("onclick","addNewAjkName('ajk_"+count_row_ajk+"')");
                    clone.find("#add_ajk_name_"+count_row_ajk).attr("disabled", false);

                    clone.find("#btn_remove_ajk_1").attr("id","btn_remove_ajk_"+count_row_ajk);
                    clone.find("#ajk-name-line-1").attr("id","ajk-name-line-"+count_row_ajk);

                    clone.find("#btn_remove_ajk_"+count_row_ajk).attr("onclick","removeInputField('ajk_"+count_row_ajk+"')");
                    clone.find("#btn_remove_ajk_"+count_row_ajk).attr("disabled",false);

                    // delete the last row of #ajk_1
                    if (count_row_ajk == 1) {
                        $("#ajk_1").remove();
                        clone.find("#add_ajk_name_"+count_row_ajk).attr("disabled", true);
                        clone.find("#btn_remove_ajk_"+count_row_ajk).attr("disabled",true);

                        count_row_each_ajk[0] = 0;
                    }

                    $("#committee_position_"+count_row_ajk).val(key);

                    // add new ajk name
                    if (Array.isArray(ajkJson[i][key])) {
                        count_row_each_ajk[count_row_ajk] = 0;
                        for (var j = 0; j < ajkJson[i][key].length; j++) {
                            count_row_each_ajk[count_row_ajk]++;

                            if ( j == 0 ) {
                                $("#committee_name_"+count_row_ajk).val(ajkJson[i][key][j]);
                            }

                            else {
                                var new_id = "ajk_" + count_row_ajk + "_" + "new";
                                var html = `<div class="row mt-2" id="`+ new_id + `">
                                                <div class="col-5">
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" class="form-control" id="committee_name_1_2" name="committee_name[]" value="`+ ajkJson[i][key][j] +`"/>
                                                </div>
                                                <button type="button" class="btn btn-outline-danger col-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Padam Nama" onclick="removeInputField('`+new_id+`')">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>`;
    
                                // select #ajk-name-line-1, insertBefore html
                                $('#ajk-name-line-' + count_row_ajk).before(html);
                            }
                        }
                    } else {
                        $("#committee_name_"+count_row_ajk).val(ajkJson[i][key]);
                        count_row_each_ajk[count_row_ajk] = 1;
                    }

                }
            }
        }
    }

    // Signature
    $(document).ready(function() {
        fetchInputFieldSignature();
    });

    function fetchInputFieldSignature() {
        var signature = '<?php echo $paperworkDetails->signature ?>';

        if (signature != null && signature != "") {
            var signatureJson = JSON.parse(signature);

            $('#program-signature-preparedBy-0').val(signatureJson.writer_name);
            $('#program-signature-preparedBy-1').val(signatureJson.writer_position);
            $('#program-signature-preparedBy-2').val(signatureJson.writer_phone);
            $('#program-signature-preparedBy-3').val(signatureJson.writer_email);

            $('#program-signature-preparedBy-4').val(signatureJson.president_name);
            $('#program-signature-preparedBy-5').val(signatureJson.president_position);
            $('#program-signature-preparedBy-6').val(signatureJson.president_phone);
            $('#program-signature-preparedBy-7').val(signatureJson.president_email);
        }
    }

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

        if (field_id.includes("implication" && "col")) {

            // text format is implication_X_Y_col_Z, get value of X, Y and Z
            var split = field_id.split("_");
            var x = split[1];
            var y = split[2]; // y is the row number
            var col = split[4];

            console.log("field_id from i + col: " + field_id);

            console.log("x: " + x + ", y: " + y + ", col: " + col);

            if (y != 1) {
                $("#implication_" + x + "_" + y + "_col_1").remove();
                $("#implication_" + x + "_" + y + "_col_2").remove();
                $("#implication_" + x + "_" + y + "_col_3").remove();
            }
        }

        if (field_id.includes("implication") && !field_id.includes("col")) {

            console.log("field_id: " + field_id);

            var latest_count = 0;

            // update tr all with an id #implication_X, exclude the first row and ignore it from the loop (i = 1)
            var trs = $('#implicationTable tr');
            console.log("trs.length: " + trs.length);
            for (var i = 0; i < trs.length; i++) {
                var tr = trs[i];
                var id = tr.id;
                if (id.includes("implication")) {
                    latest_count++;
                }
            }
        }

        if (field_id.includes("ajk")) {
            var split = field_id.split("_");
            var x = split[1];

            count_row_each_ajk[x-1] = 0;
        }

        if (field_id.includes("ajk" && "new")) {
            // text format is ajk_X_new, get X

            var split = field_id.split("_");
            var x = split[1];

            count_row_each_ajk[x-1]++;
            console.log(count_row_each_ajk);
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

            var paperworkTentative = '<?php echo $paperworkDetails->tentative; ?>';
            // get duration object from $paperworkDetails->tentativeFirebaseId
            if (paperworkTentative == null || paperworkTentative == "") {
                count_tentatives = 0;
            } else {
                var tentativeJson = JSON.parse(paperworkTentative);

                updateTimeAndItemsValue();

                    // create input field for time and item and append to #tentative-inputs
                for (var j = 0; j < tentativeJson.timeAndItem.length; j++) {

                    timeAndItems[i]++;
                    updateTimeAndItemsValue();

                    var timeItem = tentativeJson.timeAndItem[j];

                    var keys = Object.keys(tentativeJson.timeAndItem[j]);
                    for (var key in timeItem) {
                        fetchInputFieldTentativesOneDay(j, key, timeItem[key]);
                    }

                    // console.log(timeAndItems);
                }

                updateTimeAndItemsValue();

                $("#tentatives_day_" + 0 + "_0").remove();
            }

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

            var paperworkTentative = '<?php echo $paperworkDetails->tentative; ?>';
            // get duration object from $paperworkDetails->tentativeFirebaseId
            if (paperworkTentative === 'null') {
                count_tentatives = 0;
            } else {
                var tentativeJson = JSON.parse('<?= $paperworkDetails->tentative ?>');
                // set 0s to timeAndItems array
                for (var i = 0; i < duration; i++) {
                    timeAndItems[i] = 0;
                }

                updateTimeAndItemsValue();

                for (var i = 0; i < tentativeJson.duration; i++) {
                    // count_tentatives[i] = tentativeJson.timeAndItem[i].length - 1;
                    count_tentatives[i] = 0;
                    
                    // create input field for time and item and append to #tentative-inputs
                    for (var j = 0; j < tentativeJson.timeAndItem[i].length; j++) {

                        timeAndItems[i]++;
                        updateTimeAndItemsValue();

                        var timeItem = tentativeJson.timeAndItem[i][j];

                        var keys = Object.keys(tentativeJson.timeAndItem[i][j]);
                        for (var key in timeItem) {
                            fetchInputFieldTentatives(i, j, key, timeItem[key]);
                        }
                    }

                    updateTimeAndItemsValue();

                    $("#tentatives_day_" + i + "_0").remove();
                }
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

        $("#timepicker").timepicker();

        timeAndItems[i]++;
        updateTimeAndItemsValue();
    }

    function fetchInputFieldTentativesOneDay(j, key, value) {
        var clone = $("#tentatives_day_" + 0 + "_0").clone().insertBefore("#tentatives-line-" + 0);
        
        clone.attr("id","tentatives_day_" + 0 + "_" + j);

        // change name and id of input timepicker
        clone.find("#timepicker").attr("name","tentatives_time[]");

        // clear value of input timepicker
        clone.find("#timepicker").timepicker();
        clone.find("#timepicker").val(key);

        // change name and id of input tentatives
        clone.find("#tentatives-day-" + 0 + "-0").attr("name","tentatives_item[]");
        clone.find("#tentatives-day-" + 0 + "-0").attr("id","tentatives-day-" + 0 + "-" + j);

        // clear value of input tentatives
        clone.find("#tentatives-day-" + 0 + "-" + j).val(value);

        // change id of button
        clone.find("button").attr("onclick","removeInputField('tentatives_day_" + 0 + "_" + j + "')");
        clone.find("button").attr("id","btn_remove_tentative_" + 0 + "_"+j);

        // $("#timepicker").timepicker();

        if (j != 0) {
            // enable remove button
            clone.find("button").attr("disabled",false);

        }
    }

    function fetchInputFieldTentatives(i, j, key, value) {
        var clone = $("#tentatives_day_" + i + "_0").clone().insertBefore("#tentatives-line-" + i);
        
        clone.attr("id","tentatives_day_" + i + "_" + j);

        // change name and id of input timepicker
        clone.find("#timepicker").attr("name","tentatives_time[]");

        // clear value of input timepicker
        clone.find("#timepicker").timepicker();
        clone.find("#timepicker").val(key);

        // change name and id of input tentatives
        clone.find("#tentatives-day-" + i + "-0").attr("name","tentatives_item[]");
        clone.find("#tentatives-day-" + i + "-0").attr("id","tentatives-day-" + i + "-" + j);

        // clear value of input tentatives
        clone.find("#tentatives-day-" + i + "-" + j).val(value);

        // change id of button
        clone.find("button").attr("onclick","removeInputField('tentatives_day_" + i + "_" + j + "')");
        clone.find("button").attr("id","btn_remove_tentative_" + i + "_"+j);

        // $("#timepicker").timepicker();

        if (j != 0) {
            // enable remove button
            clone.find("button").attr("disabled",false);

        }
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
            // $("#tentative").hide();
            if ( {{ isset($paperworkDetails->tentatives) != null ? 'true' : 'false' }}) {
                // <?php if (isset($paperworkDetails->tentatives)) { ?>
                //     $("#tentative").show();
                // <?php } else { ?>
                //     $("#tentative").hide();
                // <?php } ?>
            createInputFieldTentative();
            }
        } else {
            if ( {{ isset($paperworkDetails->tentatives) != null ? 'true' : 'false' }}) {
            createInputFieldTentative();
            }
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
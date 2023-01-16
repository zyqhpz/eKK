<title>eKK PDF Generator</title>

<style>
    #SelectValue {
        width: auto;
        height: auto;
        position: absolute;
        top: -35px;
        text-align: center;
        line-height: 45px;
        background: #000;
        border-radius: 4px;
    }

    #SelectValue::after {
        content: '',
        position: absolute;
        bottom: 14px;
        left: 0;
    }

    #selector {
        height: 100px;
        width: 50px;
        position: absolute;
        bottom: -20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 2;
    }

    #SelectBtn {
        height: 40px;
        width: 40px;
        position: absolute;
        border-radius: 50%;
        bottom: 0;
    }

    #statusRange {
        width: 100%;
        height: 40px;
        outline: none;
        border-radius: 3px;
    }

</style>

<div>
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</div>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="#">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#">Kelab</a></li>
                <li class="breadcrumb-item" aria-current="page">Kertas Kerja</li>
                <li class="breadcrumb-item active" aria-current="page">Status</li>
            </ol>
        </nav>
        <h2 class="h4">Status Kertas Kerja</h2>
        <p class="mb-0">Halaman ini menunjukkan butiran kertas kerja yang telah dipilih.</p>
    </div>
    <?php
    if (session('updated')) {
        echo '<div class="alert alert-success" role="alert" fade show>' . session('updated') . '</div>';
    }

    if (session('submitted')) {
        echo '<div class="alert alert-success" role="alert" fade show>' . session('submitted') . '</div>';
    }

    if (session('output')) {
        echo '<div class="alert alert-danger" role="alert" fade show>RM ' . session('output') . '</div>';
    }

    if (session('rejected')) {
        echo '<div class="alert alert-danger" role="alert" fade show>' . session('rejected') . '</div>';
    }
    ?>
    <div class="alert alert-success" role="alert" id="response-submitted" fade show hidden>Kertas kerja berjaya dihantar</div>
</div>
<div class="card card-body shadow border-0 table-wrapper table-responsive">
    <div class="d-flex mb-2 gap-2"><span>Nama Kertas Kerja: </span><p>{{ $paperwork->name }}</p></div>
    <div class="d-flex mb-2 gap-2"><span>Nama Kelab: </span><p>{{ $club->name }}</p></div>

    <div class="progress-wrapper">

        <div class="progress-info">
            <div class="progress-label">
                Status: 
                @if ($paperwork->status == 2)
                    <span class="text-success">Lulus</span>
                @elseif($paperwork->status == 1)
                    <span class="text-warning">Dalam proses</span>
                @else
                    <span class="text-danger">Draf</span>
                @endif
            </div>
        </div>

        <div class="progress">
            @if ($paperwork->progressStates != null && $paperwork->status != null && $paperwork->status != 0)
                @if (count($paperwork->progressStates) == 4)
                    @if ($paperwork->currentProgressState == 4)
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100"></div>
                    @elseif($paperwork->currentProgressState == 1)
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 35%;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                    @elseif ($paperwork->currentProgressState == 2)
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 61%;" aria-valuenow="61" aria-valuemin="0" aria-valuemax="100"></div>
                    @elseif($paperwork->currentProgressState == 3 && $paperwork->status == 2)
                        <div class="progress-bar bg-success" role="progressbar" style="width: 99%;" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100"></div>
                    @elseif($paperwork->currentProgressState == 3)
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 93%;" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100"></div>
                    @else
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    @endif
                @else
                    @if ($paperwork->currentProgressState == 5)
                        <div class="progress-bar bg-success" role="progressbar" style="width: 95%;" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                    @elseif($paperwork->currentProgressState == 1)
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                    @elseif ($paperwork->currentProgressState == 2)
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 45%;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                    @elseif ($paperwork->currentProgressState == 3)
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                    @elseif ($paperwork->currentProgressState == 4 && $paperwork->status == 2)
                        <div class="progress-bar bg-success" role="progressbar" style="width: 99%;" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100"></div>
                    @elseif ($paperwork->currentProgressState == 4)
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 95%;" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                    @else
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 25%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                    @endif
                @endif
            @else
                <div class="progress-bar bg-danger" role="progressbar" style="width: 25%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
            @endif
        </div>

        @if ($paperwork->status > 0)
            <div>
                {{-- <label for="statusRange" class="form-label">Status</label> --}}
                <input type="range" class="form-range" min="0" max="100" step="1" id="statusRange" hidden>
                <div id="selector">
                    <div id="SelectBtn"></div>
                    <div id="SelectValue" class="text-white w-auto px-2 text-nowrap"></div>
                </div>
            </div>
            <div class="progress-states">
                {{-- <div class="d-flex flex-row w-full text-center mx-auto justify-content-center"> --}}
                <div class="d-flex flex-row w-full text-center mx-auto justify-content-between px-5 py-3">
                    @foreach ($paperwork->progressStates as $text)
                        <div class="p-2 text-center">{{ $text }}</div>
                    @endforeach
                </div>
        </div>
        @endif
    </div>

    <div>
        {{-- <button class="btn btn-primary" href="/paperworks/{{ $paperwork->filePath }}" type="button">Lihat Kertas Kerja</button> --}}
        @if($paperwork->status == 0)
        <?php if ($paperwork->isGenerated) { ?>
            <a class="btn btn-outline-secondary" href="{{ route('paperwork-generator', $paperwork->id) }}" type="button">Sunting di penjana</a>
            <?php } else { ?>
            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-editPaperwork" class="btn btn-outline-secondary">Sunting</button>
            <?php } ?>
            <button class="btn btn-success text-white" id="btn-submit" type="button" data-bs-toggle="modal" data-bs-target="#modal-submitPaperwork" >Hantar</button>
        @endif
            
        <?php if ($paperwork->isGenerated) { ?>
        <a class="btn btn-primary" href="{{ route('paperwork-generator.viewPDF', $paperwork->id) }}" target="_blank" type="button">Lihat PDF</a>
        <?php } else { ?>
        <a class="btn btn-primary" href="{{ route('paperworkViewPDF', $paperwork->id ) }}" target="_blank" type="button">Lihat PDF</a>
        <?php } ?>

        {{-- <a class="btn btn-secondary" id="btn-viewImplication" href="{{ route('paperworkFinanceDetails', $paperwork->id ) }}" type="button">Lihat Implikasi Kewangan</a> --}}

        @if ($paperwork->currentProgressState == 2 && auth()->user()->role == 0)
            <a class="btn btn-secondary" id="btn-updatePaperworkStatus" href="" data-bs-toggle="modal" data-bs-target="#modal-updatePaperworkStatus" type="button">Kemaskini Status</a>
        @endif

        @if ($paperwork->currentProgressState == 1 && auth()->user()->role == 2)
            <a class="btn btn-secondary" id="btn-updatePaperworkStatus" href="" data-bs-toggle="modal" data-bs-target="#modal-updatePaperworkStatus" type="button">Kemaskini Status</a>
        @endif

        @if ($paperwork->currentProgressState == 2 && auth()->user()->role == 3)
            <a class="btn btn-secondary" id="btn-updatePaperworkStatus" href="" data-bs-toggle="modal" data-bs-target="#modal-updatePaperworkStatus" type="button">Kemaskini Status</a>
        @endif

        @if ($paperwork->currentProgressState == 3 && auth()->user()->role == 4)
            <a class="btn btn-secondary" id="btn-updatePaperworkStatus" href="" data-bs-toggle="modal" data-bs-target="#modal-updatePaperworkStatus" type="button">Kemaskini Status</a>
        @endif

        @if ($paperwork->currentProgressState == 4 && auth()->user()->role == 5)
            <a class="btn btn-secondary" id="btn-updatePaperworkStatus" href="" data-bs-toggle="modal" data-bs-target="#modal-updatePaperworkStatus" type="button">Kemaskini Status</a>
        @endif
    </div>
</div>

<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
    }, 4000);

    var slider = document.getElementById("statusRange");
    var selector = document.getElementById("selector");
    var SelectValue = document.getElementById("SelectValue");

    $(document).ready(function() {

        if ({{ $paperwork->status }} > 0) {

            var states = '<?php echo json_encode($paperwork->progressStates); ?>';

            if (states != null && states  != '') {

                var statesJson = JSON.parse(states);
                
                if (statesJson.length  == 4 ) {
                    var progression = ["Draf", "Penasihat Kelab", "HEPA", "TNC (HEPA)", "Lulus"];
                    var progressionBarValue = [35, 61, 93, 99];
                } else {
                    var progression = ["Draf", "Penasihat Kelab", "HEPA", "TNC (HEPA)", "NC", "Lulus"];
                    var progressionBarValue = [30, 55, 70, 95, 96];
                }

                $('#statusRange').val(progressionBarValue[{{ $paperwork->currentProgressState }} - 1]);

                if ({{ $paperwork->status }} == 2) {
                    SelectValue.innerHTML = "Lulus";
                    $('#statusRange').val(97);
                } else {
                    SelectValue.innerHTML = progression[{{ $paperwork->currentProgressState }} - 1];
                }

                if ( ({{ $paperwork->currentProgressState }} == 1) || ({{ $paperwork->currentProgressState }} == 2) || ({{ $paperwork->status }} == 3) ) {
                    $('#SelectValue').addClass("bg-warning");
                } else if ( {{ $paperwork->currentProgressState }} == 4) {
                    $('#SelectValue').addClass("bg-success");
                } else {
                    $('#SelectValue').addClass("bg-danger");
                }

            } else {
                // SelectValue.innerHTML = "Belum Dihantar";
            }

            updateSliderValue();
        }

    });

    function updateSliderValue() {
        // SelectValue.innerHTML = slider.value;
        selector.style.left = slider.value + "%";

        // disable slider
        slider.disabled = true;
    }

    slider.oninput = function() {
        updateSliderValue();
        console.log(slider.value);
    }

    $('#btn-viewImplication').on('click',function(){
        console.log("clicked");
        $.ajax({
            type: "GET",
            url: "{{ route('paperworkFinanceDetails', $paperwork->id) }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){
                // console.log(response);
                // $('#response-submitted').html(response);
                $('#response-submitted').attr('hidden', false);
                $('#response-submitted').val(response);
            }
        });
    });
    
    // $('#btn-submit').on('click',function(){
    //     console.log("clicked");
    //     $.ajax({
    //         type: "POST",
    //         url: "{{ route('paperwork.submit', $paperwork->id) }}",
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         success: function(response){
    //             console.log(response);
    //         }
    //     });
    // });
</script>

{{-- modal to submit paperwork--}}
<div class="modal fade" id="modal-submitPaperwork" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('paperwork.submit', $paperwork->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h2 class="h6 modal-title">Hantar Kertas Kerja</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-bold">Adakah anda pasti untuk menghantar kertas kerja ini?</h5>
                    <p class="text-danger">Kertas kerja ini tidak boleh di sunting selepas dihantar.</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary">Hantar</button>
                    <button type="button" class="btn btn-link text-gray ms-auto" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- modal to edit paperwork --}}
<div class="modal fade" id="modal-editPaperwork" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            {{-- create a form to add a new paperwork with attributes: name, method to upload paperwork --}}
            <form action="{{ route('paperwork.update', $paperwork->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h2 class="h6 modal-title">Sunting Kertas Kerja</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label class="form-label required">Nama Kertas Kerja</label>
                        <input type="text" class="form-control" name="paperwork_name" placeholder="Nama Kertas Kerja" value="{{ $paperwork->name }}" autocomplete="off" required>
                    </div>
                    
                    {{-- an input field for upload paperwork when paperworkUpload is checked --}}
                    <div class="form-group mb-3" id="paperworkFileUpload">
                        <hr>
                        <label class="form-label required">Muat naik fail</label>
                        <input type="file" class="form-control" name="paperwork_file" required>

                        <div class="form-text">Muat naik fail dalam format PDF sahaja.</div>
                    </div>
                            
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary">Tambah</button>
                    <button type="button" class="btn btn-link text-gray ms-auto" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- modal to update paperwork status --}}
<div class="modal fade" id="modal-updatePaperworkStatus" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            <form action="{{ route('paperwork.updatePaperworkStatus', $paperwork->id )}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h2 class="h6 modal-title">Kemaskini Status Kertas Kerja</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-bold">Adakah anda ingin meluluskan kertas kerja ini?</h5>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-info" name="paperwork_updateStatus" value="Lulus">
                    <input type="submit" class="btn btn-outline-danger" name="paperwork_updateStatus" value="Tolak">
                    <button type="button" class="btn btn-link text-gray ms-auto" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
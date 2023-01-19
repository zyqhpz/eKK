<title>Volt Laravel Dashboard - User management</title>
<head>

    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://kit.fontawesome.com/36f73a74bd.js" crossorigin="anonymous"></script>
</head>
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
                <li class="breadcrumb-item active" aria-current="page">Kertas Kerja</li>
            </ol>
        </nav>
        <h2 class="h4">Senarai Kertas Kerja</h2>
        <p class="mb-0">Halaman ini menunjukkan senarai kertas kerja yang telah dibuat.</p>
    </div>
    @if (auth()->user()->role == 1)
    <div class="btn-toolbar mb-2 mb-md-0">
        <button type="button" data-bs-toggle="modal" data-bs-target="#modal-addNewPaperwork" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
            <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                </path>
            </svg>
            Tambah Kerja Kerja
        </button>
    </div>
    @endif
</div>
<div class="row mb-4">
    @if (auth()->user()->role == 1)

    <?php
        $count_inProgress = 0;
        $count_approved = 0;

        foreach ($paperworks as $paperwork) {
            if ($paperwork->status == 1) {
                $count_inProgress++;
            } else if ($paperwork->status == 2) {
                $count_approved++;
            }
        }
    
    ?>
    <div class="col-3 col-lg-4">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon-shape icon-shape-tertiary rounded me-4 me-sm-0">
                            <i class="far fa-newspaper text-white "></i>
                        </div>
                    </div>
                    <div class="col-12 col-xl-7 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h6 mb-0">Jumlah Kertas Kerja</h2>
                            <span class="text-gray-400">Ditulis</span>
                            <h3 class="fw-extrabold mb-2">@if ($paperworks != null && $paperworks != '') {{ count($paperworks) }} @else <span>0</span> @endif</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3 col-lg-4">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon-shape icon-shape-tertiary rounded me-4 me-sm-0">
                            <i class="far fa-newspaper text-white "></i>
                        </div>
                    </div>
                    <div class="col-12 col-xl-7 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h6 mb-0">Jumlah Kertas Kerja</h2>
                            <span class="text-warning">Dalam proses</span>
                            <h3 class="fw-extrabold mb-2">@if ($paperworks != null && $paperworks != '') {{ $count_inProgress }} @else <span>0</span> @endif</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3 col-lg-4">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon-shape icon-shape-tertiary rounded me-4 me-sm-0">
                            <i class="far fa-newspaper text-white "></i>
                        </div>
                    </div>
                    <div class="col-12 col-xl-7 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h6 mb-0">Jumlah Kertas Kerja</h2>
                            <span class="text-success">Diluluskan</span>
                            <h3 class="fw-extrabold mb-2">@if ($paperworks != null && $paperworks != '') {{ $count_approved }} @else <span>0</span> @endif</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @elseif (auth()->user()->role != 0)
    <div class="col-3 col-lg-4">
        <div class="card border-0 shadow">
            <div class="card-body">
                <i class="fa-regular fa-circle-check"></i>
                <div class="row d-block d-xl-flex align-items-center">
                    <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon-shape icon-shape-tertiary rounded me-4 me-sm-0">
                            <i class="far fa-newspaper text-white "></i>
                        </div>            
                    </div>
                    <div class="col-12 col-xl-7 px-xl-0">
                        <div class="d-none d-sm-block">
                            @if (auth()->user()->role == 1)
                            <h2 class="h6 mb-0">Jumlah Kertas Kerja Diluluskan</h2>
                            <?php 
                                $status_2_count = 0;
                                foreach ($paperworks as $paperwork) {
                                    if ($paperwork->status == 2) {
                                        $status_2_count++;
                                    }
                                }
                            ?>
                            <h3 class="fw-extrabold mb-2">@if ($paperworks != null && $paperworks != '') {{ $status_2_count }} @else <span>0</span> @endif</h3>
                            @else
                            <h2 class="h6 mb-0">Jumlah Kertas Kerja</h2>
                            <span class="text-warning">Perlu diluluskan</span>
                            <?php 
                                $approved_count = 0;
                                foreach ($paperworks as $paperwork) {
                                    if ($paperwork->status == 1 && ($paperwork->currentProgressState == (auth()->user()->role - 1))) {
                                        $approved_count++;
                                    }
                                }
                            ?>
                            <h3 class="fw-extrabold mb-2">@if ($paperworks != null && $paperworks != '') {{ $approved_count }} @else <span>0</span> @endif</h3>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
<div class="table-settings mb-4">
    <div class="row justify-content-between align-items-center">
        <div class="col-9 col-lg-8 d-md-flex">
            <div class="input-group me-2 me-lg-3 fmxw-300">
                <span class="input-group-text">
                    <svg class="icon icon-xs" x-description="Heroicon name: solid/search"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </span>
                <input type="text" class="form-control"id="paperwork-search" placeholder="Cari kertas kerja">
            </div>
            <select class="form-select fmxw-200 d-none d-md-inline" id="paperwork-filter-status" aria-label="Message select example 2">
                <option selected value="Semua">Semua</option>
                <option value="Draf">Draf</option>
                <option value="Dalam proses">Dalam proses</option>
                <option value="Lulus">Lulus</option>
            </select>
        </div>
        <div class="col-3 col-lg-4 d-flex justify-content-end">
            <?php
            if (session('created')) {
                echo '<div class="alert alert-success" role="alert" fade show>' . session('created') . '</div>';
            }

            if (session('deleted')) {
                echo '<div class="alert alert-danger" role="alert" fade show>' . session('deleted') . '</div>';
            }
            ?>
        </div>
    </div>
</div>
<div class="card card-body shadow border-0 table-wrapper table-responsive min-vh-100">
    <table class="table user-table table-hover align-items-center">
        <thead>
            <tr>
                <th class="border-bottom">No.</th>
                <th class="border-bottom name">Nama Program</th>
                <th class="border-bottom">Tarikh Terakhir Disunting</th>
                <th class="border-bottom">Tarikh Program</th>
                <th class="border-bottom">Status</th>
                <th class="border-bottom"></th>
            </tr>
        </thead>
        <tbody>
            {{-- foreach $paperworks --}}
            <?php $numbering = 1; ?>
            @foreach ($paperworks as $paperwork)
                <?php
                    // format date to DD/MM/YYYY format and in Malaysia timezone (UTC+8)
                    $date = $paperwork->updated_at;
                    $formatted_date = $date->timezone('Asia/Kuala_Lumpur')->format('d/m/Y');

                    $formatted_programDateStartEnd = '-';

                    if ($paperwork->isOneDay == 0) {
                        $programDateStart = $paperwork->programDateStart;
                        $programDateEnd = $paperwork->programDateEnd;

                        if (isset($programDateStart) && isset($programDateEnd)) {
                        // format YYYY/MM/DD it to DD MONTH YYYY format and in Malaysia timezone (UTC+8)

                        $startDate = new DateTime($programDateStart, new DateTimeZone('UTC'));
                        $endDate = new DateTime($programDateEnd, new DateTimeZone('UTC'));

                        $startDate->setTimezone(new DateTimeZone('Asia/Kuala_Lumpur'));
                        $endDate->setTimezone(new DateTimeZone('Asia/Kuala_Lumpur'));

                        $interval = DateInterval::createFromDateString('1 day');
                        $period = new DatePeriod($startDate, $interval, $endDate);

                        $formatter = new IntlDateFormatter('ms_MY', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                        $formatter->setPattern("d");

                        $dateString = $formatter->format($startDate);
                        $dateString .= " - ";
                        $dateString .= $formatter->format($endDate);
                        $dateString .= " ";
                        $formatter->setPattern("MMMM y");
                        $dateString .= $formatter->format($startDate);
                        $formatted_programDateStartEnd = $dateString;

                        } else {
                            $formatted_programDateStartEnd = '-';
                        }
                    } else {

                        $programDate = $paperwork->programDate;

                        if (isset($programDate)) {
                        // format YYYY/MM/DD it to DD MONTH YYYY format and in Malaysia timezone (UTC+8)

                            $programDate = new DateTime($programDate, new DateTimeZone('UTC'));

                            $programDate->setTimezone(new DateTimeZone('Asia/Kuala_Lumpur'));

                            $formatter = new IntlDateFormatter('ms_MY', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                            $formatter->setPattern("d MMMM y");

                            $dateString = $formatter->format($programDate);
                            $formatted_programDateStartEnd = $dateString;

                        } else {
                            $formatted_programDateStartEnd = '-';
                        }
                    }
                ?>
                <tr>
                    <td><span class="fw-normal">{{ $numbering }}.</span></td>
                    <td><span class="fw-normal">{{ $paperwork->name }} @if ($paperwork->status == 1 && $paperwork->currentProgressState == (auth()->user()->role - 1))<span class="badge badge-sm bg-danger badge-pill notification-count ms-3">Baru</span>@endif</span></td>
                    <td><span class="fw-normal">{{ $formatted_date }}</span></td>
                    <td><span class="fw-normal d-flex align-items-center">{{ $formatted_programDateStartEnd }}</span></td>
                    <?php if($paperwork->status == 0) { ?>
                        <td><span class="fw-normal text-danger">Draf</span></td>
                    <?php } else if($paperwork->status == 1) { ?>
                        <td><span class="fw-normal text-warning">Dalam proses</span></td>
                    <?php } else if($paperwork->status == 2) { ?>
                        <td><span class="fw-normal text-success">Lulus</span></td>
                    <?php } ?>
                    <td>
                        <div class="btn-group .z-index-master">
                            @if (auth()->user()->id == $paperwork->clubId)
                            <a href="{{ route('paperwork-club-status', $paperwork->id) }}" type="button" class="btn btn-info" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Lihat kertas kerja">Butiran</a>
                            <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu">
                                @if ($paperwork->status == 0)
                                <li class="dropdown-item bg-danger text-white"><a id="btn-deletePaperwork" data-id="{{ $paperwork->id }}" data-name="{{ $paperwork->name }}" data-bs-toggle="modal" data-bs-target="#modal-deletePaperwork">Padam</a></li>
                                @endif
                            </ul>
                            @else
                            <a href="{{ route('paperwork-club-status', $paperwork->id) }}"  class="btn btn-info" type="button" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Lihat kertas kerja">Butiran</a>
                            @endif
                        </div>
                    </td>
                </tr>
                <?php $numbering++; ?>
            @endforeach
        </tbody>
    </table>
    {{-- <div id="jumlah-paperwork">
        <p class="text-muted">Jumlah kertas kerja: {{ $paperworks->count() }}</p>
    </div> --}}
</div>

{{-- modal to add new paperwork --}}
<div class="modal fade" id="modal-addNewPaperwork" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            {{-- create a form to add a new paperwork with attributes: name, method to upload paperwork --}}
            <form action="{{ route('paperwork.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h2 class="h6 modal-title">Tambah Kertas Kerja</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label class="form-label required">Nama Kertas Kerja</label>
                        <input type="text" class="form-control" name="paperwork_name" placeholder="Nama Kertas Kerja" autocomplete="off" required>
                    </div>
                    {{-- add radio button to upload paperwork or using generator --}}
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paperwork_isGenerated" id="paperworkUpload" value="0" checked>
                        <label class="form-check-label" for="paperworkUpload">
                            Muat naik kertas kerja
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paperwork_isGenerated" id="paperworkGenerator" value="1">
                        <label class="form-check-label" for="paperworkGenerator">
                            Jana kertas kerja
                        </label>
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
                    <button type="button" class="btn btn-link text-gray ms-auto" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- modal confirmation to delete paperwork --}}
<div class="modal fade" id="modal-deletePaperwork" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="h6 modal-title">Padam Kertas Kerja</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-0">
                <div id="paperwork-deleted-name"></div>
                <p>Adakah anda pasti untuk memadam kertas kerja ini?</p>
            </div>
            <div class="modal-footer">
                <form action="" id="delete-paperwork" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Padam</button>
                </form>
                <button type="button" class="btn btn-link text-gray ms-auto" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- javascript for modal add new paperwork --}}
<script>
    // Javascript for modal add new paperwork
    // show and hide paperworkFileUpload when radio button paperworkUpload is checked
    $(document).ready(function() {
        $('#paperworkUpload').click(function() {
            $('#paperworkFileUpload').show();
            // add required attribute to paperwork-file
            $('input[name="paperwork_file"]').attr('required', true);
        });
        $('#paperworkGenerator').click(function() {
            $('#paperworkFileUpload').hide();
            // remove required attribute to paperwork-file
            $('input[name="paperwork_file"]').removeAttr('required');
        });

        $('#modal-deletePaperwork').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes
            var name = button.data('name') // Extract info from data-* attributes

            $("#paperwork-deleted-name").text(name);

            // change the action attribute of form to delete the paperwork
            $('#delete-paperwork').attr('action', '/paperwork/delete/' + id);
        });
    });

    $(document).ready(function() {
        $("#paperwork-search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("table tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $("#paperwork-filter-status").on("change", function() {
            var selected = $(this).val();
            $("table tbody tr").hide();
            if (selected === "Semua") {
                $("table tbody tr").show();
            } else {
                $("table tbody tr td:nth-child(5)").filter(function() {
                    return $(this).text() === selected;
                }).parent().show();
            }
        });
    });

    // set timeout for alert message
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
    }, 4000);




</script>
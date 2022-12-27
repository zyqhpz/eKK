<title>Volt Laravel Dashboard - User management</title>
<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
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
    <div class="btn-toolbar mb-2 mb-md-0">
        <button type="button" data-bs-toggle="modal" data-bs-target="#modal-addNewPaperwork" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
            <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                </path>
            </svg>
            Tambah Kerja Kerja
        </button>
        <div class="btn-group ms-2 ms-lg-3">
            <button type="button" class="btn btn-sm btn-outline-gray-600">Share</button>
            <button type="button" class="btn btn-sm btn-outline-gray-600">Export</button>
        </div>
    </div>
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
                <input type="text" class="form-control" placeholder="Cari kertas kerja">
            </div>
            <select class="form-select fmxw-200 d-none d-md-inline" aria-label="Message select example 2">
                <option selected>Semua</option>
                <option value="1">Lulus</option>
                <option value="2">Dalam proses</option>
                <option value="3">Draf</option>
            </select>
        </div>
        <div class="col-3 col-lg-4 d-flex justify-content-end">
            <div class="btn-group">
                <div class="dropdown me-1">
                    <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-1"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z">
                            </path>
                        </svg>
                        <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end pb-0">
                        <span class="small ps-3 fw-bold text-dark">Show</span>
                        <a class="dropdown-item d-flex align-items-center fw-bold" href="#">10 <svg
                                class="icon icon-xxs ms-auto" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg></a>
                        <a class="dropdown-item fw-bold" href="#">20</a>
                        <a class="dropdown-item fw-bold rounded-bottom" href="#">30</a>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-1"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end pb-0">
                        <span class="small ps-3 fw-bold text-dark">Show</span>
                        <a class="dropdown-item d-flex align-items-center fw-bold" href="#">10 <svg
                                class="icon icon-xxs ms-auto" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg></a>
                        <a class="dropdown-item fw-bold" href="#">20</a>
                        <a class="dropdown-item fw-bold rounded-bottom" href="#">30</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card card-body shadow border-0 table-wrapper table-responsive min-vh-100">
    <table class="table user-table table-hover align-items-center">
        <thead>
            <tr>
                <th class="border-bottom">No.</th>
                <th class="border-bottom">Nama Program</th>
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
                    // format date to display DD Month YYYY format and in Malaysia timezone (UTC+8) and Malay Language (ms)
                    // $date = $paperwork->updated_at;
                    // $formatted_date = $date->timezone('Asia/Kuala_Lumpur')->formatLocalized('%d %B %Y');

                    // format date to DD/MM/YYYY format and in Malaysia timezone (UTC+8)
                    $date = $paperwork->updated_at;
                    $formatted_date = $date->timezone('Asia/Kuala_Lumpur')->format('d/m/Y');
                ?>
                <tr>
                    <td><span class="fw-normal">{{ $numbering }}.</span></td>
                    <td><span class="fw-normal">{{ $paperwork->name }}</span></td>
                    <td><span class="fw-normal">{{ $formatted_date }}</span></td>
                    <td><span class="fw-normal d-flex align-items-center">-</span></td>
                    {{-- <td><span class="fw-normal text-success">Diluluskan</span></td> --}}
                    <td><span class="fw-normal text-danger">Draf</span></td>
                    <td>
                        <div class="btn-group">
                            {{-- route to paperwork-club-status --}}
                            <a href="{{ route('paperwork-club-status', $paperwork->id) }}" class="btn btn-sm btn-success" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Lihat kertas kerja">
                                <i class="fas fa-eye text-white"></i>
                            {{-- <a href="" class="btn btn-sm btn-success" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Lihat kertas kerja">
                                <i class="fas fa-eye text-white"></i>
                            </a> --}}
                            <a href="#" class="btn btn-sm btn-info" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Sunting kertas kerja">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Padam kertas kerja">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php $numbering++; ?>
            @endforeach
            <tr>
                <td><span class="fw-normal">1.</span></td>
                <td><span class="fw-normal">Program Biar Santai, Tapi Sampai</span></td>
                <td><span class="fw-normal">5 November 2022</span></td>
                <td><span class="fw-normal d-flex align-items-center">22 - 24 Disember 2022</span></td>
                <td><span class="fw-normal text-success">Lulus</span></td>
                <td>
                    <div class="btn-group .z-index-master">
                        <button type="button" class="btn btn-info" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Lihat kertas kerja">Lihat</button>
                        <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Sunting</a></li>
                            <li><a class="dropdown-item" href="#">Butiran status</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li class="bg-danger"><a class="dropdown-item" href="#">Padam kertas kerja</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            <tr>
                <td><span class="fw-normal">2.</span></td>
                <td><span class="fw-normal">Program TBA</span></td>
                <td><span class="fw-normal">5 November 2022</span></td>
                <td><span class="fw-normal d-flex align-items-center">22 - 24 Disember 2022</span></td>
                <td><span class="fw-normal text-warning">Dalam proses</span></td>
                <td>
                    <div class="btn-group z-index-master">
                        <button type="button" class="btn btn-info" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Lihat kertas kerja">Lihat</button>
                        <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Sunting</a></li>
                            <li><a class="dropdown-item" href="#">Butiran status</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li class="bg-danger"><a class="dropdown-item" href="#">Padam kertas kerja</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            <tr>
                <td><span class="fw-normal">3.</span></td>
                <td><span class="fw-normal">Program TBA</span></td>
                <td><span class="fw-normal">5 November 2022</span></td>
                <td><span class="fw-normal d-flex align-items-center">22 - 24 Disember 2022</span></td>
                <td><span class="fw-normal text-danger">Draf</span></td>
                <td>
                    <div class="btn-group">
                        <a href="#" class="btn btn-sm btn-success" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Lihat kertas kerja">
                            <i class="fas fa-eye text-white"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-info" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Sunting kertas kerja">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Padam kertas kerja">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>

{{-- modal to add new paperwork --}}

<div class="modal fade" id="modal-addNewPaperwork" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            {{-- create a form to add a new paperwork with attributes: name, method to upload paperwork --}}
            {{-- <form action="{{ route('paperwork.store') }}" method="POST" enctype="multipart/form-data"> --}}
            <form action="{{ route('paperwork.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="h6 modal-title">Tambah Kertas Kerja</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pb-0">
                        <div class="form-group mb-3">
                            <label class="form-label required">Nama Kertas Kerja</label>
                            <input type="text" class="form-control" name="name" placeholder="Nama Kertas Kerja" required>
                        </div>
                        --}}
                            
            
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

{{-- Javascript for modal add new paperwork --}}

<script>
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
    });

</script>
<title>eKK PDF Generator</title>
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
    {{-- <div class="btn-toolbar mb-2 mb-md-0">
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
    </div> --}}
</div>
<div class="card card-body shadow border-0 table-wrapper table-responsive">
    <div>Nama Kertas Kerja: {{ $paperwork->name }}</div>

    <div class="progress-wrapper">
        <div class="progress-info">
            <div class="progress-label">
                Status: 
                <span class="text-danger">Draf</span>
            </div>
            <div class="progress-percentage">
                <span>30%</span>
            </div>
        </div>
        <div class="progress">
            <div class="progress-bar bg-danger" role="progressbar" style="width: 30%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>

    <div>
        <button class="btn btn-primary" type="button">Lihat Kertas Kerja</button>
        <?php if ($paperwork->isGenerated) { ?>
            <button class="btn btn-outline-secondary" type="button">Sunting di penjana</button>
        <?php } else { ?>
            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-editPaperwork" class="btn btn-outline-secondary">Sunting</button>
        <?php } ?>
    </div>
</div>


<div class="modal fade" id="modal-editPaperwork" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            {{-- create a form to add a new paperwork with attributes: name, method to upload paperwork --}}
            {{-- <form action="{{ route('paperwork.store') }}" method="POST" enctype="multipart/form-data"> --}}
            <form action="{{ route('paperwork.update', $paperwork->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h2 class="h6 modal-title">Sunting Kertas Kerja</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label class="form-label required">Nama Kertas Kerja</label>
                        <input type="text" class="form-control" name="paperwork_name" placeholder="Nama Kertas Kerja" autocomplete="off" required>
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
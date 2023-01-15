<title>e-KK | Pengurusan Pengguna</title>
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
                <li class="breadcrumb-item"><a href="#">Pengguna</a></li>
                <li class="breadcrumb-item active" aria-current="page">Senarai Pengguna</li>
            </ol>
        </nav>
        <h2 class="h4">Senarai Pengguna</h2>
        <p class="mb-0">Halaman ini menunjukkan senarai pengguna dalam sistem.</p>
    </div>
    @if (auth()->user()->role == 0)
    <div class="btn-toolbar mb-2 mb-md-0">
        <button type="button" data-bs-toggle="modal" data-bs-target="#modal-addNewUser" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
            <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                </path>
            </svg>
            Tambah Pengguna Baru
        </button>
    </div>
    @endif
</div>
<div class="row mb-4">
    @if (auth()->user()->role == 0)
    <div class="col-3 col-lg-4">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon-shape icon-shape-tertiary rounded me-4 me-sm-0">
                            <i class="far fa-newspaper text-white"></i>
                        </div>
                    </div>
                    <div class="col-12 col-xl-7 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h6 mb-0">Jumlah Pengguna</h2>
                            <h3 class="fw-extrabold mb-2">@if (isset($users)) <span>{{ count($users) }}</span> @else <span>0</span>@endif</h3>
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
            <select class="form-select fmxw-200 d-none d-md-inline" aria-label="Message select example 2">
                <option selected>Semua</option>
                <option value="1">Kelab</option>
                <option value="2">Penasihat</option>
                <option value="3">Pegawai</option>
                <option value="4">TNC dan NC</option>
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
                <th class="border-bottom name">Nama Pengguna</th>
                <th class="border-bottom">Status</th>
                <th class="border-bottom"></th>
            </tr>
            <?php $numbering = 1; ?>
            @foreach ($users as $user)
                <tr>
                    <td><span class="fw-normal">{{ $numbering }}.</span></td>
                    <td><span class="fw-normal">{{ $user->name }}</span></td>
                    @if ($user->role == 1)
                        <td><span class="fw-normal"><span class="badge bg-success">Kelab</span></span></td>
                    @elseif ($user->role == 2)
                        <td><span class="fw-normal"><span class="badge bg-primary">Penasihat</span></span></td>
                    @elseif ($user->role == 3)
                        <td><span class="fw-normal"><span class="badge bg-warning">Pegawai</span></span></td>
                    @elseif ($user->role == 4)
                        <td><span class="fw-normal"><span class="badge bg-danger">TNC</span></span></td>
                    @elseif ($user->role == 5)
                        <td><span class="fw-normal"><span class="badge bg-info">NC</span></span></td>
                    @endif
                    <td>
                        <div class="btn-group me-2 mb-2">
                            <a type="button" class="btn btn-sm btn-info">Butiran</a>
                                <button type="button" class="btn btn-sm btn-info dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item bg-danger text-white" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-bs-toggle="modal" data-bs-target="#modal-deleteUser">Padam</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php $numbering++; ?>
            @endforeach
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

{{-- modal to add new paperwork --}}
<div class="modal fade" id="modal-addNewUser" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            {{-- create a form to add a new paperwork with attributes: name, method to upload paperwork --}}
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h2 class="h6 modal-title">Tambah Pengguna Baru</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label class="form-label required">Nama Pengguna</label>
                        <input type="text" class="form-control" name="user_name" placeholder="Nama Pengguna" autocomplete="off" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label required">Email Pengguna</label>
                        <input type="text" class="form-control" name="user_email" placeholder="user@email.com" autocomplete="off" required>
                    </div>
                    {{-- add radio button to select user role --}}
                    <label for="">Jenis pengguna</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="user_role" value="1" checked>
                        <label class="form-check-label">
                            Kelab
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="user_role" value="2">
                        <label class="form-check-label">
                            Penasihat
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="user_role" value="3">
                        <label class="form-check-label">
                            Pegawai
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="user_role" value="4">
                        <label class="form-check-label">
                            TNC (HEPA)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="user_role" value="5">
                        <label class="form-check-label">
                            NC
                        </label>
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

{{-- modal confirmation to delete paperwork --}}
<div class="modal fade" id="modal-deleteUser" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="h6 modal-title">Padam Pengguna</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-0">
                <div id="user-deleted-name">{{ $user->name }}</div>
                <p>Adakah anda pasti untuk memadam pengguna ini?</p>
            </div>
            <div class="modal-footer">
                <form action="" id="delete-user" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Padam</button>
                </form>
                <button type="button" class="btn btn-link text-gray ms-auto" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

{{-- javascript for modal add new paperwork --}}
<script>
    $(document).ready(function() {

        $('#modal-deleteUser').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes
            var name = button.data('name') // Extract info from data-* attributes

            $("#user-deleted-name").text(name);

            // change the action attribute of form to delete 
            $('#delete-user').attr('action', '/users/delete/' + id);
        });
    });

    $(document).ready(function() {
        $("#user-search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("table tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    // set timeout for alert message
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
    }, 4000);

</script>
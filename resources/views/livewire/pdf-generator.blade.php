<title>eKK PDF Generator</title>
<div>
        <script src=
"https://code.jquery.com/jquery-3.6.1.js"></script>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    </div>
    <div class="row">
        <div class="col-12 col-xl-8">
            <div class="card card-body border-0 shadow mb-4">
                <h2 class="h5 mb-4">Kertas Kerja Generator</h2>
                <form action="#" autocomplete="off">
                    <div class="row">
                        {{-- <div class="col-md-6 mb-3">
                            <div>
                                <label for="first_name">First Name</label>
                                <input class="form-control" id="first_name" type="text"
                                    placeholder="Enter your first name" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="last_name">Last Name</label>
                                <input class="form-control" id="last_name" type="text"
                                    placeholder="Also your last name" required>
                            </div>
                        </div> --}}
                        <div class="mb-3">
                            <label for="program-name">Nama program</label>
                            <input class="form-control" id="program-name" type="text"
                                placeholder="Masukkan nama program" required>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-3">
                            <label for="program-date-type">Program satu hari?</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="program-date-type" value="one-day" checked>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- <div class="day col-md-6 mb-3 d-none">
                            <label for="program-date">Tarikh program</label>
                            <div class="input-group">
                                <span class="input-group-text"><svg class="icon icon-xs" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd"></path>
                                    </svg></span>
                                <input data-datepicker=""
                                    class="form-control datepicker-input" id="program-date" type="text"
                                    placeholder="dd/mm/yyyy">
                            </div>
                        </div> --}}
                        <div class="date-day col-md-6 mb-3 d-none">
                            <label for="program-date">Tarikh program</label>
                            <input class="form-control" id="program-date" type="date"
                                placeholder="dd/mm/yyyy">
                        </div>
                        <div class="date-start col-md-6 mb-3">
                            <label for="program-date-start">Tarikh bermula</label>
                            <input class="form-control datepicker-input" id="program-date-start" type="date"
                                placeholder="dd/mm/yyyy">
                        </div>
                        <div class="date-end col-md-6 mb-3">
                            <label for="program-date-end">Tarikh berakhir</label>
                            <input class="form-control datepicker-input" id="program-date-end" type="date"
                                placeholder="dd/mm/yyyy">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="program-place">Tempat program</label>
                                <input  class="form-control" id="program-place" type="text"
                                    placeholder="Contoh: Dewan Auditorium FKP">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="program-collab">Dengan kerjasama (jika ada)</label>
                                <input class="form-control" id="collab" type="text"
                                    placeholder="Kelab ABC, Kelab DEF">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="program-preparedby">Disediakan oleh</label>
                            <input class="form-control" id="collab" type="text"
                                    placeholder="Nama pengarah program atau setiausaha">
                        </div>
                        {{-- <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="phone">No. Telefon Rasmi Kelab</label>
                                <input class="form-control" id="phone" type="number"
                                    placeholder="+60123456789">
                            </div>
                        </div> --}}
                    </div>
                    <h2 class="h5 my-4">Status Program Terakhir</h2>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="last-program-date">Tarikh program terakhir yang dilulus dan dilaksanakan</label>
                                <input class="form-control" id="last-program-date" type="date"
                                    placeholder="dd/mm/yyyy">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="last-program-status">Status laporan program terakhir</label>
                                <select class="form-select mb-0" id="last-program-status"
                                    aria-label="Pilihan status laporan">
                                    <option value="0" selected>Dilaksanakan</option>
                                    <option value="1">Hantar</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-gray-800 mt-2 animate-up-2">Generate Kertas Kerja</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    // $(document).ready(function() {

        // select program-date-type checkbox to toggle between one-day and multi-day
        // $('#program-date-type').change(function() {
        //     if ($(this).is(':checked')) {
        //         $('.date-day').addClass('d-none');
        //         $('.date-start').removeClass('d-none');
        //         $('.date-end').removeClass('d-none');
        //     } else {
        //         $('.date-day').removeClass('d-none');
        //         $('.date-start').addClass('d-none');
        //         $('.date-end').addClass('d-none');
        //     }
        // });

        // $('input[type="checkbox"]').click(function() {
        $('#program-date-type').change(function() {




            // var inputValue = $(this).attr("value");

            // if input is checked then one-day is d-block
            if ($(this).is(":checked")) {
                $(".date-day").addClass("d-block");
                $(".date-start").addClass("d-none");
                $(".date-end").addClass("d-none");
                $(".date-day").removeClass("d-none");
                $(".date-start").removeClass("d-block");
                $(".date-end").removeClass("d-block");
            } else {
                $(".date-day").addClass("d-none");
                $(".date-start").addClass("d-block");
                $(".date-end").addClass("d-block");
                $(".date-day").removeClass("d-block");
                $(".date-start").removeClass("d-none");
                $(".date-end").removeClass("d-none");
            }
            // if (inputValue == "one-day") {
            //     $(".day").toggle();
            //     $(".date-day").toggle();
            //     $(".date-start").toggle();
            //     $(".date-end").toggle();
            // }
            // $("." + inputValue).toggle();
        });
    // });
</script>
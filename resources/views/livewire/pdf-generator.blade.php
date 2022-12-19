<title>eKK PDF Generator</title>
<div>
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    </div>
    <div class="row">
        <div class="">
            <div class="card card-body border-0 shadow mb-4">
                <h2 class="h5 mb-4">Kertas Kerja Generator</h2>
                <div class="section-tab">
                    <a id="tab1" style="padding: 10px; border: 2px solid red; background-color: red;">Detail 1</a>
                    <a id="tab2">Detail 2</a>
                    <a id="tab3">Detail 3</a>
                    <a id="tab4">Detail 4</a>
                </div>
                <form id="paperwork" action="{{ route('view-pdf') }}" method="post" autocomplete="off" target="_blank">
                    @csrf
                    <div class="details-1 d-block">
                        <h1>Bahagian 1</h1>
                        <div class="row">
                            <p>Click me</p>
                            <div class="mb-3">
                                <label for="program-name">Nama program</label>
                                <input class="form-control" id="program-name" type="text" name="program_name"
                                    placeholder="Masukkan nama program" required>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-6 mb-3">
                                <label for="program-date-type">Program satu hari?</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="program-date-type" name="program_date_type" value="one-day" checked>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="date-day col-md-6 mb-3">
                                <label for="program-date">Tarikh program</label>
                                <input class="form-control" id="program-date" type="date" name="program_date"
                                    placeholder="dd/mm/yyyy">
                            </div>
                            <div class="date-start col-md-6 mb-3 d-none">
                                <label for="program-date-start">Tarikh bermula</label>
                                <input class="form-control datepicker-input" id="program-date-start" type="date" name="program_date_start"
                                    placeholder="dd/mm/yyyy">
                            </div>
                            <div class="date-end col-md-6 mb-3 d-none">
                                <label for="program-date-end">Tarikh berakhir</label>
                                <input class="form-control datepicker-input" id="program-date-end" type="date" name="program_date_end"
                                    placeholder="dd/mm/yyyy">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="program-place">Tempat program</label>
                                    <input  class="form-control" id="program-place" type="text" name="program_place"
                                        placeholder="Contoh: Dewan Auditorium FKP">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="program-collab">Dengan kerjasama (jika ada)</label>
                                    <input class="form-control" id="collab" type="text" name="program_collab"
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
                                    <select class="form-select mb-0" id="last-program-status" name="last_program_status">
                                        aria-label="Pilihan status laporan">
                                        <option value="0" selected>Dilaksanakan</option>
                                        <option value="1">Hantar</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="details-2 d-none">
                        <h1>Bahagian 2</h1>
                        <div class="row">
                            <div class="mb-3">
                                <label for="program-name">Nama program</label>
                                <input class="form-control" id="program-name" type="text" name="program_name"
                                    placeholder="Masukkan nama program" required>
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
<script>
    $(document).ready(function() {
        $("#program-date-start").change(checkDates);
        $("#program-date-end").change(checkDates);
    });

    function checkDates() {
        // Get the start date and end date from the input fields
        var startDate = $("#program-date-start").val();
        var endDate = $("#program-date-end").val();

        // Create Date objects from the start and end dates
        var start = new Date(startDate);
        var end = new Date(endDate);

        if (end < start && endDate != "") {
            alert("Tarikh mula program tidak boleh melebihi tarikh tamat program");
            $("#program-date-end").val("");
        } else if (end < start && endDate == "") {
            alert("Tarikh mula program tidak boleh melebihi tarikh tamat program");
            $("#program-date-end").val("");
        }

        
    }
    // click detail 1 to show form 1 and detail 2 to show form 2
    $('#tab1').click(function() {
        $('.details-2').removeClass('d-block');
        $('.details-2').addClass('d-none');
        $('.details-1').removeClass('d-none');
        $('.details-1').addClass('d-block');
    });
    $('#tab2').click(function() {
        $('.details-2').removeClass('d-none');
        $('.details-2').addClass('d-block');
        $('.details-1').removeClass('d-block');
        $('.details-1').addClass('d-none');
    });

    $('#program-date-type').change(function() {
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
    });
</script>
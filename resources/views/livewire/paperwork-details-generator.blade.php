<title>eKK PDF Generator</title>
<div>
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.rawgit.com/trentrichardson/jQuery-Timepicker-Addon/1.6.3/dist/jquery-ui-timepicker-addon.min.js"></script>


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
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
                <form id="paperwork" action="{{ route('view-pdf') }}" method="post" autocomplete="off" target="_blank">
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
                                <textarea class="form-control" id="pendahuluan" name="pendahuluan" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <label for="latar-belakang">Latar Belakang</label>
                            {{-- check if $paperworkDetails->background is null --}}
                            @if($paperworkDetails->background == null)
                                <input type="hidden" name="" value="{{$key = 0}}">
                                <div class="d-flex mb-3" id="background_{{$key+1}}">
                                    <textarea class="form-control" id="latar-belakang-{{$key+1}}" name="latar_belakang[]" required></textarea>
                                    <button type="button" class="btn btn-outline-danger btn_remove_background w-25 h-100 px-2 ms-4" id="btn_remove_background_{{$key+1}}" value="{{$key+1}}" onclick="removeInputField('background_' + {{$key+1}})">X</button>
                                </div>
                            @else
                                @foreach($paperworkDetails->background as $key => $background)
                                    <div class="mb-3" id="background_{{$key+1}}">
                                        <textarea class="form-control" id="latar-belakang-{{$key+1}}" name="latar_belakang[]" required>{{$background}}</textarea>
                                        <button type="button" class="btn btn-outline-danger btn_remove_background" id="btn_remove_background_{{$key+1}}" value="1">X</button>
                                    </div>
                                @endforeach
                            @endif
                            <hr id="background-line">
                            <div class="mb-3 row">
                                <div class="col-12 col-sm-4 col-md-4 offset-md-4">
                                    <div class="d-grid gap-2">
                                        <button type="button" class="btn btn-outline-primary" id="btn_add_background">+ Tambah Latar Belakang</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <label for="objektif-program">Objektif</label>
                                <textarea class="form-control" id="objektif-program" name="objektif-program" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <label for="hasil-pembelajaran">Hasil Pembelajaran</label>
                                <textarea class="form-control" id="hasil-pembelajaran" name="hasil-pembelajaran" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <label for="tema-program">Tema</label>
                                <input type="text" class="form-control" id="tema-program" name="tema-program" required/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <label for="anjuran">Anjuran</label>
                                <textarea class="form-control" id="anjuran" name="anjuran" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <label for="kumpulan-sasaran">Kumpulan Sasaran</label>
                                <textarea class="form-control" id="kumpulan-sasaran" name="kumpulan-sasaran" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <label for="tarikh-tempat-masa">Tarikh, Tempat dan Masa</label>
                                <textarea class="form-control" id="tarikh-tempat-masa" name="tarikh-tempat-masa" required></textarea>
                            </div>
                        </div>
                    </div>
                    {{-- TENTATIF --}}
                    <div class="tab-pane fade" id="nav-tentative" role="tabpanel" aria-labelledby="nav-tentative-tab">
                        <h1>Tentatif Program</h1>
                        {{-- if program-date-start input and program-date-end input are blank, show a message to user--}}
                        <div id="tentative">

                           

                            <div id="tentative-inputs">

                            </div>
                        </div>
                        <p>Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa eiusmod
                            Pinterest in do umami readymade swag.</p>
                        <p>Day handsome addition horrible sensible goodness two contempt. Evening for married his account removal. Estimable me disposing of be moonlight cordially curiosity.</p>
                    </div>
                    {{-- IMPLIKASI KEWANGAN --}}
                    <div class="tab-pane fade" id="nav-financial" role="tabpanel" aria-labelledby="nav-financial-tab">
                        <h1>Implikasi Kewangan</h1>
                        <p>Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa eiusmod
                            Pinterest in do umami readymade swag.</p>
                        <p>Day handsome addition horrible sensible goodness two contempt. Evening for married his account removal. Estimable me disposing of be moonlight cordially curiosity.</p>
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
                        <p>Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa eiusmod
                            Pinterest in do umami readymade swag.</p>
                        <p>Day handsome addition horrible sensible goodness two contempt. Evening for married his account removal. Estimable me disposing of be moonlight cordially curiosity.</p>
                    </div>
                    <div class="flex mt-3">
                        <button type="button" class="btn btn-primary mt-2 animate-up-2">Simpan</button>
                        <button type="button" class="btn btn-secondary mt-2 animate-up-2">Lihat PDF</button>
                        <button type="submit" class="btn btn-gray-100 mt-2 animate-up-2">Hantar</button>
                    </div>
                </div>
            </form>
                <!-- End of tab -->
            </div>
        </div>
    </div>
</div>
<script>

    var isOneDayProgram = true;
    // var program-date-start = $("#program-date-start").val();
    var programDate;
    var programDateStart;
    var programDateEnd;

    var count_row_background = 1;
    var row_background = 1;

    $(document).ready(function() {
        $("#program-date-start").change(checkDates);
        $("#program-date-end").change(checkDates);

        // if program-date is changed, call addInputFieldTentative()
        $("#program-date").change(addInputFieldTentative);

        // disable remove button for background 1
        $('#btn_remove_background_1').prop('disabled', true);

        // if program-date-start or program-date-end is empty, hide the tentative div. and add into .change
        
        $("#tentative").hide();
        $("#timepicker").timepicker();

    });

    // add new input for background
    $(function() {
        $('#btn_add_background').on('click',function(){
            count_row_background++;
            // var clone = $("#background_1").clone().insertAfter("#background_"+(count_row_background-1));
            var clone = $("#background_1").clone().insertBefore("#background-line");

            console.log(count_row_background);

            clone.attr("id","background_"+count_row_background);
            clone.find("textarea").val("");
            clone.find("textarea").attr("id","background_"+count_row_background);
            clone.find("textarea").attr("name","background_"+count_row_background);

            clone.find("button").attr("id","btn_remove_background_"+count_row_background);
            clone.find("button").attr("onclick","removeInputField('background_"+count_row_background+"')");
            clone.find("button").attr("disabled",false);
        });


    });

    // remove input for background
    function removeInputField(field_id){
        $("#" + field_id).remove();
    }

    // add input fields in tentative div
    function addInputFieldTentative() {
        // get the value of program-date
        programDate = $("#program-date").val();
        // if program-date is not empty, show the tentative div
        if (programDate != "") {
            $("#tentative").show();
            // if program-date-start is empty, set program-date-start to program-date
            if ($("#program-date-start").val() == "") {
                $("#program-date-start").val(programDate);
            }
            // if program-date-end is empty, set program-date-end to program-date
            if ($("#program-date-end").val() == "") {
                $("#program-date-end").val(programDate);
            }
            // if program-date-start is not empty, set program-date-start to program-date
            if ($("#program-date-start").val() != "") {
                programDateStart = $("#program-date-start").val();
            }
            // if program-date-end is not empty, set program-date-end to program-date
            if ($("#program-date-end").val() != "") {
                programDateEnd = $("#program-date-end").val();
            }
            // if program-date-start is equal to program-date-end, set isOneDayProgram to true
            if (programDateStart == programDateEnd) {
                isOneDayProgram = true;
            } else {
                isOneDayProgram = false;
            }
            // if isOneDayProgram is true, add input fields for one day program
            if (isOneDayProgram) {
                $("#tentative-inputs").html(
                    `<div class="row">
                        <div class="mb-3">
                            <label for="tarikh-tempat-masa">Tarikh, Tempat dan Masa</label>
                            <input type="text" class="form-control" id="tarikh-tempat-masa" name="tarikh-tempat-masa" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3">
                            <label for="tarikh-tempat-masa">Tarikh, Tempat dan Masa</label>
                            <input type="text" class="form-control" id="tarikh-tempat-masa" name="tarikh-tempat-masa" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3">
                            <label for="tarikh-tempat-masa">Tarikh, Temp at dan Masa</label>
                            <input type="text" class="form-control" id="tarikh-tempat-masa" name="tarikh-tempat-masa" required>
                        </div>
                    </div>`
                );
            } else {
                // if isOneDayProgram is false, add input fields for more than one day program
                $("#tentative-inputs").html(
                    `<div class="row">
                        <div class="mb-3">
                            <label for="tarikh-tempat-masa">Tarikh, Tempat dan Masa</label>
                            <input type="text" class="form-control" id="tarikh-tempat-masa" name="tarikh-tempat-masa" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3">
                            <label for="tarikh-tempat-masa">Tarikh, Tempat dan Masa</label>
                            <input type="text" class="form-control" id="tarikh-tempat-masa" name="tarikh-tempat-masa" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3">
                            <label for="tarikh-tempat-masa">Tarikh, Tempat dan Masa</label>
                            <input type="text" class="form-control" id="tarikh-tempat-masa" name="tarikh-tempat-masa" required>
                        </div>
                    </div>`
                );
            }
        } else {
            // if program-date is empty, hide the tentative div
            $("#tentative").hide();
        }
    }


    function checkDates() {
        // Get the start date and end date from the input fields
        var startDate = $("#program-date-start").val();
        var endDate = $("#program-date-end").val();

        // Create Date objects from the start and end dates
        var start = new Date(startDate);
        var end = new Date(endDate);

        // calculate days between dates and add 1 to include the start date in the calculation
        var duration = (end - start) / (1000 * 60 * 60 * 24) + 1;

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
            $("#tentative").html("Program ini akan berlangsung selama " + duration + " hari");
            // add new line
            $("#tentative").append("<br>");
            $("#tentative").show();

            var days = ["Ahad", "Isnin", "Selasa", "Rabu", "Khamis", "Jumaat", "Sabtu"];

            // create array and duration as its size
            var tentatives = new Array(duration);

            // initialize the array with 0 based on the duration
            for (var i = 0; i < duration; i++) {
                tentatives[i] = 0;
            }

            console.log(tentatives);

            // add X amount of input fields for the tentative dates based on the days
            for (var i = 0; i < duration; i++) {
                var date = new Date(start);
                date.setDate(date.getDate() + i);

                // get the date and day of the week
                var day = days[date.getDay()];
                var date = date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear();
                
                // display the number of day, day of the week and date as label and input
                var label = '<label for="hari_' + i + '">Hari ' + (i + 1) + ' (' + day + ' ' + date + ')</label>';
                
                $("#tentative").append(label);
                var input = '<input type="text" class="form-control" id="hari_' + i + '" name="Hari_' + i + '" value="' + date + '" required/>';
                $("#tentative").append(input);

                // add timepicker for each day of the program and make sure each of them is unique by adding the day number to name
                var timepicker = '<input type="text" class="form-control" id="timepicker" name="timepicker_hari_' + i + '_' + tentatives[i] + '" required/>';
                $("#tentative").append(timepicker);
                $("#timepicker").timepicker();
                
                // add a new button to add new column
                var button = '<button type="button" class="btn btn-primary mt-2 animate-up-2" id="btn_add_column_name">Tambah masa</button>';
                $("#tentative").append(button);

                // add horizontal line
                var hr = '<hr>';
                $("#tentative").append(hr);

                // add new timepicker after the previous one
                $("#btn_add_column_name").click(function() {
                    tentatives[i]++;
                    var new_timepicker = '<input type="text" class="form-control" id="timepicker" name="timepicker_hari_' + i + '_' + tentatives[i] + '" required/>';
                    $("#tentative").append(new_timepicker);
                    $("#timepicker").timepicker();
                });



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
    });


</script>
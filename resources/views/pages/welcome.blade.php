@extends('layouts.app')

@section('css')
    <style>
        textarea { width: 100%; }
    </style>
@endsection


@section('content')
<div class="flex-center position-ref full-height">


        <div class="content">

            <form
                id="spinner-form"
                method="POST"
                action="{{ route('home.spin') }}"
                enctype="multipart/form-data"
                data-parsley-validate
            >
            @csrf
            <!-- ============================================================== -->
            <!-- input text form  -->
            <!-- ============================================================== -->

                <div class="row mb-4 mt-4" id="input-div">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Input Text</h5>
                            <div class="card-body">
                                <div class="form-group">
                                    <input
                                        id="input"
                                        name="input"
                                        type="hidden"
                                        value="{{ $input ? $input : '' }}"
                                    />
                                    <input
                                        id="output2"
                                        name="output2"
                                        type="hidden"
                                        value="{{ $output2 ? $output2 : '' }}"
                                    />

                                    <label for="spinner_input_textarea">Enter your text</label>
                                    <textarea
                                        class="form-control"
                                        id="spinner_input_textarea"
                                        name="spinner_input"
                                        rows="3"
                                        max-rows="20"
                                        data-parsley-required
                                    ></textarea>

                                    {{-- <p> Spintax 1: Content <i class="fas fa-arrow-right"></i> Spintax. |
                                        Spintax 2: Content <i class="fas fa-arrow-right"></i> Spintax + original word excluded. |
                                        Spin: Spintax <i class="fas fa-arrow-right"></i> spin result text.
                                    </p> --}}

                                </div>
                                <div>
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                        name="spin"
                                        value="spintax1"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Generate spintax"
                                    >
                                        Spintax 1
                                    </button>
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                        name="spin"
                                        value="spintax2"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Generate spintax"
                                    >
                                        Spintax 2
                                    </button>

                                    <button type="submit" class="btn btn-primary" name="spin" value="spin">Spin Input</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end input text form  -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- output text form  -->
                <!-- ============================================================== -->
                <div class="row" id="output-div">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Output Text</h5>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="spinner_result_textarea">Result</label>
                                    <textarea
                                        class="form-control"
                                        id="spinner_result_textarea"
                                        name="spinner_output"
                                        rows="3"
                                        max-rows="20"
                                    ></textarea>
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-primary" name="spin" value="spin2">Spin Output</button>
                                    <button type="button" class="btn btn-primary" id="output_reset">Reset Output</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end output text form  -->
                <!-- ============================================================== -->
            </form>
        </div>
    </div>
    @include('include.about')
    <a class="back-to-top" href="#" style="display: none;">
        <img src="svg/back-to-top.svg" alt="arrow" class="back-icon">
    </a>
@endsection

@section('js')
    <script>
        const $inputTextarea = $('#spinner_input_textarea');
        const $resultTextarea = $('#spinner_result_textarea');

        $inputTextarea.val($('#input').val());
        $resultTextarea.val($('#output2').val());

        var os = {!! json_encode($output, JSON_HEX_TAG) !!};
        var os2 = {!! json_encode($output2, JSON_HEX_TAG) !!};

        if (Array.isArray(os) == true && Array.isArray(os2) == false)
        {
            for (var o of os) {
                var temp = $resultTextarea.val();
                if (o == '') $resultTextarea.val(temp + "\n");
                else $resultTextarea.val(temp + o + "\n");
            }
        }

        var form = $("#spinner-output-form");
        $("#output_reset").click(function() {
            $resultTextarea.val('');
            form.trigger("reset");
        });

        if ($resultTextarea.val() == '') $('#output-div').hide()
        else $('#output-div').show()

        // const $inputCharacterCountLabel = $('#input_character_count_label');
        // const $inputWordCountLabel = $('#input_word_count_label');

        // $inputTextarea.on('input change', function() {
        //     var len = $inputTextarea.val().length;
        //     $inputCharacterCountLabel.text(`${len} characters`);

        //     var words = $.trim($inputTextarea.val()).split(" ");
        //     $inputWordCountLabel.text(`${words} words`);
        // });

        // const $resultCharacterCountLabel = $('#result_character_count_label');
        // const $resultWordCountLabel = $('#result_word_count_label');

        // $resultTextarea.on('input change', function() {
        //     var len = $resultTextarea.val().length;
        //     $resultCharacterCountLabel.text(`${len} characters`);

        //     var words = $.trim($resultTextarea.val()).split(" ");
        //     $resultWordCountLabel.text(`${words} words`);
        // });

    </script>
@endsection

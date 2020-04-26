@extends('layouts.app')

@section('css')
    <style>
        textarea { width: 100%; }
    </style>
@endsection


@section('content')
<div class="flex-center position-ref full-height">


        <div class="content">
            <div class="section-block">
                <h3 class="section-title">Article Spinner Tool</h3>
            </div>
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

                <div class="row mb-4">
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
                                        placeholder="e.g. Berbagai inovasi artikel"
                                        data-parsley-required
                                    ></textarea>

                                    <p> Spintax 1: Content -> Spintax. |
                                        Spintax 2: Content -> Spintax + original word excluded. |
                                        Spin: Spintax -> spin result text.
                                    </p>

                                    <div>
                                        <button type="submit" class="btn btn-primary" name="spin" value="spintax1">Spintax 1</button>
                                        <button type="submit" class="btn btn-primary" name="spin" value="spintax2">Spintax 2</button>
                                        <button type="submit" class="btn btn-primary" name="spin" value="spin">Spin Input</button>
                                    </div>

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
                <div class="row">
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
@endsection

@section('js')
    <script>
        $('#spinner_input_textarea').val($('#input').val());
        $('#spinner_result_textarea').val($('#output2').val());

        var os = {!! json_encode($output, JSON_HEX_TAG) !!};
        var os2 = {!! json_encode($output2, JSON_HEX_TAG) !!};

        if (Array.isArray(os) == true && Array.isArray(os2) == false)
        {
            for (var o of os) {
                var temp = $('#spinner_result_textarea').val();
                if (o == '')
                    $('#spinner_result_textarea').val(temp + "\n");
                else
                    $('#spinner_result_textarea').val(temp + o + "\n");
            }
        }

        var form = $("#spinner-output-form");
        $("#output_reset").click(function() {
            $('#spinner_result_textarea').val('');
            form.trigger("reset");
        });
    </script>
@endsection

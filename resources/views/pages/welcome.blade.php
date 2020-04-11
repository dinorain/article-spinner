@extends('layouts.app')

@section('content')
<div class="flex-center position-ref full-height">


        <div class="content">
            <div class="section-block">
                <h3 class="section-title">Article Spinner Tool</h3>
            </div>
            <!-- ============================================================== -->
            <!-- input text form  -->
            <!-- ============================================================== -->

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <form
                        id="spinner-input-form"
                        method="POST"
                        action="{{ route('home.spin') }}"
                        enctype="multipart/form-data"
                        data-parsley-validate
                    >
                        @csrf
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
                                        id="output"
                                        name="output"
                                        type="hidden"
                                        value="{{ $output ? $output : '' }}"
                                    />

                                    <label for="spinner_input_textarea">Enter your text</label>
                                    <textarea
                                        class="form-control"
                                        id="spinner_input_textarea"
                                        name="spinner_input"
                                        rows="3"
                                        data-parsley-required
                                    ></textarea>

                                    <p> Spintax 1: Content -> Spintax. |
                                        Spintax 2: Content -> Spintax + original word deleted. |
                                        Spin: Spintax -> spin result text.
                                    </p>

                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary" name="spin" value="spintax_1">Spintax 1</button>
                            <button type="submit" class="btn btn-primary" name="spin" value="spintax_2">Spintax 2</button>
                            <button type="submit" class="btn btn-primary" name="spin" value="spin">Spin</button>
                            <button type="button" class="btn btn-primary" id="output_reset">Reset result</button>
                        </div>
                    </form>
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
                            <form
                                id="spinner-output-form"
                                enctype="multipart/form-data"
                            >
                                <div class="form-group">
                                    <label for="spinner_result_textarea">Result</label>
                                    <textarea
                                        class="form-control"
                                        id="spinner_result_textarea"
                                        rows="3"
                                    ></textarea>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end output text form  -->
            <!-- ============================================================== -->
        </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#spinner_input_textarea').val($('#input').val());
        $('#spinner_result_textarea').val($('#output').val());

        $("#output_reset").click(function() {
            $('#spinner_result_textarea').val('');
            var form = $("#spinner-output-form");
            form.trigger("reset");
        });
    </script>
@endsection

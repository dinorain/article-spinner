@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/buttons.bootstrap4.css') }}">
    <style>

        table {
            table-layout: fixed !important;
        }

        td {
            word-wrap: break-word !important;
        }
    </style>
@endsection

@section('content')
    <div class="flex-center position-ref full-height">

        <div class="content">
            @include('flash::message')

            <a href="#" class="btn btn-primary mb-3" onclick="showCreateTargetDialog.apply(this, arguments)">Add target</a>
            <a href="#" class="btn btn-secondary mb-3" onclick="showUploadTargetsExcelDialog.apply(this, arguments)">Upload targets</a>

            {{-- <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addTargetModal">Add a target</a> --}}
            <div class="row">
                <!-- ============================================================== -->
                <!-- data table  -->
                <!-- ============================================================== -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Spintax Collections</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Target</th>
                                            <th>Spintax 2</th>
                                            <th>Created at</th>
                                            <th>Updated at</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($inputs as $input)
                                        <tr>
                                            <td>
                                                {{ $input->target }}
                                                <a
                                                    href="#"
                                                    onclick="showEditTargetDialog({{ $input->id }}).apply(this, arguments)"
                                                >
                                                <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            </td>
                                            <td>{{ '{'.($spintaxTargetIdDict[$input->id] === null ? '' : $spintaxTargetIdDict[$input->id]).'}' }}</td>
                                            <td>{{ Carbon\Carbon::parse($input->created_at)->format('d/m/Y h:m') }}</td>
                                            <td>{{ Carbon\Carbon::parse($input->updated_at)->format('d/m/Y h:m') }}</td>
                                            <td>
                                                <div class="btn-group ml-auto">
                                                    <a
                                                        href="{{ route('spintax.index', ['target_id' => $input->id]) }}"
                                                        class="btn btn-sm"
                                                    >
                                                        See details
                                                    </a>
                                                    <a
                                                        href="#"
                                                        class="btn btn-sm"
                                                        onclick="showDeleteTargetDialog({{ $input->id }}, '{{ "$input->target" }}').apply(this, arguments)"
                                                    >
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

    @include('dialogs.target.create-edit')
    @include('dialogs.target.delete')
    @include('dialogs.target.upload-excel')

@endsection

@section('js')
    @include('dialogs.target.create-edit-js')
    @include('dialogs.target.delete-js')
    @include('dialogs.target.upload-excel-js')


    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('js/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/datatables/data-table.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
@endsection

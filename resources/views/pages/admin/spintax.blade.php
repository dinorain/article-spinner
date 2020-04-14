@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/buttons.bootstrap4.css') }}">
@endsection

@section('content')
    <div class="flex-center position-ref full-height">

        <div class="content">

            <a href="#" class="btn btn-primary mb-3" onclick="showCreateSpintaxDialog('{{ "$spintaxInput->target" }}').apply(this, arguments)">Add spintax</a>
            {{-- <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addTargetModal">Add a target</a> --}}
            <div class="row">
                <!-- ============================================================== -->
                <!-- data table  -->
                <!-- ============================================================== -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Spintax collections of "<strong><a href="{{ route('target.index') }}">{{ $spintaxInput->target }}</a></strong>"</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Target</th>
                                            <th>Spintax</th>
                                            <th>Created at</th>
                                            <th>Updated at</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($spintaxCollections as $sc)
                                        <tr>
                                            <td>{{ $spintaxInput->target }}</td>
                                            <td>{{ $sc->spintax }}</td>
                                            <td>{{ Carbon\Carbon::parse($sc->created_at)->format('d/m/Y h:m') }}</td>
                                            <td>{{ Carbon\Carbon::parse($sc->updated_at)->format('d/m/Y h:m') }}</td>
                                            <td>
                                                <div class="btn-group ml-auto">
                                                    <a
                                                        href="#"
                                                        class="btn btn-sm btn-outline-light"
                                                        onclick="showEditSpintaxDialog({{ $sc->id }}, '{{ "$spintaxInput->target" }}').apply(this, arguments)"
                                                    >
                                                        Edit
                                                    </a>
                                                    <a
                                                        href="#"
                                                        class="btn btn-sm btn-outline-light"
                                                        onclick="showDeleteSpintaxDialog({{ $sc->id }}, '{{ "$sc->spintax" }}').apply(this, arguments)"
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

    @include('dialogs.spintax.create-edit')
    @include('dialogs.spintax.delete')
@endsection

@section('js')
    @include('dialogs.spintax.create-edit-js')
    @include('dialogs.spintax.delete-js')

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

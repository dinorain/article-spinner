<div class="modal fade" id="upload-excel-dialog" tabindex="-1" role="dialog" aria-labelledby="uplaodExcelModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uplaodExcelModalLabel">Upload synonyms for <strong>"<span id="upload-excel-nickname"></span>"</strong></h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <form
                id="upload-excel-form"
                method="POST"
                action=""
                enctype="multipart/form-data"
                data-parsley-validate
            >
                @csrf
                <div class="modal-body">

                    <div class="form-group row">
                        <label for="target" class="col-sm-3 col-form-label">Upload Excel</label>
                        <div class="col-sm-9">
                            <input
                                class="form-control"
                                type="file"
                                id="excelFile"
                                name="excelFile"
                                accept=".xlsx,.xls"
                                value=""
                                data-parsley-required
                            >
                        </div>
                        {{-- <small class="ml-3 mt-3">Your file size must not exceed 5MB.</small> --}}
                    </div>

                </div>
                <div class="modal-footer">
                    <a href="/raws/spintax-target-synonyms-template.xlsx" class="btn btn-secondary" download>Download template</a>
                    <button type="submit" class="btn btn-primary">Upload</a>
                </div>
            </form>
        </div>
    </div>
</div>

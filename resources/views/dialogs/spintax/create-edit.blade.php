<div class="modal fade" id="create-edit-spintax-dialog" tabindex="-1" role="dialog" aria-labelledby="createEditSargetModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createEditSpintaxModalLabel">Add Spintax</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <form
                id="create-edit-spintax-form"
                method="POST"
                action="{{ route('spintax.store') }}"
                enctype="multipart/form-data"
                data-parsley-validate
            >
                @csrf
                <div class="modal-body">

                    <input
                        id="id"
                        name="id"
                        type="hidden"
                        value=""
                    />
                    <input
                        id="target_id"
                        name="target_id"
                        type="hidden"
                        value="{{ $spintaxInput->id }}"
                    />

                    <div class="form-group row">
                      <label for="spintax" class="col-sm-3 col-form-label">Input spintax</label>
                      <div class="col-sm-9">
                        <input
                            id="spintax"
                            name="spintax"
                            type="text"
                            class="form-control"
                            value=""
                            data-parsley-required
                        />
                      </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-primary">Submit</a>
                </div>
            </form>
        </div>
    </div>
</div>

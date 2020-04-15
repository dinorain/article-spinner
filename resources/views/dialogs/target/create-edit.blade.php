<div class="modal fade" id="create-edit-target-dialog" tabindex="-1" role="dialog" aria-labelledby="createEditTargetModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createEditTargetModalLabel">Add Target</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <form
                id="create-edit-target-form"
                method="POST"
                action="{{ route('target.store') }}"
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

                    <div class="form-group row">
                      <label for="target" class="col-sm-3 col-form-label">Input target</label>
                      <div class="col-sm-9">
                        <input
                            id="target"
                            name="target"
                            type="text"
                            class="form-control"
                            value=""
                            data-parsley-required
                            autofocus
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

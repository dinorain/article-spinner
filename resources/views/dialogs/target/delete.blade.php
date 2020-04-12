<div class="modal fade" id="delete-target-dialog" tabindex="-1" role="dialog" aria-labelledby="deleteTargetModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteTargetModalLabel">Delete Target</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">
                <form
                    id="delete-target-form"
                    method="POST"
                    action=""
                >
                    @csrf
                    @method('DELETE')

                    <div class="form-group row">
                        <div class="col-sm-9">
                            Delete target <strong>"<span id="nickname"></span>"</strong> ?
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                <button type="submit" class="btn btn-primary">Delete</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete-spintax-dialog" tabindex="-1" role="dialog" aria-labelledby="deleteSpintaxModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteSpintaxModalLabel">Delete Spintax</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <form
                id="delete-spintax-form"
                method="POST"
                action=""
            >
                @csrf
                @method('DELETE')
                <div class="modal-body">

                    <div class="form-group row">
                        <div class="col-sm-9">
                            Delete spintax <strong>"<span id="nickname"></span>"</strong> ?
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-primary">Delete</a>
                </div>
            </form>
        </div>
    </div>
</div>

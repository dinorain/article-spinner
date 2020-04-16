<script>
    {
        const $dialog = $('#create-edit-target-dialog');
        const $form = $('#create-edit-target-form');
        const $id = $form.find('#id');
        const $target = $form.find('#target');

        window.showCreateTargetDialog = (e) => {
            e.preventDefault();
            $form.trigger('reset');
            $form.attr('action', '{{ route('target.store') }}')
            $errorOccured.toggleClass("filled", false);
            $dialog.modal('show');
        }

        window.showEditTargetDialog = (id) => async (e) => {
            e.preventDefault();
            try {
                const response = (await rootApi.get(`/openSesame/targets/${id}`)).data;
                $id.val(response.id);
                $target.val(response.target);
                $form.attr('action', `/openSesame/targets/${id}`);
                $errorOccured.toggleClass("filled", false);
                $dialog.modal('show');
            } catch (error) {
                console.log(error);
                toastr.error("Please try again", "Error");
            }
        }

        const $errorOccured = $('#error_occured');

        window.Parsley.on('form:submit', function() {

            if ($target.val().indexOf(' ') >= 0) {
                $errorOccured.toggleClass("filled", true);
                return false;
            }
            else
            {
                $errorOccured.toggleClass("filled", false);
                return true;
            }
        });
    }
</script>

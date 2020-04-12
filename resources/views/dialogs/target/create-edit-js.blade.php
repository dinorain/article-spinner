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
            $dialog.modal('show');
        }

        window.showEditTargetDialog = (id) => async (e) => {
            e.preventDefault();
            try {
                // const response = (await rootApi.get(`/targets/${id}`)).data;
                // $id.val(response.id);
                // $target.val(response.target);
                $form.attr('action', `/targets/${id}`);
                $dialog.modal('show');
            } catch (error) {
                toastr.error("Please try again", "Error");
            }
        }
    }
</script>

<script>
    {
        const $dialog = $('#create-edit-spintax-dialog');
        const $form = $('#create-edit-spintax-form');
        const $id = $form.find('#id');
        const $spintax = $form.find('#spintax');

        window.showCreateSpintaxDialog = (e) => {
            e.preventDefault();
            $form.trigger('reset');
            $form.attr('action', '{{ route('spintax.store') }}')
            $dialog.modal('show');
        }

        window.showEditSpintaxDialog = (id) => async (e) => {
            e.preventDefault();
            try {

                $dialog.modal('show');
            } catch (error) {
                console.log(error);
                toastr.error("Please try again", "Error");
            }
        }
    }
</script>

<script>
    {
        const $dialog = $('#delete-spintax-dialog');
        const $form = $('#delete-spintax-form');
        const $id = $form.find('#id');
        const $nickname = $form.find('#nickname');

        window.showDeleteSpintaxDialog = (id, nickname) => (e) => {
            e.preventDefault();
            $form.attr('action', "{{ route('spintax.destroy', '')}}" + "/" + id);
            $nickname.text(nickname);
            $dialog.modal('show');
        }

    }
</script>

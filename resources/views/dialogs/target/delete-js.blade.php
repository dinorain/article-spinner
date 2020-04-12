<script>
    {
        const $dialog = $('#delete-target-dialog');
        const $form = $('#delete-target-form');
        const $id = $form.find('#id');
        const $nickname = $form.find('#nickname');

        window.showDeleteTargetDialog = (id, nickname) => (e) => {
            e.preventDefault();
            $form.attr('action', "{{ route('target.destroy', '')}}" + "/" + id);
            $nickname.text(nickname);
            $dialog.modal('show');
        }

    }
</script>

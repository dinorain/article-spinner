<script>
    {
        const $dialog = $('#delete-spintax-dialog');
        const $form = $('#delete-spintax-form');
        const $target_id = $form.find('#target_id');
        const $id = $form.find('#id');
        const $nickname = $form.find('#nickname');

        window.showDeleteSpintaxDialog = (id, nickname) => (e) => {
            e.preventDefault();
            $form.attr('action', `/openSesame/targets/${$target_id.val()}/spintax/${id}`);
            $nickname.text(nickname);
            $dialog.modal('show');
        }

    }
</script>

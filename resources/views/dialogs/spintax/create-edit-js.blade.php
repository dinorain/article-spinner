<script>
    {
        const $dialog = $('#create-edit-spintax-dialog');
        const $form = $('#create-edit-spintax-form');
        const $target_id = $form.find('#target_id');
        const $id = $form.find('#id');
        const $spintax = $form.find('#spintax');
        const $nickname = $('#nickname');


        window.showCreateSpintaxDialog = (nickname) => (e) => {
            e.preventDefault();
            $form.trigger('reset');
            $nickname.text(nickname);
            $form.attr('action', `/openSesame/targets/${$target_id.val()}/spintax`);
            $dialog.modal('show');
        }

        window.showEditSpintaxDialog = (id, nickname) => async (e) => {
            e.preventDefault();
            try {
                $nickname.text(nickname);
                const response = (await rootApi.get(`/openSesame/targets/${$target_id.val()}/spintax/${id}`)).data;
                $id.val(response.id);
                $spintax.val(response.spintax);
                $form.attr('action', `/openSesame/targets/${$target_id.val()}/spintax/${id}`);
                $dialog.modal('show');
            } catch (error) {
                console.log(error);
                toastr.error("Please try again", "Error");
            }
        }
    }
</script>

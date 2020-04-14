<script>
    {
        const $dialog = $('#upload-excel-dialog');
        const $form = $('#upload-excel-form');
        const $nickname = $('#upload-excel-nickname');

        window.showUploadSpintaxCollectionsExcelDialog = (target_id, nickname) => (e) => {
            e.preventDefault();
            $nickname.text(nickname);
            $form.trigger('reset');
            $form.attr('action', `/openSesame/targets/${target_id}/spintax/synonyms/excel`);
            $dialog.modal('show');
        }

    }
</script>

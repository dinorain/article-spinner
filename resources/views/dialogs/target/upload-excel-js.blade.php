<script>
    {
        const $dialog = $('#upload-excel-dialog');
        const $form = $('#upload-excel-form');

        window.showUploadTargetsExcelDialog = (e) => {
            e.preventDefault();
            $form.trigger('reset');
            $form.attr('action', '{{ route('target.excel.upload') }}');
            $dialog.modal('show');
        }

    }
</script>

<dialog id="dialogConfirmDeleteProduct" class="mdl-dialog" style="width: 480px;">
    <div class="mdl-dialog__content">
        <p>Hãy chắc chắn bạn muốn xóa thông tin sản phẩm này.</p>
    </div>
    <div class="mdl-dialog__actions">
        <button type="submit" class="mdl-button mdl-js-button delete">Xóa</button>
        <button type="button" class="mdl-button mdl-js-button close">Hủy</button>
    </div>
</dialog>
<script>
    {
        "use strict";

        var dialog = document.getElementById('dialogConfirmDeleteProduct');
        var buttons = document.querySelectorAll('.delete-product');

        if (! dialog.showModal) {
            dialogPolyfill.registerDialog(dialog);
        }

        for (button of buttons) {
            button.addEventListener('click', function(event) {
                var formId = this.dataset.formId;

                dialog.querySelector('.delete').setAttribute('form', formId);
                dialog.showModal();
            });
        }

        dialog.querySelector('.close').addEventListener('click', function() {
            dialog.close();
        });
    }
</script>
<dialog id="dialogTutorialExportCode" class="mdl-dialog" style="width: 480px; max-width: 90%">
    <div class="mdl-dialog__content">Bạn đã liên kết sản phẩm cho lô tem thành công, để xuất mã hãy click <i class="material-icons" id="tooltipExport{{ $batch->id }}">import_export</i> hoặc nhấn tiếp tục</div>
    <div class="mdl-dialog__actions">
        <button type="button" class="mdl-button mdl-js-button continue">Tiếp tục</button>
        <button type="button" class="mdl-button mdl-js-button close">Đóng</button>
    </div>
</dialog>
<script>
    {
        "use strict"

        var dialog = document.getElementById('dialogTutorialExportCode');

        if (! dialog.showModal) {
            dialogPolyfill.registerDialog(dialog);
        }

        window.addEventListener('load', function (event) {
            setTimeout(function(){
                dialog.showModal();
            }, 100);
        });

        dialog.querySelector('.continue').addEventListener('click', function() {
            dialogExport.showModal();
            dialog.close();
        });

        dialog.querySelector('.close').addEventListener('click', function() {
            dialog.close();
        });
    }
</script>
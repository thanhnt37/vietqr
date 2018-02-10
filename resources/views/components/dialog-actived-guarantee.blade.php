<dialog id="dialogActiveGuarantee" class="mdl-dialog" style="width: 480px; max-width: 90%">
    <div class="mdl-dialog__content">Sản phẩm đã được kích hoạt bảo hành từ ngày {{ $gactive->getActiveDate() }}, và được bảo hành tới ngày {{ $gactive->getExpireDate() }}</div>
    <div class="mdl-dialog__actions">
        <button type="button" class="mdl-button mdl-js-button close">Đóng</button>
    </div>
</dialog>
<script>
    {
        "use strict"

        var dialog = document.getElementById('dialogActiveGuarantee');

        if (! dialog.showModal) {
            dialogPolyfill.registerDialog(dialog);
        }

        window.addEventListener('load', function (event) {
            setTimeout(function(){
                dialog.showModal();
            }, 100);
        });

        dialog.querySelector('.close').addEventListener('click', function() {
            dialog.close();
        });
    }
</script>
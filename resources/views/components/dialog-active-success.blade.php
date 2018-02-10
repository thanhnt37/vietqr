<dialog id="dialogActiveSuccess" class="mdl-dialog" style="width: 480px; max-width: 90%">
    <div class="mdl-dialog__content">{{ session('message') }}</div>
    <div class="mdl-dialog__actions">
        <button type="button" class="mdl-button mdl-js-button close">Tiếp tục</button>
    </div>
</dialog>
<script>
    {
        "use strict"

        var dialog = document.getElementById('dialogActiveSuccess');

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
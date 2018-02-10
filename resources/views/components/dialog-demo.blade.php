<style>
    #dialogDemoCode {
        height: 100vh;
        box-sizing: border-box;
        padding: 0;
    }
    #dialogDemoCode iframe {
        width: 100%;
        height: 100%;
    }
    #dialogDemoCode .mdl-button--fab {
        width: 2rem;
        height: 2rem;
        min-width: 2rem;
    }
</style>
<dialog id="dialogDemoCode" class="mdl-dialog" style="width: 480px;">
    <iframe src="" frameborder="0"></iframe>
    <div class="mdl-card__menu">
        <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored close">
            <i class="material-icons">clear</i>
        </button>
    </div>
</dialog>
<script>
    {
        "use strict";

        var dialog = document.getElementById('dialogDemoCode');
        var buttons = document.querySelectorAll('.show-demo');

        if (! dialog.showModal) {
            dialogPolyfill.registerDialog(dialog);
        }

        for (button of buttons) {
            button.addEventListener('click', function(event) {
                var id = this.dataset.code;

                dialog.querySelector('iframe').src = `{{ url('view') }}/${id}`;
                dialog.showModal();
            });
        }

        dialog.querySelector('.close').addEventListener('click', function() {
            dialog.close();
        });
    }
</script>
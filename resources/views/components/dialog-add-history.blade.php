<dialog id="dialogAddHistory" class="mdl-dialog" style="width: 690px;">
    <div class="mdl-dialog__content">
        <form id="formAddCode" action="{{ route('guarantee.code.history', ['code' => $code->id]) }}" method="post">
            {{ csrf_field() }}
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                <textarea class="mdl-textfield__input" name="description" rows="9" id="inputDescription" placeholder="Chi tiết bảo hành"></textarea>
            </div>
        </form>
    </div>
    <div class="mdl-dialog__actions">
        <button type="submit" form="formAddCode" class="mdl-button mdl-js-button">Thêm</button>
        <button type="button" class="mdl-button mdl-js-button close">Hủy</button>
    </div>
</dialog>
<script>
    "use strict";
    {
        var dialog = document.getElementById('dialogAddHistory');
        var button = document.querySelector('#showModalAddHistory');

        if (! dialog.showModal) {
            dialogPolyfill.registerDialog(dialog);
        }

        button.addEventListener('click', function() {
            dialog.showModal();
        });

        dialog.querySelector('.close').addEventListener('click', function() {
            dialog.close();
        });
    }
</script>
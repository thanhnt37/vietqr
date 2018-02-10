<dialog id="dialogUpdateCover" class="mdl-dialog" style="width: 480px;">
    <div class="mdl-dialog__content">
        <form id="formUpdateBusinessCover" action="{{ route('guarantee.update') }}" enctype="multipart/form-data" method="post">
            {{ csrf_field() }}
            {{ method_field('put') }}
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                <input class="mdl-textfield__input" type="file" name="cover" accept="image/*">
                <span class="mdl-textfield__error">Ảnh không hợp lệ.</span>
            </div>
        </form>
    </div>
    <div class="mdl-dialog__actions">
        <button type="submit" form="formUpdateBusinessCover" class="mdl-button mdl-js-button">Cập nhật</button>
        <button type="button" class="mdl-button mdl-js-button close">Hủy</button>
    </div>
</dialog>
<script>
    var dialog = document.getElementById('dialogUpdateCover');
    var showModalButton = document.querySelector('#showModalUpdateCover');

    if (! dialog.showModal) {
        dialogPolyfill.registerDialog(dialogAddCode);
    }

    showModalButton.addEventListener('click', function() {
        dialog.showModal();
    });

    dialog.querySelector('.close').addEventListener('click', function() {
        dialog.close();
    });
</script>
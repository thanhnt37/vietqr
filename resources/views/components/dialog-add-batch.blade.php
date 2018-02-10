<dialog id="dialogAddCode" class="mdl-dialog" style="width: 480px;">
    <div class="mdl-dialog__content">
        <form id="formAddCode" action="{{ route('guarantee.batch.create') }}" method="post">
            {{ csrf_field() }}
            <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--3-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="text" name="quantity" value="10" pattern="^[0-9]+$" required id="inputQuantity">
                        <label class="mdl-textfield__label" for="inputQuantity">Số lượng</label>
                        <span class="mdl-textfield__error">Số lượng không để trống.</span>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--9-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="text" name="name" value="Lô x" pattern=".{3,}" required id="inputName">
                        <label class="mdl-textfield__label" for="inputName">Tên lô</label>
                        <span class="mdl-textfield__error">Tên không để trống, ít nhất 3 ký tự.</span>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--6-col">
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
                        <input type="radio" id="option-1" class="mdl-radio__button" name="service" value="1" checked>
                        <span class="mdl-radio__label">Bảo hành</span>
                    </label>
                </div>
                <div class="mdl-cell mdl-cell--6-col">
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
                        <input type="radio" id="option-2" class="mdl-radio__button" name="service" value="2">
                        <span class="mdl-radio__label">Chống giả</span>
                    </label>
                </div>
            </div>
        </form>
    </div>
    <div class="mdl-dialog__actions">
        <button type="submit" form="formAddCode" class="mdl-button mdl-js-button">Thêm</button>
        <button type="button" class="mdl-button mdl-js-button close">Hủy</button>
    </div>
</dialog>
<script>
    var dialogAddCode = document.getElementById('dialogAddCode');
    var showModalButton = document.querySelector('#showModalAddCode');

    if (! dialogAddCode.showModal) {
        dialogPolyfill.registerDialog(dialogAddCode);
    }

    showModalButton.addEventListener('click', function() {
        dialogAddCode.showModal();
    });

    dialogAddCode.querySelector('.close').addEventListener('click', function() {
        dialogAddCode.close();
    });
</script>
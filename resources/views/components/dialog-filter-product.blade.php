<dialog id="dialogFilterProduct" class="mdl-dialog" style="width: 480px;">
    <div class="mdl-dialog__content">
        <form id="formFilterProduct" action="" method="get">
            <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--6-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="text" name="id" value="{{ request()->has('id') ? request()->query('id') : '' }}" pattern="[0-9]{1,}" id="inputID">
                        <label class="mdl-textfield__label" for="inputID">ID</label>
                        <span class="mdl-textfield__error">ID không hợp lệ.</span>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--6-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="text" name="gtin" value="{{ request()->has('gtin') ? request()->query('gtin') : '' }}" pattern="[0-9]{8,}" id="inputGTIN">
                        <label class="mdl-textfield__label" for="inputGTIN">Mã GTIN</label>
                        <span class="mdl-textfield__error">Mã gtin không hợp lệ.</span>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--12-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="text" name="name" value="{{ request()->has('name') ? request()->query('name') : '' }}" pattern=".{3,}" id="inputName">
                        <label class="mdl-textfield__label" for="inputName">Tên sản phẩm</label>
                        <span class="mdl-textfield__error">Tên không để trống, ít nhất 3 ký tự.</span>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="mdl-dialog__actions">
        <button type="submit" form="formFilterProduct" class="mdl-button mdl-js-button">Lọc</button>
        <button id="buttonClearFilter" type="button" class="mdl-button mdl-js-button">Hủy</button>
        <button type="button" class="mdl-button mdl-js-button close">Đóng</button>
    </div>
</dialog>
<script>
    "use strict";
    {
        var dialogFilter = document.getElementById('dialogFilterProduct');
        var showFilter = document.getElementById('showFilterProduct');

        if (! dialogFilter.showModal) {
            dialogPolyfill.registerDialog(dialogFilter);
        }

        showFilter.addEventListener('click', function() {
            dialogFilter.showModal();
        });

        dialogFilter.querySelector('.close').addEventListener('click', function() {
            dialogFilter.close();
        });

        document.getElementById('buttonClearFilter').addEventListener('click', function (event) {
             location.replace(location.pathname);
        });
    }
</script>
<dialog id="dialogFilterCustomer" class="mdl-dialog" style="width: 480px;">
    <div class="mdl-dialog__content">
        <form id="formFilterCustomer" action="" method="get">
            <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--6-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="text" name="name" value="{{ request()->has('name') ? request()->query('name') : '' }}" pattern=".{3,}" id="inputName">
                        <label class="mdl-textfield__label" for="inputName">Tên khách hàng</label>
                        <span class="mdl-textfield__error">Tên không hợp lệ.</span>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--6-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="text" name="phone" value="{{ request()->has('phone') ? request()->query('phone') : '' }}" pattern="(0|84)[0-9]{9,10}" id="inputPhone">
                        <label class="mdl-textfield__label" for="inputPhone">Số điện thoại</label>
                        <span class="mdl-textfield__error">Số điện thoại không hợp lệ.</span>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--6-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="email" name="email" value="{{ request()->has('email') ? request()->query('email') : '' }}" id="inputEmail">
                        <label class="mdl-textfield__label" for="inputEmail">Email</label>
                        <span class="mdl-textfield__error">Địa chỉ email không hợp lệ.</span>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--6-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="text" name="address" value="{{ request()->has('address') ? request()->query('address') : '' }}" pattern=".{3,}" id="inputAddress">
                        <label class="mdl-textfield__label" for="inputAddress">Địa chỉ</label>
                        <span class="mdl-textfield__error">Địa chỉ không hợp lệ.</span>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="mdl-dialog__actions">
        <button type="submit" form="formFilterCustomer" class="mdl-button mdl-js-button">Lọc</button>
        <button id="buttonClearFilter" type="button" class="mdl-button mdl-js-button">Hủy</button>
        <button type="button" class="mdl-button mdl-js-button close">Đóng</button>
    </div>
</dialog>
<script>
    "use strict";
    {
        var dialogFilter = document.getElementById('dialogFilterCustomer');
        var showFilter = document.getElementById('showFilterCustomer');

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
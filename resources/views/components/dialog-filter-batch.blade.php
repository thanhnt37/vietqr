<dialog id="dialogFilterCode" class="mdl-dialog" style="width: 480px;">
    <div class="mdl-dialog__content">
        <form id="formFilterCode" action="" method="get">
            <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--4-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="text" name="id" value="{{ request()->has('id') ? request('id') : '' }}" pattern="[0-9]{1,}" id="inputID">
                        <label class="mdl-textfield__label" for="inputID">ID</label>
                        <span class="mdl-textfield__error">ID không hợp lệ.</span>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--8-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="text" name="name" value="{{ request()->has('name') ? request('name') : '' }}" pattern=".{3,}" id="inputName">
                        <label class="mdl-textfield__label" for="inputName">Tên lô mã</label>
                        <span class="mdl-textfield__error">Tên không để trống, ít nhất 3 ký tự.</span>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--4-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="text" name="quantity" value="{{ request()->has('quantity') ? request('quantity') : '' }}" pattern="^(>|>=|<|<=|=)?[0-9]{1,}$" id="inputQuantity">
                        <label class="mdl-textfield__label" for="inputQuantity">Số lượng</label>
                        <span class="mdl-textfield__error">Số lượng không hợp lệ.</span>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--8-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <select class="mdl-textfield__input" name="product" id="selectProduct">
                            <option value="all">All</option>
                        </select>
                        <label class="mdl-textfield__label" for="selectProduct">Sản phẩm bảo hành</label>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--6-col">
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="radioCodeGenerated">
                        <input type="radio" id="radioCodeGenerated" class="mdl-radio__button" name="generated" value="1" {{ request('generated') == '1' ? 'checked' : '' }}>
                        <span class="mdl-radio__label">Đã tạo mã</span>
                    </label>
                </div>
                <div class="mdl-cell mdl-cell--6-col">
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="radioCodeNotGenerated">
                        <input type="radio" id="radioCodeNotGenerated" class="mdl-radio__button" name="generated" value="0" {{ request('generated') == '0' ? 'checked' : '' }}>
                        <span class="mdl-radio__label line-clamp--one-line">Chưa tạo mã</span>
                    </label>
                </div>
                <div class="mdl-cell mdl-cell--4-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="text" name="start_date" pattern="^[0-9]{2}\/[0-9]{2}\/[0-9]{4,}" id="inputStartDate" placeholder="dd/mm/YYYY">
                        <label class="mdl-textfield__label" for="inputStartDate">Từ</label>
                        <span class="mdl-textfield__error">Định đạng ngày không hợp lệ.</span>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--4-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="text" name="start_date" pattern="^[0-9]{2}\/[0-9]{2}\/[0-9]{4,}" id="inputEndDate" placeholder="dd/mm/YYYY">
                        <label class="mdl-textfield__label" for="inputEndDate">Đến</label>
                        <span class="mdl-textfield__error">Định đạng ngày không hợp lệ.</span>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="mdl-dialog__actions">
        <button type="submit" form="formFilterCode" class="mdl-button mdl-js-button">Lọc</button>
        <button id="buttonClearFilter" type="button" class="mdl-button mdl-js-button">Hủy</button>
        <button type="button" class="mdl-button mdl-js-button close">Hủy</button>
    </div>
</dialog>
<script>
    "use strict";
    {
        var dialogFilter = document.getElementById('dialogFilterCode');
        var showFilter = document.getElementById('showFilterCode');

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
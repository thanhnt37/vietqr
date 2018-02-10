<dialog id="dialogFilterAgency" class="mdl-dialog" style="width: 480px;">
    <div class="mdl-dialog__content">
        <form id="formFilterAgency" action="#" method="get">
            <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--4-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="text" name="id" value="{{ request()->has('id') ? request()->query('id') : '' }}" pattern="[0-9]{1,}" id="inputID">
                        <label class="mdl-textfield__label" for="inputID">ID</label>
                        <span class="mdl-textfield__error">ID không hợp lệ.</span>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--8-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="text" name="name" value="{{ request()->has('name') ? request()->query('name') : '' }}" pattern=".{3,}" id="inputName">
                        <label class="mdl-textfield__label" for="inputName">Tên điểm bảo hành</label>
                        <span class="mdl-textfield__error">Tên không để trống, ít nhất 3 ký tự.</span>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--12-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="text" name="address" value="{{ request()->has('address') ? request()->query('address') : '' }}" pattern=".{3,}" id="inputAddress">
                        <label class="mdl-textfield__label" for="inputAddress">Địa chỉ</label>
                        <span class="mdl-textfield__error">Mã gtin không hợp lệ.</span>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--4-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="text" name="start_date" value="{{ request()->has('start_date') ? request()->query('start_date') : '' }}" pattern="^[0-9]{2}\/[0-9]{2}\/[0-9]{4,}" id="inputStartDate" placeholder="dd/mm/yyyy">
                        <label class="mdl-textfield__label" for="inputStartDate">Từ</label>
                        <span class="mdl-textfield__error">Định đạng ngày không hợp lệ.</span>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--4-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="text" name="start_date" value="{{ request()->has('end_date') ? request()->query('end_date') : '' }}" pattern="^[0-9]{2}\/[0-9]{2}\/[0-9]{4,}" id="inputEndDate" placeholder="dd/mm/yyyy">
                        <label class="mdl-textfield__label" for="inputEndDate">Đến</label>
                        <span class="mdl-textfield__error">Định đạng ngày không hợp lệ.</span>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="mdl-dialog__actions">
        <button type="submit" form="formFilterAgency" class="mdl-button mdl-js-button">Lọc</button>
        <button id="buttonClearFilter" type="button" class="mdl-button mdl-js-button">Hủy</button>
        <button type="button" class="mdl-button mdl-js-button close">Đóng</button>
    </div>
</dialog>
<script>
    "use strict";
    {
        var dialogFilter = document.getElementById('dialogFilterAgency');
        var showFilter = document.getElementById('showFilterAgency');

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
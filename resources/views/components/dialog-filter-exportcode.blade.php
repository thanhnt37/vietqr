<dialog id="dialogFilterCode" class="mdl-dialog" style="width: 480px;">
    <div class="mdl-dialog__content">
        <form id="formFilterCode" action="" method="get">
            <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--4-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <select class="mdl-textfield__input" name="type" id="selectType">
                            <option value="csv">CSV</option>
                        </select>
                        <label class="mdl-textfield__label" for="selectType">Định dạng</label>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--8-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="text" name="title" value="{{ request()->has('title') ? request('title') : '' }}" pattern=".{3,}" id="inputTitle">
                        <label class="mdl-textfield__label" for="inputTitle">Tiêu đề</label>
                        <span class="mdl-textfield__error">Tiêu đề không để trống, ít nhất 3 ký tự.</span>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--6-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="text" name="start_date" value="{{ request()->has('start_date') ? request('start_date') : '' }}" pattern="^[0-9]{2}\/[0-9]{2}\/[0-9]{4,}" id="inputStartDate" placeholder="dd/mm/YYYY">
                        <label class="mdl-textfield__label" for="inputStartDate">Từ</label>
                        <span class="mdl-textfield__error">Định đạng ngày không hợp lệ.</span>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--6-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="text" name="end_date" value="{{ request()->has('end_date') ? request('end_date') : '' }}" pattern="^[0-9]{2}\/[0-9]{2}\/[0-9]{4,}" id="inputEndDate" placeholder="dd/mm/YYYY">
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
        <button type="button" class="mdl-button mdl-js-button close">Đóng</button>
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
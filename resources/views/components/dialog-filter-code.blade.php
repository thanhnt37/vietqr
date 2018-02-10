<style>
    .line-clamp--one-line {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
<dialog id="dialogFilterCode" class="mdl-dialog" style="width: 520px;">
    <div class="mdl-dialog__content">
        <form id="formFilterCode" action="" method="get">
            <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--4-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="text" name="id" value="{{ request()->has('id') ? request()->query('id') : '' }}" pattern="[0-9]{1,}" id="inputID">
                        <label class="mdl-textfield__label" for="inputID">ID</label>
                        <span class="mdl-textfield__error">ID không hợp lệ.</span>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--4-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="text" name="code" value="{{ request()->has('code') ? request()->query('code') : '' }}" pattern=".{3,}" id="inputCode">
                        <label class="mdl-textfield__label" for="inputCode">Mã bảo hành</label>
                        <span class="mdl-textfield__error">Mã không hợp lệ.</span>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--4-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="text" name="sms" value="{{ request()->has('sms') ? request()->query('sms') : '' }}" pattern=".{3,}" id="inputSMS">
                        <label class="mdl-textfield__label" for="inputSMS">Mã tin nhắn</label>
                        <span class="mdl-textfield__error">Mã không hợp lệ.</span>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--12-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <select class="mdl-textfield__input" name="batch" id="selectBatch">
                            <option value="all">All</option>
                            @foreach($batches as $batch)
                                <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                            @endforeach
                        </select>
                        <label class="mdl-textfield__label" for="selectBatch">Lô bảo hành</label>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--12-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <select class="mdl-textfield__input" name="product" id="selectProduct">
                            <option value="all">All</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                        <label class="mdl-textfield__label" for="selectProduct">Sản phẩm bảo hành</label>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--6-col">
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="radioCodeActivated">
                        <input type="radio" id="radioCodeActivated" class="mdl-radio__button" name="active" value="1" {{ request('active') == '1' ? 'checked' : '' }}>
                        <span class="mdl-radio__label">Đã kích hoạt mã</span>
                    </label>
                </div>
                <div class="mdl-cell mdl-cell--6-col">
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="radioCodeNotActivated">
                        <input type="radio" id="radioCodeNotActivated" class="mdl-radio__button" name="active" value="0" {{ request('active') == '0' ? 'checked' : '' }}>
                        <span class="mdl-radio__label line-clamp--one-line">Chưa kích hoạt mã</span>
                    </label>
                </div>
                <div class="mdl-cell mdl-cell--6-col">
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="radioGCodeActivated">
                        <input type="radio" id="radioGCodeActivated" class="mdl-radio__button" name="gactive" value="1" {{ request('gactive') == '1' ? 'checked' : '' }}>
                        <span class="mdl-radio__label line-clamp--one-line">Đã kích hoạt bảo hành</span>
                    </label>
                </div>
                <div class="mdl-cell mdl-cell--6-col">
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="radioGCodeNotActivated">
                        <input type="radio" id="radioGCodeNotActivated" class="mdl-radio__button" name="gactive" value="0" {{ request('gactive') == '0' ? 'checked' : '' }}>
                        <span class="mdl-radio__label line-clamp--one-line">Chưa kích hoạt bảo hành</span>
                    </label>
                </div>
                <div class="mdl-cell mdl-cell--4-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="text" name="start_date" value="{{ request()->has('start_date') ? request()->query('start_date') : '' }}" pattern="^[0-9]{2}\/[0-9]{2}\/[0-9]{4,}" id="inputStartDate" placeholder="dd/mm/YYYY">
                        <label class="mdl-textfield__label" for="inputStartDate">Từ</label>
                        <span class="mdl-textfield__error">Định đạng ngày không hợp lệ.</span>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--4-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="text" name="end_date" value="{{ request()->has('end_date') ? request()->query('end_date') : '' }}" pattern="^[0-9]{2}\/[0-9]{2}\/[0-9]{4,}" id="inputEndDate" placeholder="dd/mm/YYYY">
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
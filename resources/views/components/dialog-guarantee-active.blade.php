<dialog id="dialogGuaranteeActive" class="mdl-dialog" style="width: 480px;">
    <div class="mdl-dialog__content">
        <form id="formGuaranteeActive" action="{{ route('guarantee.active') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="code" value="{{ $code->id }}">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                <input class="mdl-textfield__input" type="number" name="guarantee_days" value="{{ $active ? $active->guarantee_days : $code->batch->guarantee_days }}" min="1" id="inputDay">
                <label class="mdl-textfield__label" for="inputName">Số ngày bảo hành *</label>
                <span class="mdl-textfield__error">Số ngày không hợp lệ.</span>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                <input class="mdl-textfield__input" type="text" name="name" value="{{ $active ? $active->name : '' }}" pattern=".{3,}" id="inputName">
                <label class="mdl-textfield__label" for="inputName">Tên khách hàng</label>
                <span class="mdl-textfield__error">Tên không để trống, ít nhất 3 ký tự.</span>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                <input class="mdl-textfield__input" type="text" name="phone" value="{{ $active ? $active->phone : '' }}" pattern="(0|84)[0-9]{9,10}" id="inputPhone">
                <label class="mdl-textfield__label" for="inputPhone">Số điện thoại</label>
                <span class="mdl-textfield__error">Số điện thoại không hợp lệ.</span>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                <input class="mdl-textfield__input" type="email" name="email" value="{{ $active ? $active->email : '' }}">
                <label class="mdl-textfield__label" for="inputEmail">Email</label>
                <span class="mdl-textfield__error">Email không hợp lệ.</span>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                <input class="mdl-textfield__input" type="text" name="address" value="{{ $active ? $active->address : '' }}" pattern=".{3,}" id="inputAddress">
                <label class="mdl-textfield__label" for="inputAddress">Địa chỉ</label>
                <span class="mdl-textfield__error">Tên không để trống, ít nhất 3 ký tự.</span>
            </div>
        </form>
    </div>
    <div class="mdl-dialog__actions">
        <button type="submit" form="formGuaranteeActive" class="mdl-button mdl-js-button">{{ $active ? 'Cập nhật' : 'Kích hoạt' }}</button>
        <button type="button" class="mdl-button mdl-js-button close">Hủy</button>
    </div>
</dialog>
<script>
    {
        "use strict";

        var dialoga = document.getElementById('dialogGuaranteeActive');
        var showModalButton = document.querySelector('#showModalActive');

        if (! dialoga.showModal) {
            dialogPolyfill.registerDialog(dialoga);
        }

        showModalButton.addEventListener('click', function() {
            dialoga.showModal();
        });

        dialoga.querySelector('.close').addEventListener('click', function() {
            dialoga.close();
        });
    }
</script>
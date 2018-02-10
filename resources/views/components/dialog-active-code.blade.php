<style>
    #dialogActiveCode {
        padding: 0;
    }
    #dialogActiveCode .mdl-dialog__title {
        font-size: 1.6rem;
        line-height: 2.4rem;
        padding: 16px 16px 0;
        text-align: center;
    }
    #dialogActiveCode .mdl-dialog__content {
        padding: 16px;
    }
</style>
<dialog id="dialogActiveCode" class="mdl-dialog" style="width: 480px; max-width: 90%">
    <div class="mdl-dialog__title">Xác thực thông tin bảo hành</div>
    <div class="mdl-dialog__content">
        <form id="formActiveCode" action="{{ route('guarantee.user-active') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="code" value="{{ $codeId }}">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                <input class="mdl-textfield__input" type="text" name="name" pattern=".{3,}" required id="inputName">
                <label class="mdl-textfield__label" for="inputName">Tên bạn *</label>
                <span class="mdl-textfield__error">Tên không hợp lệ.</span>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                <input class="mdl-textfield__input" type="text" name="address" pattern=".{3,}" required id="inputAddress">
                <label class="mdl-textfield__label" for="inputPhone">Địa chỉ *</label>
                <span class="mdl-textfield__error">Địa chỉ không hợp lệ.</span>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                <input class="mdl-textfield__input" type="text" name="phone" required pattern="^(0|84)[0-9]{9,10}$" id="inputPhone">
                <label class="mdl-textfield__label" for="inputPhone">Số điện thoại *</label>
                <span class="mdl-textfield__error">Số điện thoại không hợp lệ.</span>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                <input class="mdl-textfield__input" type="email" name="email" required id="inputEmail">
                <label class="mdl-textfield__label" for="inputPhone">Email *</label>
                <span class="mdl-textfield__error">Địa chỉ email không hợp lệ.</span>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                <select name="address_buy" class="mdl-textfield__input">
                    <option value="">Nơi mua sản phẩm</option>
                    @foreach($agencies as $agency)
                        <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
    <div class="mdl-dialog__actions">
        <button type="submit" form="formActiveCode" class="mdl-button mdl-js-button">Xác thực</button>
        <button type="button" class="mdl-button mdl-js-button close">Lúc khác</button>
    </div>
</dialog>
<script>
    {
        "use strict"

        var dialog = document.getElementById('dialogActiveCode');

        if (! dialog.showModal) {
            dialogPolyfill.registerDialog(dialog);
        }

        window.addEventListener('load', function (event) {
            setTimeout(function(){
                dialog.showModal();
            }, 100);
        });

        dialog.querySelector('.close').addEventListener('click', function() {
            dialog.close();
        });
    }
</script>
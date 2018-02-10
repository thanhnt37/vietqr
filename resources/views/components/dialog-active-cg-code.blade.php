<style>
    #dialogActiveCGCode {
        padding: 0;
    }
    #dialogActiveCGCode .mdl-dialog__title {
        font-size: 1.6rem;
        line-height: 2.4rem;
        padding: 16px 16px 0;
        text-align: center;
    }
    #dialogActiveCGCode .mdl-dialog__content {
        padding: 16px;
    }
</style>
<dialog id="dialogActiveCGCode" class="mdl-dialog" style="width: 480px; max-width: 90%">
    <div class="mdl-dialog__title">Nếu bạn mua sản phẩm, hãy nhập mã phủ cào và xác thực để đảm bảo quyền lợi của bạn</div>
    <div class="mdl-dialog__content">
        <form id="formActiveCGCode" action="{{ route('guarantee.user-active-cg') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="code" value="{{ $codeId }}">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                <input class="mdl-textfield__input" type="text" name="sms" pattern="{{ $sms }}" id="inputSms">
                <label class="mdl-textfield__label" for="inputSms">Mã phủ cào</label>
                <span class="mdl-textfield__error">Mã phủ cào không đúng.</span>
            </div>
        </form>
    </div>
    <div class="mdl-dialog__actions">
        <button type="submit" form="formActiveCGCode" class="mdl-button mdl-js-button">Xác thực</button>
        <button type="button" class="mdl-button mdl-js-button close">Lúc khác</button>
    </div>
</dialog>
<script>
    {
        "use strict"

        var dialog = document.getElementById('dialogActiveCGCode');

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
<dialog id="dialogUpdateProductForCode" class="mdl-dialog" style="width: 480px;">
    <div class="mdl-dialog__content">
        <form id="formUpdateProductForCode" action="{{ route('guarantee.code.update', ['code' => $code->id]) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('put') }}
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                <select class="mdl-textfield__input" name="product" id="selectProduct">
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
    <div class="mdl-dialog__actions">
        <a href="{{ route('guarantee.code.list') }}" class="mdl-button mdl-js-button">Tạo mới</a>
        <button type="submit" form="formUpdateProductForCode" class="mdl-button mdl-js-button">Cập nhật</button>
        <button type="button" class="mdl-button mdl-js-button close">Hủy</button>
    </div>
</dialog>
<script>
    var dialog = document.getElementById('dialogUpdateProductForCode');
    var showModalButton = document.querySelector('#showModalUpdateProductForCode');

    if (! dialog.showModal) {
        dialogPolyfill.registerDialog(dialog);
    }

    if (showModalButton != null) {
        showModalButton.addEventListener('click', function() {
            dialog.showModal();
        });
    }

    dialog.querySelector('.close').addEventListener('click', function() {
        dialog.close();
    });
</script>
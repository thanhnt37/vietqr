<dialog id="dialogAddProduct" class="mdl-dialog" style="width: 480px;">
    <div class="mdl-dialog__content">
        <form id="formAddProduct" action="{{ route('guarantee.product.insert', ['continue' => request()->query('continue')]) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--12-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="text" name="name" pattern=".{3,}" id="inputName">
                        <label class="mdl-textfield__label" for="inputName">Tên sản phẩm *</label>
                        <span class="mdl-textfield__error">Tên không để trống, ít nhất 3 ký tự.</span>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--6-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="text" name="gtin" pattern="[0-9]{8,}" id="inputGTIN">
                        <label class="mdl-textfield__label" for="inputGTIN">Mã vạch sản phẩm</label>
                        <span class="mdl-textfield__error">Mã không hợp lệ.</span>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--6-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="number" name="price" value="0" id="inputPrice">
                        <label class="mdl-textfield__label" for="inputPrice">Giá sản phẩm</label>
                        <span class="mdl-textfield__error">Giá sản phẩm không hợp lệ.</span>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--6-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width is-dirty">
                        <label for="inputImage">Ảnh sản phẩm</label>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--6-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width is-dirty">
                        <input class="mdl-textfield__input" type="file" name="image" accept="image/*" id="inputImage">
                        <span class="mdl-textfield__error">Ảnh không hợp lệ.</span>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="mdl-dialog__actions">
        <button type="submit" form="formAddProduct" class="mdl-button mdl-js-button">Thêm</button>
        <button type="button" class="mdl-button mdl-js-button close">Hủy</button>
    </div>
</dialog>
<script>
    var dialogAddProduct = document.getElementById('dialogAddProduct');
    var showModalButton = document.querySelector('#showModalAddProduct');

    if (! dialogAddProduct.showModal) {
        dialogPolyfill.registerDialog(dialogAddProduct);
    }

    showModalButton.addEventListener('click', function() {
        dialogAddProduct.showModal();
    });

    dialogAddProduct.querySelector('.close').addEventListener('click', function() {
        dialogAddProduct.close();
    });
</script>
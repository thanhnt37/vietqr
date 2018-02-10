<dialog id="dialogAddAgency" class="mdl-dialog" style="width: 480px;">
    <div class="mdl-dialog__content">
        <form id="formAddAgency" action="{{ route('guarantee.agency.insert') }}" method="post">
            {{ csrf_field() }}
            <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--12-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="text" name="name" pattern=".{3,}" id="inputName">
                        <label class="mdl-textfield__label" for="inputName">Tên điểm bán</label>
                        <span class="mdl-textfield__error">Tên không để trống, ít nhất 3 ký tự.</span>
                    </div>
                </div>
            </div>
            <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--8-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="text" name="address" pattern=".{3,}" id="inputAddress">
                        <label class="mdl-textfield__label" for="inputAddress">Địa chỉ</label>
                        <span class="mdl-textfield__error">Tên không để trống, ít nhất 3 ký tự.</span>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--4-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <select class="mdl-textfield__input" name="city" id="selectCity">
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                        <label class="mdl-textfield__label" for="selectCity">Thành phố</label>
                        <span class="mdl-textfield__error">Tên không để trống.</span>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="mdl-dialog__actions">
        <button type="submit" form="formAddAgency" class="mdl-button mdl-js-button">Thêm</button>
        <button type="button" class="mdl-button mdl-js-button close">Hủy</button>
    </div>
</dialog>
<script>
    var dialogAddAgency = document.getElementById('dialogAddAgency');
    var showModalButton = document.querySelector('#showModalAddAgency');

    if (! dialogAddAgency.showModal) {
        dialogPolyfill.registerDialog(dialogAddAgency);
    }

    showModalButton.addEventListener('click', function() {
        dialogAddAgency.showModal();
    });

    dialogAddAgency.querySelector('.close').addEventListener('click', function() {
        dialogAddAgency.close();
    });
</script>
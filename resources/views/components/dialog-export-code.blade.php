<dialog id="dialogExportCode" class="mdl-dialog" style="width: 480px;">
    <div class="mdl-dialog__content">
        <h4>Chọn định dạng và xuât lấy danh sách mã</h4>
        <form id="formExportCode" action="{{ route('guarantee.export') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="batch_id">
            <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--4-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <select class="mdl-textfield__input" name="type" id="selectType">
                            <option value="csv">CSV</option>
                        </select>
                        <label class="mdl-textfield__label" for="selectType">Định dạng xuất</label>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--8-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                        <input class="mdl-textfield__input" type="text" name="title" value="Title" pattern=".{3,}" id="inputTitle">
                        <label class="mdl-textfield__label" for="inputTitle">Tiêu đề file</label>
                        <span class="mdl-textfield__error">Tên không để trống, ít nhất 3 ký tự.</span>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="mdl-dialog__actions">
        <button type="submit" form="formExportCode" class="mdl-button mdl-js-button">Xuất</button>
        <button type="button" class="mdl-button mdl-js-button close">Hủy</button>
    </div>
</dialog>
<dialog id="dialogDownload" class="mdl-dialog" style="width: 480px;">
    <div class="mdl-dialog__content">Mã đã bắt đầu được xuất. Click vào tiếp tục nếu bạn muốn tải mã</div>
    <div class="mdl-dialog__actions">
        <a href="{{ route('guarantee.exportcode') }}" class="mdl-button mdl-js-button">Tiếp tục</a>
        <button type="button" class="mdl-button mdl-js-button close">Đóng</button>
    </div>
</dialog>
<script>
    {
        "use strict";

        var dialogExport = document.getElementById('dialogExportCode');
        var dialogDowload = document.getElementById('dialogDownload');
        var showDialogExports = document.querySelectorAll('.show-export-code');
        var formExportDialog = dialogExport.querySelector('#formExportCode');

        if (! dialogExport.showModal) {
            dialogPolyfill.registerDialog(dialogExport);
        }

        if (! dialogDowload.showModal) {
            dialogPolyfill.registerDialog(dialogDowload);
        }

        for (let showDialogExport of showDialogExports) {
            showDialogExport.addEventListener('click', function() {
                dialogExport.querySelector('input[name="batch_id"]').value = showDialogExport.dataset.id;
                dialogExport.showModal();
            });
        }

        dialogExport.querySelector('.close').addEventListener('click', function() {
            dialogExport.close();
        });

        dialogExport.querySelector('#formExportCode');

        formExportDialog.addEventListener('submit', function (event) {
            event.preventDefault();
            var fd = new FormData(this);

            fetch(this.action, {
                "method": "post",
                "credentials": "include",
                "body": fd
            })
                .then(function (response) {
                    return response.text();
                })
                .then(function (response) {
                    dialogExport.close();
                    dialogDowload.showModal();
                })
                .catch(function (error) {
                    console.log(error);
                });
        });
    }
</script>
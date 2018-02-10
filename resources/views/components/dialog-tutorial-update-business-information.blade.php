@if(! $tutorial || ($tutorial->complete == 0 && $tutorial->last->diffInHours(\Carbon\Carbon::now()) > 12))
    <dialog id="dialogTutorialUpdateBusiness" class="mdl-dialog" style="width: 560px;">
        <div class="mdl-dialog__title">Cập nhật thông tin doanh nghiệp</div>
        <div class="mdl-dialog__content">
            <p>Vui lòng bổ sung thông tin doanh nghiệp hoặc tiến hành tạo lô tem, liên hệ để được hướng dẫn hoặc hợp tác.</p>
        </div>
        <div class="mdl-dialog__actions">
            <a href="{{ route('business.information') }}" class="mdl-button mdl-js-button">Cập nhật</a>
            <button type="button" class="mdl-button mdl-js-button close">Nhắc lại sau</button>
        </div>
    </dialog>
    <script>
        {
            'use strict';

            var dialog = document.getElementById('dialogTutorialUpdateBusiness');

            if (! dialog.showModal) {
                dialogPolyfill.registerDialog(dialog);
            }

            dialog.querySelector('.close').addEventListener('click', function() {

                fetch('{{ route('ajax.tutorial.remind-update-business') }}', {
                    method: 'post',
                    credentials: 'include',
                    headers: {
                        "Content-type": "application/json; charset=UTF-8"
                    },
                    body: JSON.stringify({
                        _token: '{{ csrf_token() }}'
                    })
                })
                    .then(function (response) {
                        return response.json();
                    })
                    .then(function (response) {
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                dialog.close();
            });

            window.addEventListener('load', function (event) {
                setTimeout(() => {
                    dialog.showModal();
                }, 1000);
            });
        }
    </script>
@endif
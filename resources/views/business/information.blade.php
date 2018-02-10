@extends('layout')
<style>
    .mdl-card.mdl-card--auto-height {
        min-height: auto;
    }
    .mdl-card.mdl-card--full-width {
        width: 100%;
    }
</style>
@section('content')
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col mdl-cell--8-col-desktop">
            <section>
                <style>
                    .demo-card-event.mdl-card {
                        /*width: 256px;*/
                        /*height: 256px;*/
                        background: url('{{ asset($business->cover ? 'storage/images/'.$business->cover : 'images/download.png') }}') center / cover;
                    }
                    .demo-card-event > .mdl-card__actions {
                        border-color: rgba(255, 255, 255, 0.2);
                    }
                    .demo-card-event > .mdl-card__title {
                        align-items: flex-start;
                    }
                    .demo-card-event > .mdl-card__title > h4 {
                        margin-top: 0;
                    }
                    .demo-card-event > .mdl-card__actions {
                        display: flex;
                        box-sizing:border-box;
                        align-items: center;
                    }
                    .demo-card-event > .mdl-card__actions > .material-icons {
                        padding-right: 10px;
                    }
                    .demo-card-event > .mdl-card__title,
                    .demo-card-event > .mdl-card__actions,
                    .demo-card-event > .mdl-card__actions > .mdl-button {
                        color: #fff;
                    }
                </style>
                <div class="demo-card-event mdl-card mdl-card--full-width mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-card--expand"></div>
                    <div class="mdl-card__actions">
                        <div class="mdl-layout-spacer"></div>
                        <a id="showModalUpdateCover" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                            Cập nhật
                        </a>
                    </div>
                </div>
                @include('components.dialog-update-cover')
            </section>
            <section>
                <div class="mdl-card mdl-card--full-width mdl-shadow--2dp" style="margin-top: 16px;">
                    <form id="formUpdateBusiness" action="{{ route('guarantee.update') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div class="mdl-grid">
                            <div class="mdl-cell mdl-cell--12-col" style="padding-left: 136px; position: relative;">
                                <div style="position: absolute;top: 0;left: 0;width: 120px;height: 120px;">
                                    <label for="inputImage"><img src="{{ $business->logo ? asset('storage/images/'.$business->logo) : 'holder.js/120x120?text=Image' }}" width="120" height="120"></label>
                                </div>
                                <input id="inputImage" type="file" name="image" style="display: none;">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                                    <input class="mdl-textfield__input" type="text" name="name" value="{{ $business->id }}" id="inputID" disabled>
                                    <label class="mdl-textfield__label" for="inputID">ID doanh ngiệp</label>
                                    <span class="mdl-textfield__error"></span>
                                </div>
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                                    <input class="mdl-textfield__input" type="text" name="name" value="{{ $business->name }}" pattern=".{3,}" id="inputName">
                                    <label class="mdl-textfield__label" for="inputName">Tên hiển thị</label>
                                    <span class="mdl-textfield__error">Không để trống, ít nhất 3 ký tự.</span>
                                </div>
                            </div>
                            <div class="mdl-cell mdl-cell--12-col mdl-cell--6-col-desktop">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                                    <input class="mdl-textfield__input" type="text" name="address" value="{{ $business->address }}" pattern=".{3,}" id="inputAddress">
                                    <label class="mdl-textfield__label" for="inputAddress">Địa chỉ liên hệ</label>
                                    <span class="mdl-textfield__error">Không để trống, ít nhất 3 ký tự.</span>
                                </div>
                            </div>
                            <div class="mdl-cell mdl-cell--12-col mdl-cell--6-col-desktop">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                                    <input class="mdl-textfield__input" type="email" name="email" value="{{ $business->email }}" pattern=".{3,}" id="inputEmail">
                                    <label class="mdl-textfield__label" for="inputEmail">Email liên hệ</label>
                                    <span class="mdl-textfield__error">Địa chỉ email không hợp lệ.</span>
                                </div>
                            </div>
                            <div class="mdl-cell mdl-cell--12-col mdl-cell--6-col-desktop">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                                    <input class="mdl-textfield__input" type="text" name="phone" value="{{ $business->phone }}" pattern="^(0|84)[0-9]{9,10}$" id="inputPhone">
                                    <label class="mdl-textfield__label" for="inputPhone">Số điện thoại liên lạc</label>
                                    <span class="mdl-textfield__error">Số điện thoại không hợp lệ.</span>
                                </div>
                            </div>
                            <div class="mdl-cell mdl-cell--12-col mdl-cell--6-col-desktop">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                                    <input class="mdl-textfield__input" type="text" name="website" value="{{ $business->website }}" id="inputWebsite">
                                    <label class="mdl-textfield__label" for="inputWebsite">Website</label>
                                    <span class="mdl-textfield__error">Địa chỉ website không hợp lệ.</span>
                                </div>
                            </div>
                            <div class="mdl-cell mdl-cell--12-col">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                                    <textarea class="mdl-textfield__input" name="description" rows="3" id="inputDescription">{!! $business->description !!}</textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="mdl-card__actions mdl-typography--text-right">
                        <button type="reset" form="formUpdateBusiness" class="mdl-button mdl-button--colored mdl-js-button">
                            Hủy
                        </button>
                        <button type="submit" form="formUpdateBusiness" class="mdl-button mdl-button--colored mdl-js-button mdl-button--primary">
                            Lưu thay đổi
                        </button>
                    </div>
                </div>
            </section>
        </div>
        <div class="mdl-cell mdl-cell--12-col mdl-cell--4-col-desktop">
            <section>
                <div class="mdl-grid mdl-grid--no-spacing">
                    <div class="mdl-cell mdl-cell--12-col" style="margin-bottom: 16px;">
                        @include('components.card-qrcode-business', ['business' => $business])
                    </div>
                    <div class="mdl-cell mdl-cell--12-col" style="margin-bottom: 16px;">
                        @include('components.card-total-product')
                    </div>
                    <div class="mdl-cell mdl-cell--12-col">
                        @include('components.card-service-guarantee')
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
    window.addEventListener('load', function (event) {
        var textareas = document.querySelectorAll('textarea');

        for (textarea of textareas) {
            CKEDITOR.replace(textarea);
        }
    });
</script>
@endpush
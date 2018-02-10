@extends('layout')

@section('content')
    <section>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col mdl-cell--8-col-desktop mdl-cell--2-offset-desktop">
                <div class="mdl-card mdl-card--full-width">
                    <form id="formUpdateProduct" action="{{ route('guarantee.product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div class="mdl-grid">
                            <div class="mdl-cell mdl-cell--12-col" style="padding-left: 136px; position: relative;">
                                <div style="position: absolute;top: 0;left: 0;width: 120px;height: 120px;">
                                    <label for="inputImage"><img src="{{ $product->logo ? asset('storage/images/'.$product->logo) : 'holder.js/120x120?text=Image' }}" width="120" height="120"></label>
                                </div>
                                <input id="inputImage" type="file" name="image" style="display: none;">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                                    <input class="mdl-textfield__input" type="text" name="id" value="{{ $product->id }}" pattern="[0-9]{1,}" id="inputID" disabled>
                                    <label class="mdl-textfield__label" for="inputID">ID</label>
                                    <span class="mdl-textfield__error">ID không hợp lệ.</span>
                                </div>
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                                    <input class="mdl-textfield__input" type="text" name="name" value="{{ $product->name }}" pattern=".{3,}" id="inputName">
                                    <label class="mdl-textfield__label" for="inputName">Tên sản phẩm</label>
                                    <span class="mdl-textfield__error">Tên không để trống, ít nhất 3 ký tự.</span>
                                </div>
                            </div>
                        </div>
                        <div class="mdl-grid">
                            <div class="mdl-cell mdl-cell--6-col">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                                    <input class="mdl-textfield__input" type="text" name="gtin" value="{{ $product->gtin }}" pattern="[0-9]{8,}" id="inputGTIN">
                                    <label class="mdl-textfield__label" for="inputGTIN">Mã GTIN</label>
                                    <span class="mdl-textfield__error">Mã gtin không hợp lệ.</span>
                                </div>
                            </div>
                            <div class="mdl-cell mdl-cell--6-col">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                                    <input class="mdl-textfield__input" type="number" name="price" value="{{ $product->price }}" id="inputPrice">
                                    <label class="mdl-textfield__label" for="inputPrice">Giá</label>
                                    <span class="mdl-textfield__error">Giá không hợp lệ.</span>
                                </div>
                            </div>
                        </div>
                        <div class="mdl-grid">
                            <div class="mdl-cell mdl-cell--12-col">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                                    <textarea class="mdl-textfield__input" name="description" rows="3" id="inputDescription">{{ $product->description }}</textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="mdl-card__actions mdl-typography--text-right">
                        <a href="{{ route('guarantee.product.list') }}" class="mdl-button mdl-button--colored mdl-js-button">Hủy</a>
                        <button type="submit" form="formUpdateProduct" class="mdl-button mdl-button--colored mdl-js-button mdl-button--primary">Lưu thay đổi</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
    window.addEventListener('load', function (event) {
        var textareas = document.querySelectorAll('textarea');

        for (textarea of textareas) {
            CKEDITOR.replace(textarea);
        }

        console.log(document.querySelector('input[name="image"]'));

        document.querySelector('input[name="image"]').click();
    });
</script>
@endpush
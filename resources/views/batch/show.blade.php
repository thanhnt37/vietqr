@extends('layout')

@push('styles')
    <style>
        table {
            width: 100%;
        }
        .hidden {
            display: none;
        }
    </style>
@endpush

@section('content')
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col mdl-cell--8-col-desktop mdl-cell--2-offset-desktop">
                <div class="mdl-card mdl-card--full-width">
                    <div>
                        <div class="mdl-grid">
                            <div class="mdl-cell mdl-cell--6-col">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                                    <input class="mdl-textfield__input" type="text" name="id" value="{{ $batch->id }}" id="inputID" disabled>
                                    <label class="mdl-textfield__label" for="inputID">Mã lô</label>
                                </div>
                            </div>
                            <div class="mdl-cell mdl-cell--6-col">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                                    <input class="mdl-textfield__input" type="text" name="quantity" value="{{ $batch->quantity }}" id="inputQuantity" disabled>
                                    <label class="mdl-textfield__label" for="inputQuantity">Số lượng</label>
                                </div>
                            </div>
                            <div class="mdl-cell mdl-cell--12-col">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                                    <input class="mdl-textfield__input" type="text" name="name" value="{{ $batch->name }}" id="inputName" disabled>
                                    <label class="mdl-textfield__label" for="inputName">Tên</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mdl-cell mdl-cell--12-col mdl-cell--8-col-desktop mdl-cell--2-offset-desktop">
                <div class="mdl-card mdl-card--full-width">
                    <div class="mdl-card__title">
                        <div class="mdl-card__title-text">Sản phẩm</div>
                    </div>
                    @if($batch->product)
                        <div class="mdl-card__title">
                            <table>
                                <tbody>
                                <tr>
                                    <td>Mã sản phẩm</td>
                                    <td>{{ $batch->product->id }}</td>
                                </tr>
                                <tr>
                                    <td>Tên sản phẩm</td>
                                    <td>{{ $batch->product->name }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mdl-card__supporting-text">
                            <p>Bạn muốn <a id="showModalUpdateProductForBatch" href="javascript:void(0)">thay đổi</a> sản phẩm cho lô tem này.</p>
                        </div>
                    @else
                        <div class="mdl-card__supporting-text">
                            <p>Chưa có thông tin sản phẩm cho lô tem này. hãy <a id="showModalUpdateProductForBatch" href="javascript:void(0)">cập nhật</a> thêm sản phẩm cho lô.</p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="mdl-cell mdl-cell--12-col mdl-cell--8-col-desktop mdl-cell--2-offset-desktop">
                <div class="mdl-card mdl-card--full-width">
                    <div class="mdl-card__title">
                        <h4 class="mdl-card__title-text">Dịch vụ</h4>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <form id="formUpdateServiceForBatch" action="{{ route('guarantee.batch.update', ['batch' => $batch->id]) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('put') }}
                            <div class="mdl-grid">
                                <div class="mdl-cell mdl-cell--6-col">
                                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
                                        <input type="radio" id="option-1" class="mdl-radio__button" name="service" value="1" {{ isset($batch->metadata['service']) && $batch->metadata['service'] == 1 ? 'checked' : '' }}>
                                        <span class="mdl-radio__label">Bảo hành</span>
                                    </label>
                                </div>
                                <div class="mdl-cell mdl-cell--6-col">
                                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
                                        <input type="radio" id="option-2" class="mdl-radio__button" name="service" value="2" {{ isset($batch->metadata['service']) && $batch->metadata['service'] == 2 ? 'checked' : '' }}>
                                        <span class="mdl-radio__label">Chống giả</span>
                                    </label>
                                </div>
                                <div class="mdl-cell mdl-cell--6-col gua_day {{ $batch->metadata['service'] != 1 ? 'hidden' : '' }}">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                                        <input class="mdl-textfield__input" type="number" name="day" value="{{ $batch->guarantee_days ?: 30 }}" required id="inputDay">
                                        <label class="mdl-textfield__label" for="inputDay">Ngày bảo hành</label>
                                        <span class="mdl-textfield__error">Số ngày bảo hành không hợp lệ.</span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="mdl-dialog__actions">
                        <button type="submit" form="formUpdateServiceForBatch" class="mdl-button mdl-js-button">Cập nhật</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('components.dialog-update-product-for-batch', ['batch' => $batch])
@endsection

@push('scripts')
<script>
    {
        document.querySelectorAll('input[name="service"]').forEach(function (element) {
            element.addEventListener('change', function (event) {
                console.log(this.value);
                if (this.value == 1) {
                    document.querySelector('.gua_day').classList.remove('hidden');
                } else {
                    document.querySelector('.gua_day').classList.add('hidden');
                }
            });
        });
    }
</script>
@endpush
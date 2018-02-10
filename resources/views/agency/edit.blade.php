@extends('layout')

@section('content')
    <section>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col mdl-cell--8-col-desktop mdl-cell--2-offset-desktop">
                <div class="mdl-card mdl-card--full-width">
                    <form id="formUpdateAgency" action="{{ route('guarantee.agency.update', $agency->id) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div class="mdl-grid">
                            <div class="mdl-cell mdl-cell--12-col">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                                    <input class="mdl-textfield__input" type="text" name="name" value="{{ $agency->name }}" pattern=".{3,}" id="inputName">
                                    <label class="mdl-textfield__label" for="inputName">Tên điểm bán</label>
                                    <span class="mdl-textfield__error">Tên không để trống, ít nhất 3 ký tự.</span>
                                </div>
                            </div>
                        </div>
                        <div class="mdl-grid">
                            <div class="mdl-cell mdl-cell--8-col">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                                    <input class="mdl-textfield__input" type="text" name="address" value="{{ $agency->address }}" pattern=".{3,}" id="inputAddress">
                                    <label class="mdl-textfield__label" for="inputAddress">Địa chỉ</label>
                                    <span class="mdl-textfield__error">Tên không để trống, ít nhất 3 ký tự.</span>
                                </div>
                            </div>
                            <div class="mdl-cell mdl-cell--4-col">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--full-width">
                                    <select class="mdl-textfield__input" name="city" id="selectCity">
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}" {{ $city->id == $agency->city_id ? 'selected' : '' }}>{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                    <label class="mdl-textfield__label" for="selectCity">Thành phố</label>
                                    <span class="mdl-textfield__error">Tên không để trống.</span>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="mdl-card__actions mdl-typography--text-right">
                        <a href="{{ route('guarantee.agency.list') }}" class="mdl-button mdl-button--colored mdl-js-button">Hủy</a>
                        <button type="submit" form="formUpdateAgency" class="mdl-button mdl-button--colored mdl-js-button mdl-button--primary">Lưu thay đổi</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
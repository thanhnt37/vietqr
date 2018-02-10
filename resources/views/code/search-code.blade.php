@extends('layout')

@push('styles')
    <style>
        .mdl-data-table {
            width: 100%;
            border: none;
        }
        .mdl-card.mdl-card--auto-height {
            min-height: auto;
        }
    </style>
@endpush

@section('content')
    <header>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col">
                <div class="mdl-card mdl-card--full-width mdl-card--auto-height">
                    <div class="mdl-card__title">
                        <div class="mdl-card__title-text"><a href="{{ route('guarantee.code.list') }}"><i class="material-icons">arrow_back</i> Danh sách mã</a></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col">
                <div class="mdl-card mdl-card--full-width mdl-shadow--2dp">
                    <div class="mdl-card__title">
                        Mã không tồn tại
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
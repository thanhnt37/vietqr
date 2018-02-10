@extends('layout')

@push('styles')
    <style>
        table {
            width: 100%;
        }
        th {
            white-space: nowrap;
        }
        td,th {
            text-align: left;
        }
        th:last-child,
        td:last-child {
            text-align: right;
        }
        .lc {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .mdl-card {
            min-height: 100%;
        }
    </style>
@endpush

@section('content')
    <section>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--6-col">
                <div class="mdl-card mdl-card--full-width mdl-shadow--2dp">
                    <div class="mdl-card__title">
                        <div class="mdl-card__subtitle-text">Lượt bảo hành</div>
                    </div>
                    <div id="chartGuarantee"></div>
                </div>
            </div>
            <div class="mdl-cell mdl-cell--6-col">
                <div class="mdl-card mdl-card--full-width mdl-shadow--2dp">
                    <div class="mdl-card__title">
                        <div class="mdl-card__subtitle-text">Lượt kích hoạt</div>
                    </div>
                    <div id="chartGuaranteeActivated"></div>
                </div>
            </div>
        </div>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--3-col">
                @include('components.card-business-log-total')
            </div>
            <div class="mdl-cell mdl-cell--3-col">
                @include('components.card-local-activated')
            </div>
        </div>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--4-col">
                @include('components.card-top-product-acitvated')
            </div>
            <div class="mdl-cell mdl-cell--4-col">
                @include('components.card-top-agency-activated')
            </div>
            <div class="mdl-cell mdl-cell--4-col">
                @include('components.card-last-download')
            </div>
        </div>
    </section>
    @include('components.dialog-tutorial-update-business-information')
@endsection

@push('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        {
            "use strict";

            google.charts.load('current', {packages: ['corechart', 'line']});
            google.charts.setOnLoadCallback(drawChartGuarantee);
            google.charts.setOnLoadCallback(drawChartGuaranteeActivate);

            function drawChartGuarantee() {
                var data = new google.visualization.DataTable();
                data.addColumn('date', 'Date');
                data.addColumn('number', 'Count');

                var options = {
                    legend: 'top',
                    hAxis: {
                        title: 'Time'
                    }
                };

                var chart = new google.visualization.LineChart(document.getElementById('chartGuarantee'));
                chart.draw(data, options);

                fetch('{{ route('ajax.dailyguaranteecountlog') }}', {
                    credentials: 'include'
                })
                    .then(function (response) {
                        return response.json();
                    })
                    .then(function (response) {
                        response = response.map(function (item) {
                            item[0] = new Date(item[0]);
                            return item;
                        });

                        data.removeRows(0, data.getNumberOfRows());
                        data.addRows(response);
                        chart.draw(data, options);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
            function drawChartGuaranteeActivate() {
                var data = new google.visualization.DataTable();
                data.addColumn('date', 'Date');
                data.addColumn('number', 'Count');

                var options = {
                    legend: 'top',
                    hAxis: {
                        title: 'Time'
                    }
                };

                var chart = new google.visualization.LineChart(document.getElementById('chartGuaranteeActivated'));
                chart.draw(data, options);

                fetch('{{ route('ajax.dailyactivelog') }}', {
                    credentials: 'include'
                })
                    .then(function (response) {
                        return response.json();
                    })
                    .then(function (response) {
                        response = response.map(function (item) {
                            item[0] = new Date(item[0]);
                            return item;
                        });

                        data.removeRows(0, data.getNumberOfRows());
                        data.addRows(response);
                        chart.draw(data, options);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    </script>
@endpush
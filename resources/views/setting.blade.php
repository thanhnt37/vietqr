@extends('layout')

@section('content')

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
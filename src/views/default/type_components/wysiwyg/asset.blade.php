@push('head')
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('vendor/crudbooster/assets/summernote/summernote.css')}}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/libs/summernote-bs5.css') }}">
@endpush
@push('bottom')
    {{-- <script type="text/javascript" src="{{asset('vendor/crudbooster/assets/summernote/summernote.min.js')}}"></script> --}}
    <script type="text/javascript" src="{{ asset('vendor/crudbooster/assets/summernote/summernote-bs5.min.js') }}"></script>
@endpush

@extends('layouts.master')
@section('content')
<link rel="stylesheet" href="{{ asset('gup/css/jquery.jscrollpane.css') }}">
<link rel="stylesheet" href="{{ asset('gup/css/chosen.css') }}">
<link rel="stylesheet"  href="{{ asset('gup/dropzone.css') }}">
<link rel="stylesheet" href="{{ asset('gup/app.css') }}">
<div id="reswarn">
    <h1>Mohon Maaf, Resolusi layar anda terlalu kecil untuk menampilkan aplikasi ini </h1>
</div>

<div id="container" class="clearfix" style="display: flex; justify-content: center; align-items: center; height: 100vh;">
    <form action="{{ route('import.store') }}" class="dropzone" id="upload-box">
    @csrf
    </form>
</div>








<script src="{{ asset('gup/lib/jquery.min.js') }}"></script>
<script src="{{ asset('gup/lib/dropzone.js') }}"></script>
<script>
    Dropzone.options.myAwesomeDropzone = {
        paramName: "file", // The name that will be used to transfer the file
        addRemoveLinks: false,
        acceptedFiles:'.png,.jpg,.doc'
    };
</script>
@endsection

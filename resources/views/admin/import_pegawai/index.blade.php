@extends('layouts.master')
@section('content')
<link rel="stylesheet" href="{{ asset('gup/css/jquery.jscrollpane.css') }}">
<link rel="stylesheet" href="{{ asset('gup/css/chosen.css') }}">
<link rel="stylesheet" href="{{ asset('gup/dropzone.css') }}">
<link rel="stylesheet" href="{{ asset('gup/app.css') }}">
<div id="reswarn">
    <h1>Mohon Maaf, Resolusi layar anda terlalu kecil untuk menampilkan aplikasi ini </h1>
</div>

<div id="container" class="clearfix">
    <form action="{{ route('import.store') }}" class="dropzone" enctype="multipart/form-data" id="upload-box">
        @csrf
    </form>
</div>

<div class="output">
    <div class="container">
        <div class="row">
            @foreach ($data as $index => $row)
                @if ($index % 3 === 0)
                    </div><div class="row">
                @endif
                <div class="col-3 col-sm-4">
                    <div class="card">
                        <div class="card-header">
                            <img src="{{ $row['url'] }}" alt="{{ $row['name'] }}">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $row['name'] }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>








<script src="{{ asset('gup/lib/jquery.min.js') }}"></script>
<script src="{{ asset('gup/lib/dropzone.js') }}"></script>
<script>
    Dropzone.options.myAwesomeDropzone = {
        paramName: "file", // The name that will be used to transfer the file
        addRemoveLinks: false,
        acceptedFiles: '.pdf,.png,.doc,.xlss,.jpg'
    };
</script>
@endsection

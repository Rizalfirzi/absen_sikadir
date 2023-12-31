<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SISTEM INFORMASI KEHADIRAN PEGAWAI - DITJEN CIPTA KARYA</title>
<link href="{{ asset('assets/bower_components/js/chzn/chosen.css') }}" rel="stylesheet">
<link rel="icon" type="images/jpg" href="{{ asset('assets/img/logo.jpg') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<!-- Custom Fonts -->
{{-- <link href="{{asset('assets/bower_components/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/bower_components/daterangepicker.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/bower_components/datatables/media/css/jquery.dataTables.css')}}" rel="stylesheet"> --}}

<!-- Tambahkan link CSS untuk Bootstrap -->
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

<!-- Tambahkan link CSS untuk Bootstrap Datepicker -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css"
    rel="stylesheet">

<!-- Tambahkan link CSS untuk Export PDF, EXCEL, SVG -->
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.css" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chosen-js@1.8.7/chosen.min.css">

<link href='https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
<link href='https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css' rel='stylesheet' type='text/css'>

<style type="text/css">
.dt-buttons{
   width: 100%;
}
</style>

<style>
    .clearfix {
        width: 100%;
        height: 100%;
    }

    .img-with-stroke {
        display: inline-block;
        position: relative;
    }

    .img-stroke {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        -webkit-mask-image: linear-gradient(transparent 8px, white 8px);
        mask-image: linear-gradient(transparent 8px, white 8px);
    }
</style>
<style>
    th {
        color: white;
    }

    thead {
        background-color: rgb(10, 10, 90);
    }

    .dtHorizontalVerticalExampleWrapper {
        max-width: 600px;
        margin: 0 auto;
    }

    #dtHorizontalVerticalExample th,
    td {
        white-space: nowrap;
        max-width: auto;
        font-size: 12px;
        /* Mengurangi ukuran font */
    }

    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_asc_disabled:after,
    table.dataTable thead .sorting_asc_disabled:before,
    table.dataTable thead .sorting_desc:after,
    table.dataTable thead .sorting_desc:before,
    table.dataTable thead .sorting_desc_disabled:after,
    table.dataTable thead .sorting_desc_disabled:before {
        bottom: .5em;
    }

    .white-bottom-border {
        position: relative;
    }

    .white-bottom-border::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -1px;
        width: 100%;
        height: 1px;
        background-color: white;
    }

    .well1.btn {
        margin-left: 10px;
    }

    textarea {
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 8px;
        background-color: #f0f0f0;
    }

    .flex-item {
        margin-right: 10px;
        /* Memberi jarak antara elemen-elemen */
    }

    .containerScrol {
        width: 100%;
        overflow-x: scroll;
        white-space: nowrap;
    }

    .containerScrol::-webkit-scrollbar {
        height: 8px;
    }

    .containerScrol::-webkit-scrollbar-thumb {
        background-color: #888;
        border-radius: 4px;
    }

    .containerScrol::-webkit-scrollbar-track {
        background-color: #f2f2f2;
        border-radius: 4px;
    }

    .containerScrol::-webkit-scrollbar-thumb:hover {
        background-color: #555;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    .highlight-cell {
        font-size: 14px;
        text-transform: uppercase;
        font-weight: bold;
        background: #FFB100;
        border: 1px solid #D6A800;
        color: #fff;
        padding: 5px;
    }


    .lebartabel {
        border-collapse: collapse;
        width: 900px;
    }

    .fontkecil {
        width: 10px;
    }
</style>
<style>
    .dotted-line {
        border-top: 1px dotted #7d7b7b;
        /* Ganti #000 dengan warna yang diinginkan */
    }

    .button-container {
        display: flex;
        justify-content: center;
        /* Menyusun tombol di tengah secara horizontal */
        align-items: center;
        /* Menyusun tombol di tengah secara vertikal */
    }

    .button-container button {
        margin-right: 10px;
        /* Jarak antara tombol */
    }

    .alert .close {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        padding: 0.5rem 0.7rem;
        background-color: transparent;
        /* Latar belakang transparan dalam keadaan normal */
        border: none;
        outline: none;
        cursor: pointer;
        color: rgba(0, 0, 0, 0.5);
        /* Warna teks dalam keadaan normal */
    }

    /* Gaya tombol Close saat dihover */
    .alert .close:hover {
        background-color: transparent;
        /* Latar belakang tetap transparan saat dihover */
        color: rgba(0, 0, 0, 0.7);
        /* Warna teks menjadi lebih terang saat dihover */
    }
</style>

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Import Student Data</h1>
@stop

@section('content')
<body class="bg-light text-dark">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h1 class="">Insert Student List <small>(Excel file)</small></h1>
                        <form action="{{ route('import.student.data') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex justify-center items-center">
                                <input type="file" required name="file" class="form-control-file" id="file">
                                <button type="submit" class="btn btn-primary">Import</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<body class="bg-light text-dark">
    <div class="container p-4">
        <div class="row">
            <div class="col-md-6 py-4">
                <div class="card shadow-sm">
                    <div class="card-body bg-warning text-dark">
                        <h3 class="card-title">Most Visited Course:</h3>
                        <p class="card-text">{{ $mostVisitedCourseName }}</p>
                        <p class="card-text">Visits: {{ $mostVisitedCount }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 py-4">
                <div class="card shadow-sm">
                    <div class="card-body bg-light text-dark">
                        <h3 class="card-title">Least Visited Course:</h3>
                        <p class="card-text">{{ $leastVisitedCourseName }}</p>
                        <p class="card-text">Visits: {{ $leastVisitedCount }}</p>
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

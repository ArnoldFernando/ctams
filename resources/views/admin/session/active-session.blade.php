@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Students Timed In Today</h1>
@stop

@section('content')

<body class="bg-light text-dark">
    <div class="container p-4">

        <div class="container p-4">
            {{--  <h1 class="display-4 mb-4">Students Timed In Today</h1>  --}}

            <div class="d-flex justify-content-center align-items-center">
                <div class="w-100 max-w-4xl bg-white shadow rounded-lg overflow-auto" style="max-height: 24rem;">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark sticky-top">
                            <tr>
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Course</th>
                                <th>Action</th>
                                <th>Time</th>
                                <th>Duration</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($studentsTimedInToday as $student)
                                <tr>
                                    <td>{{ $student->student_id }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->course }}</td>
                                    {{-- <td>{{ $student->action }}</td> --}}
                                    <td>Active</td>
                                    <td>{{ $student->time }}</td>
                                    <td>{{ $student->duration }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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

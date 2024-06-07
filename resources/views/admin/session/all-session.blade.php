@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>All Session</h1>
@stop

@section('content')

<body class="bg-light text-dark">
    <div class="container p-4">


        <div class="d-flex justify-content-center align-items-center">
            <div class="w-100 max-w-4xl bg-white shadow rounded-lg overflow-auto" style="max-height: 24rem;">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark sticky-top">
                        {{--  <form action="{{ route('export.session') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary mb-2">Export Excel</button>
                        </form>  --}}
                        <tr>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Student-ID</th>
                            <th>Action</th>
                            <th>Time In</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sessionsByDay as $day => $sessions)
                            <tr>
                                <td colspan="6" class="bg-dark text-white px-3 py-2">{{ $day }}</td>
                            </tr>
                            @foreach ($sessions as $session)
                                <tr class="{{ $session->action === 'time_in' ? 'bg-success text-white' : ($session->action === 'time_out' ? 'bg-danger text-white' : '') }}">
                                    <td>{{ $session->name }}</td>
                                    <td>{{ $session->course }}</td>
                                    <td>{{ $session->student_id }}</td>
                                    <td>{{ $session->action }}</td>
                                    <td>{{ $session->time }}</td>
                                    <td>{{ $session->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
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

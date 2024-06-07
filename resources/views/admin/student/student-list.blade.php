@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Student List</h1>
@stop

@section('content')
<div class="py-4">
    <div class="container">
        <div class="bg-white shadow-sm rounded overflow-auto" style="max-height: 24rem;">
            <div class="p-4 text-dark">
                <div class="mb-4 text-dark">
                    <div class="d-flex justify-content-end">
                        <form action="{{ route('search.student') }}" method="GET" class="d-flex">
                            <input type="text" name="query" placeholder="Search..."
                                class="form-control mr-2">
                            <button type="submit"
                                class="btn btn-primary d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                    fill="currentColor" style="height: 1rem; width: 1rem;">
                                    <path fill-rule="evenodd"
                                        d="M13.293 14.707a1 1 0 0 1-1.414 1.414l-3-3a1 1 0 0 1 1.414-1.414l3 3z"
                                        clip-rule="evenodd" />
                                    <path fill-rule="evenodd"
                                        d="M12 10a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm-8 2a6 6 0 1 1 12 0 6 6 0 0 1-12 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="ml-1">Search</span>
                            </button>
                        </form>
                    </div>
                </div>

                <table class="table table-striped mt-4">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>STUDENT NAME</th>
                            <th>COURSE</th>
                            <th>BARCODE</th>
                            <th>Image</th>
                            <th>Delete</th>
                            <th>Update</th>
                        </tr>
                    </thead>

                    @if (isset($results) && count($results) > 0)
                        <tbody class="text-center">
                            @foreach ($results as $student)
                                <tr>
                                    <td>{{ $student['student_id'] }}</td>
                                    <td>{{ $student['name'] }}</td>
                                    <td>{{ $student['course'] }}</td>
                                    <td>{{ $student['barcode'] }}</td>
                                    <td>{{ $student['image'] }}</td>
                                    <td>
                                        <a href="{{ 'delete/' . $student['id'] }}"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                    <td>
                                        <a href="{{ 'edit/' . $student['id'] }}"
                                            class="btn btn-primary">Update</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @elseif (!isset($results))
                        <tbody class="text-center">
                            @foreach ($Student_lists as $group => $Student_list)
                                <tr class="bg-light">
                                    <td colspan="6" class="py-1">{{ $group }}</td>
                                </tr>
                                @foreach ($Student_list as $student)
                                    <tr>
                                        <td>{{ $student['student_id'] }}</td>
                                        <td>{{ $student['name'] }}</td>
                                        <td>{{ $student['course'] }}</td>
                                        <td>{{ $student['barcode'] }}</td>
                                        <td class="d-flex justify-content-center align-items-center">
                                            @if ($student->image)
                                                <img src="{{ asset('images/' . $student->image) }}"
                                                    alt="Student Photo" class="img-fluid" style="height: 3rem;">
                                            @else
                                                <p>No photo available</p>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ 'delete/' . $student['id'] }}"
                                                class="btn btn-danger">Delete</a>
                                        </td>
                                        <td>
                                            <a href="{{ 'edit/' . $student['id'] }}"
                                                class="btn btn-primary">Update</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    @else
                        <tbody class="text-center">
                            <tr>
                                <td colspan="6" class="py-1">No results found</td>
                            </tr>
                        </tbody>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">{{ $programme }} - Group {{ $group }}</h1>

        @if($students->isNotEmpty())
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $student->studID }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>
                                <a href="{{ route('exam.courses', ['studID' => $student->studID]) }}" class="btn btn-primary">View
                                    Courses</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


        @else
            <div class="alert alert-warning text-center" role="alert">
                No students found for this programme and group.
            </div>
        @endif

        <a href="{{ route('exam') }}" class="btn btn-secondary mt-3">Back</a>
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>My Courses</h1>

        @if($courses->isEmpty())
            <p>No courses assigned yet.</p>
        @else
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Course ID</th>
                        <th>Course Name</th>
                        <th>Credit Hours</th>
                        <th>Total of Students</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td>{{ $course->courseID }}</td>
                            <td>{{ $course->courseName }}</td>
                            <td>{{ $course->creditHours }}</td>
                            <td>{{ $course->students->count() }}</td>
                            <td>
                                <a href="{{ route('course.students', ['courseID' => $course->courseID]) }}"
                                    class="btn btn-primary">View Class </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
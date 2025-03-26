@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Enroll a New Student in {{ $course->courseName }}</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('course.enroll', ['courseID' => $course->courseID]) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="studID" class="form-label">Select Student</label>
                <select name="studID" id="studID" class="form-control" required>
                    <option value="">-- Select Student --</option>
                    @foreach($students as $student)
                        <option value="{{ $student->studID }}">{{ $student->name }} ({{ $student->studID }})</option>
                    @endforeach
                </select>
            </div>

            <div class="row align-items-center">
                <div class="col text-start">
                    <button type="submit" class="btn btn-success">Enroll Student</button>
                </div>
                <div class="col text-end">
                    <a href="{{ route('course.students', ['courseID' => $course->courseID]) }}"
                        class="btn btn-secondary">Back</a>
                </div>
            </div>
            
        </form>
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Students Enrolled in {{ $course->courseName }}</h1>

        @if($students->isNotEmpty())
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Programme</th>
                        <th>Year</th>
                        <th>Semester</th>
                        <th>Group</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $student->studID }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->programme }}</td>
                            <td>{{ $student->year }}</td>
                            <td>{{ $student->sem }}</td>
                            <td>{{ $student->group }}</td>
                            <td>
                                <!-- Drop Student Button -->
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#dropModal"
                                    data-courseid="{{ $course->courseID }}" data-studid="{{ $student->studID }}"
                                    data-studentname="{{ $student->name }}">
                                    Drop
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning text-center" role="alert">
                No students are enrolled in this course.
            </div>
        @endif
        <div class="container mt-3">
            <div class="row align-items-center">
                <div class="col text-start">
                    <a href="{{ route('courses.index') }}" class="btn btn-secondary mt-3">Back</a>
                </div>
                <div class="col text-end">
                    <a href="{{ route('course.enroll.form', ['courseID' => $course->courseID]) }}"
                        class="btn btn-success">Enroll
                        New Student</a>
                </div>
            </div>
        </div>

        <!-- Bootstrap Modal -->
        <div class="modal fade" id="dropModal" tabindex="-1" aria-labelledby="dropModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="dropModalLabel">Confirm Drop Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to drop <strong id="studentName"></strong> from this course?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDropBtn">Drop</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            var dropStudentId, dropCourseId;

            document.addEventListener('DOMContentLoaded', function () {
                var dropModal = document.getElementById('dropModal');
                dropModal.addEventListener('show.bs.modal', function (event) {
                    var button = event.relatedTarget;
                    dropStudentId = button.getAttribute('data-studid');
                    dropCourseId = button.getAttribute('data-courseid');
                    document.getElementById('studentName').textContent = button.getAttribute('data-studentname');
                });

                document.getElementById('confirmDropBtn').addEventListener('click', function () {
                    fetch(`/course/${dropCourseId}/drop/${dropStudentId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: "Dropped!",
                                    text: "The student has been successfully removed.",
                                    icon: "success",
                                    confirmButtonColor: "#3085d6"
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: "Error!",
                                    text: "Failed to drop student.",
                                    icon: "error",
                                    confirmButtonColor: "#d33"
                                });
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        </script>

@endsection
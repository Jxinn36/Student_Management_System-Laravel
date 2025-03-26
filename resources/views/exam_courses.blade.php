@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Courses Enrolled by {{ $student->name }}</h1>

        @if($student->courses->isNotEmpty())
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Course ID</th>
                        <th>Course Name</th>
                        <th>Marks</th>
                        <th>Grade</th>
                        <th>Average Marks (All Student)</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($student->courses as $course)
                            @php
                                // Fetch the average marks from the 'exam' table
                                $courseAverage = \App\Models\Exam::where('courseID', $course->courseID)->value('avgSub');
                            @endphp
                            <tr>
                                <td>{{ $course->courseID }}</td>
                                <td>{{ $course->courseName }}</td>
                                <td>{{ $course->marks ?? '-' }}</td>
                                <td>{{ $course->grade ?? '-' }}</td>
                                <td>{{ $courseAverage !== null ? number_format($courseAverage, 2) : '-' }}</td>
                                <td>
                                    <button class="btn btn-success btn-sm"
                                        onclick="openMarksModal('{{ $student->studID }}', '{{ $course->courseID }}', '{{ $course->marks ?? '' }}')">
                                        Update Marks
                                    </button>
                                </td>
                            </tr>
                    @endforeach
                </tbody>
            </table>


            <!-- Calculate Average Marks -->
            @php
                $validMarks = $student->courses->pluck('marks')->filter()->toArray(); // Get only non-null marks
                $averageMarks = count($validMarks) > 0 ? array_sum($validMarks) / count($validMarks) : 0;
            @endphp

            <h4 class="mt-3">Average Marks: <strong>{{ number_format($averageMarks, 2) }}</strong></h4>


        @else
            <div class="alert alert-warning text-center" role="alert">
                This student is not enrolled in any courses.
            </div>
        @endif
        <div class="d-flex justify-content-between mt-3">
            <a href="{{ route('exam.students', ['programme' => $student->programme, 'group' => $student->group]) }}"
                class="btn btn-secondary mt-3">Back</a>

            <a href="{{ route('export.csv') }}" class="btn btn-primary mt-3">
                Export CSV
            </a>


        </div>
    </div>

    <!-- Marks Update Modal -->
    <div class="modal fade" id="marksModal" tabindex="-1" aria-labelledby="marksModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="marksModalLabel">Update Marks</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="marksForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <label for="marks">Enter Marks:</label>
                        <input type="number" name="marks" id="marksInput" class="form-control" min="0" max="100" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Marks</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openMarksModal(studID, courseID, currentMarks) {
            // Set form action URL dynamically
            document.getElementById('marksForm').action = `/exam/update-marks/${studID}/${courseID}`;

            // Set the current marks in input field (if exists)
            document.getElementById('marksInput').value = currentMarks || "";

            // Show the modal
            var marksModal = new bootstrap.Modal(document.getElementById('marksModal'));
            marksModal.show();
        }
    </script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            let avgMarks = {{ $averageMarks }};

            $.ajax({
                url: "{{ route('updateAvgMarks', $student->studID) }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    avgStud: avgMarks
                },
                success: function (response) {
                    console.log(response.message);
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    </script>
@endsection
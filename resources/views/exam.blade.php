@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Classes</h1>

        @if($groupedStudents->isNotEmpty())
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Programme</th>
                        <th>Year</th>
                        <th>Sem</th>
                        <th>Group</th>
                        <td>Total of Students</td>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($groupedStudents as $programme => $groups)
                        @foreach($groups as $group => $students)
                            @php
                                $firstStudent = $students->first(); // Get the first student in the group
                            @endphp
                            <tr>
                                <td>{{ $programme }}</td>
                                <td>{{ $firstStudent ? $firstStudent->year : '-' }}</td>
                                <td>{{ $firstStudent ? $firstStudent->sem : '-' }}</td>
                                <td>{{ $group }}</td>
                                <td>{{ \App\Models\Student::where('programme', $programme)->where('group', $group)->count() }}</td>
                                <td>
                                    <a href="{{ route('exam.students', ['programme' => $programme, 'group' => $group]) }}"
                                        class="btn btn-primary">View Students</a>
                                </td>

                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning text-center" role="alert">
                No programmes or groups available.
            </div>
        @endif

    </div>
@endsection
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Student Profile</h1>
        <ul class="list-group">
            <li class="list-group-item"><strong>ID:</strong> {{ $student->studID }}</li>
            <li class="list-group-item"><strong>Name:</strong> {{ $student->name }}</li>
            <li class="list-group-item"><strong>Email:</strong> {{ $student->email }}</li>
            <li class="list-group-item"><strong>Campus:</strong> {{ $student->campus }}</li>
            <li class="list-group-item"><strong>Faculty:</strong> {{ $student->faculty }}</li>
            <li class="list-group-item"><strong>Programme:</strong> {{ $student->programme }}</li>
        </ul>
    </div>
@endsection
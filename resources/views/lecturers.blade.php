@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lecturer Profile</h1>

        <ul class="list-group">
            <li class="list-group-item"><strong>ID:</strong> {{ $lecturer->lecID }}</li>
            <li class="list-group-item"><strong>Name:</strong> {{ $lecturer->lecName }}</li>
            <li class="list-group-item"><strong>Email:</strong> {{ $lecturer->lecEmail }}</li>
            <li class="list-group-item"><strong>Campus:</strong> {{ $lecturer->lecCampus }}</li>
            <li class="list-group-item"><strong>Faculty:</strong> {{ $lecturer->lecFaculty }}</li>
        </ul>

        {{-- 🔹 Password Reset Button --}}
        <button type="button" class="btn btn-dark mt-3" data-bs-toggle="modal" data-bs-target="#resetPasswordModal">
            Reset Password
        </button>

        {{-- 🔹 Reset Password Modal --}}
        <div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="resetPasswordModalLabel">Reset Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        {{-- ✅ Success & Error Messages Inside Modal --}}
                        <div id="resetMessage"></div>

                        {{-- 🔹 Reset Password Form --}}
                        <form id="resetPasswordForm">
                            @csrf

                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password:</label>
                                <input type="password" name="current_password" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password:</label>
                                <input type="password" name="new_password" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label">Confirm New Password:</label>
                                <input type="password" name="new_password_confirmation" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-danger">Confirm Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- 🔹 AJAX Script for Reset Password --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            $("#resetPasswordForm").submit(function (e) {
                e.preventDefault(); // Prevent page reload

                $.ajax({
                    url: "{{ route('reset.password') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                title: "Success!",
                                text: "Your password has been successfully updated.",
                                icon: "success",
                                confirmButtonColor: "#3085d6"
                            }).then(() => {
                                $('#resetPasswordModal').modal('hide'); // Close modal
                                location.reload();
                            });
                        } else {
                            let errorMessage = "Something went wrong. Please try again.";

                            if (response.message) {
                                errorMessage = response.message; // Single error message
                            } else if (response.errors) {
                                // Join all errors into a single message with bullet points
                                errorMessage = Object.values(response.errors)
                                    .map(err => `• ${err[0]}`) // Format each error with a bullet
                                    .join("\n");
                            }

                            Swal.fire({
                                title: "Error!",
                                text: Object.values(response.errors).join("<br>"), // Joins errors into a single string
                                icon: "error",
                                confirmButtonColor: "#d33"
                            });
                        }
                    },
                    error: function (xhr) {
                        Swal.fire({
                            title: "Error!",
                            text: "Something went wrong. Please try again.",
                            icon: "error",
                            confirmButtonColor: "#d33"
                        });
                    }
                });
            });
        });


    </script>
@endsection
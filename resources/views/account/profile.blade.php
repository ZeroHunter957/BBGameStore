@extends('layouts.user')
@section('title', 'Profile')
@section('content')

    <div class="main-banner d-flex align-items-center justify-content-center position-relative"
        style="min-height: 250px; padding-top: 60px;">
        <div class="container text-center">
            <div class="profile-container" style="margin-top: 50px; text-align: center; position: relative;">

                @php
                    $user = \App\Models\Account::find(session('accountLogin'));
                @endphp

                @if ($user)
                    <!-- Profile Image -->
                    <img id="profile_image" src="{{ asset('profile_images/' . ($user->profile_image ?? 'default.jpg')) }}"
                        alt="Profile Image" class="img-fluid rounded-circle border shadow"
                        style="width: 130px; height: 130px; object-fit: cover; border: 4px solid white;">

                    <!-- User Name -->
                    <h3 id="user_fullname" class="mt-2 text-white">{{ $user->fullname }}</h3>

                    <!-- Profile Edit Container (Ensures Position Consistency) -->
                    <div style="width: 220px; margin: auto; position: relative;">
                        <!-- Edit Profile Button -->
                        <button id="editProfileBtn" class="btn btn-warning btn-lg mt-3 fw-bold shadow w-100"
                            onclick="toggleProfileEditor(true)">
                            Edit Profile
                        </button>

                        <!-- Profile Update Form (Initially Hidden, Absolute to Avoid Shifting) -->
                        <form id="updateProfileForm" enctype="multipart/form-data"
                            style="display: none; position: absolute; top: 100%; left: 0; width: 100%; background: rgba(255, 255, 255, 0.9); padding: 15px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">

                            <!-- Name Input -->
                            <input type="text" name="fullname" class="form-control mt-2" value="{{ $user->fullname }}"
                                required>

                            <!-- File Input -->
                            <input type="file" name="profile_image" class="form-control mt-2">

                            <!-- Submit & Cancel Buttons -->
                            <div class="mt-3 d-flex justify-content-between">
                                <button type="button" id="submitProfileUpdate"
                                    class="btn btn-primary fw-bold w-50">Update</button>
                                <button type="button" class="btn btn-secondary w-50 ms-2"
                                    onclick="toggleProfileEditor(false)">Cancel</button>
                            </div>
                        </form>
                    </div>
                @else
                    <p class="text-danger">User not found</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="col-lg-8">
        <!-- Filtering Buttons (Similar to the Game Shop Page) -->
        <ul class="trending-filter sorting-options">
            <li>
                <a href="#" class="is_active" data-filter="owned-games">Owned Games</a>
            </li>
            <li>
                <a href="#" data-filter="reviews-made">Reviews Made</a>
            </li>
        </ul>

        <!-- Placeholder Sections -->
        <div id="game-container">
            <div class="row">
                <div id="ownedGamesSection" class="filter-content">
                    <h5>Owned Games</h5>
                    <p>Content will be added here later.</p>
                </div>

                <div id="reviewsSection" class="filter-content" style="display: none;">
                    <h5>Reviews Made</h5>
                    <p>Content will be added here later.</p>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.3.1/mixitup.min.js"></script>
    <script>
        function toggleProfileEditor(show) {
            let form = document.getElementById('updateProfileForm');
            let button = document.getElementById('editProfileBtn');

            if (show) {
                form.style.display = 'block';
                button.style.display = 'none';
            } else {
                form.style.display = 'none';
                button.style.display = 'block';
            }
        }

        document.getElementById('submitProfileUpdate').addEventListener('click', function() {
            let formData = new FormData(document.getElementById('updateProfileForm'));

            fetch("{{ route('profile.update') }}", {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update the UI dynamically without reload
                        document.getElementById('user_fullname').innerText = formData.get("fullname");
                        if (data.newImagePath) {
                            document.getElementById('profile_image').src = data.newImagePath;
                        }

                        // Hide the form and show the Edit button again
                        toggleProfileEditor(false);
                    } else {
                        alert("Error: " + data.message);
                    }
                })
                .catch(error => console.error("AJAX Error:", error));
        });

        // Prevent form submission when pressing Enter
        document.getElementById('updateProfileForm').addEventListener('keypress', function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
            }
        });

        // Owned games & Reviews made
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".trending-filter a").forEach(button => {
                button.addEventListener("click", function(event) {
                    event.preventDefault();

                    // Remove active class from all buttons
                    document.querySelector(".trending-filter .is_active")?.classList.remove(
                        "is_active");
                    this.classList.add("is_active");

                    // Hide all sections
                    document.querySelectorAll(".filter-content").forEach(section => {
                        section.style.display = "none";
                    });

                    // Show the selected section
                    let filterValue = this.getAttribute("data-filter");
                    if (filterValue === "owned-games") {
                        document.getElementById("ownedGamesSection").style.display = "block";
                    } else if (filterValue === "reviews-made") {
                        document.getElementById("reviewsSection").style.display = "block";
                    }
                });
            });
        });
    </script>
@endsection

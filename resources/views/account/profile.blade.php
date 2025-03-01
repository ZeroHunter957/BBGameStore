@extends('layouts.user')
@section('title', 'Profile')
@section('content')

    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Profile</h3>
                    <span class="breadcrumb"><a href="/">Home</a> > Profile</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container text-center" style="margin-bottom: 50px">
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
                <h3 id="user_fullname" class="mt-2 text-black">{{ $user->fullname }}</h3>

                <!-- Profile Edit Container (Ensures Position Consistency) -->
                <div style="width: 220px; margin: auto; position: relative;">
                    <!-- Profile Edit & Change Password Buttons (Side by Side) -->
                    <div class="d-flex justify-content-center gap-2 mt-3" style="width: 220px; margin: auto;">
                        <!-- Edit Profile Button -->
                        <button id="editProfileBtn" class="btn btn-warning fw-bold shadow flex-grow-1"
                            onclick="toggleProfileEditor(true)">
                            Edit Profile
                        </button>

                        <!-- Change Password Button -->
                        <button id="changePasswordBtn" class="btn btn-danger fw-bold shadow flex-grow-1"
                            onclick="togglePasswordForm(true)">
                            Change Password
                        </button>
                    </div>

                    <!-- Profile Update Form (Initially Hidden) -->
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

                    <!-- Password Update Form (Initially Hidden) -->
                    <form id="updatePasswordForm"
                        style="display: none; position: absolute; top: 100%; left: 0; width: 100%; background: rgba(255, 255, 255, 0.9); padding: 15px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                        <!-- Current Password -->
                        <input type="password" name="current_password" class="form-control mt-2"
                            placeholder="Current Password" required>

                        <!-- New Password -->
                        <input type="password" name="new_password" class="form-control mt-2" placeholder="New Password"
                            required>

                        <!-- Confirm New Password -->
                        <input type="password" name="new_password_confirmation" class="form-control mt-2"
                            placeholder="Confirm New Password" required>

                        <!-- Submit & Cancel Buttons -->
                        <div class="mt-3 d-flex justify-content-between">
                            <button type="button" id="submitPasswordUpdate"
                                class="btn btn-primary fw-bold w-50">Update</button>
                            <button type="button" class="btn btn-secondary w-50 ms-2"
                                onclick="togglePasswordForm(false)">Cancel</button>
                        </div>
                    </form>
                </div>
            @else
                <p class="text-danger">User not found</p>
            @endif
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="col-lg-8">
        <!-- Filtering Buttons (Similar to the Game Shop Page) -->
        <ul class="trending-filter sorting-options">
            <li>
                <a href="#" class="is_active" data-filter="wishlist">Wishlist</a>
            </li>
            <li>
                <a href="#" data-filter="owned-games">Owned Games</a>
            </li>
            <li>
                <a href="#" data-filter="reviews-made">Reviews Made</a>
            </li>
        </ul>

        <!-- Placeholder Sections -->
        <div id="game-container">
            <div class="row">
                <div id="wishlistedSection" class="filter-content">
                    <h5>Wishlist</h5>

                    @foreach ($wishlistItems as $item)
                        <li>
                            {{ $item->wishable->name }}
                            <button class="remove-btn" data-id="{{ $item->wishable_id }}"
                                data-type="{{ class_basename($item->wishable_type) == 'Game' ? 'game' : 'accessory' }}">Remove</button>
                        </li>
                    @endforeach
                </div>


                <div id="ownedGamesSection" class="filter-content" style="display: none;">
                    <h5>Owned Games</h5>
                    <p>Games you own will be displayed here</p>
                </div>

                <div id="reviewsSection" class="filter-content" style="display: none;">
                    <h5>Reviews Made</h5>
                    <p>Reviews you've made will be displayed here</p>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.3.1/mixitup.min.js"></script>
    <script>
        function toggleProfileEditor(show) {
            let form = document.getElementById('updateProfileForm');
            let editBtn = document.getElementById('editProfileBtn');
            let passBtn = document.getElementById('changePasswordBtn');

            form.style.display = show ? 'block' : 'none';
            editBtn.style.display = show ? 'none' : 'block';
            passBtn.style.display = show ? 'none' : 'block';
        }

        function togglePasswordForm(show) {
            let form = document.getElementById('updatePasswordForm');
            let editBtn = document.getElementById('editProfileBtn');
            let passBtn = document.getElementById('changePasswordBtn');

            form.style.display = show ? 'block' : 'none';
            editBtn.style.display = show ? 'none' : 'block';
            passBtn.style.display = show ? 'none' : 'block';
        }

        // Profile Update AJAX
        document.getElementById('submitProfileUpdate').addEventListener('click', function() {
            let form = document.getElementById('updateProfileForm');
            let formData = new FormData(form);

            fetch("{{ route('profile.update') }}", {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": document.querySelector('input[name=_token]').value
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('profile_image').src = "{{ asset('profile_images') }}/" + data
                            .profile_image;
                        document.getElementById('user_fullname').innerText = formData.get('fullname');
                        toggleProfileEditor(false);
                    }
                })
                .catch(error => console.error("Profile Update Error:", error));
        });


        // Password Update AJAX
        document.getElementById('submitPasswordUpdate').addEventListener('click', function() {
            let formData = new FormData(document.getElementById('updatePasswordForm'));

            fetch("{{ route('password.update-password') }}", {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name=\"csrf-token\"]').getAttribute(
                            'content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        togglePasswordForm(false);
                    }
                })
                .catch(error => console.error("Password Update Error:", error));
        });

        // Prevent Enter Key from Submitting Password Form
        document.getElementById('updatePasswordForm').addEventListener('keypress', function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
            }
        });

        // Wishlist & Owned games & Reviews made
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
                    } else if (filterValue === "wishlist") {
                        document.getElementById("wishlistedSection").style.display = "block";
                    }
                });
            });
        });

        // Wishlist
        document.addEventListener("DOMContentLoaded", function() {
            // Remove from wishlist
            document.querySelectorAll(".remove-btn").forEach(button => {
                button.addEventListener("click", function() {
                    let wishlistable_id = this.dataset.id;
                    let wishlistable_type = this.dataset.type;

                    fetch("{{ route('wishlist.remove') }}", {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                "Content-Type": "application/json"
                            },
                            body: JSON.stringify({
                                id: wishlistable_id,
                                type: wishlistable_type
                            })
                        }).then(response => response.json())
                        .then(data => location.reload());
                });
            });

            // Clear wishlist
            document.getElementById("clearWishlist").addEventListener("click", function() {
                fetch("{{ route('wishlist.clear') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        }
                    }).then(response => response.json())
                    .then(data => location.reload());
            });
        });
    </script>

@endsection

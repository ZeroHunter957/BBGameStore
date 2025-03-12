@extends('layouts.user')
@section('title', 'Profile')
@section('content')
    @push('styles')
        <style> 
            .libraryEmpty{
                display: flex;
                flex-direction: column;
                text-align: center;
                height: 100px;
            }
            .libraryEmpty a{
                background: blue;
                color: white;
                padding: 10px;
                margin-top: 10px;
                margin-left:25%; 
                width: 300px;
                border-radius: 10px;
            }
            #game-container {
                color: white;
                font-family: Arial, sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                width: 100vw;
            }

            .game-library {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 16px;
                width: 100%;
                max-width: 1000px;
            }

            .game-card {
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                /* Đẩy button xuống đáy */
                align-items: center;
                width: 200px;
                /* Điều chỉnh kích thước theo ý muốn */
                padding: 15px;
                background-color: #222;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                text-align: center;
                height: 100%;
                /* Đảm bảo thẻ game có chiều cao cố định */
            }

            .game-card:hover {
                transform: scale(1.05);
            }

            .game-card img {
                width: 100%;
                height: 200px;
                border-radius: 8px;
            }

            h3 {
                color: white;
                font-size: 16px;
                margin: 10px 0 5px;
            }

            .game-card p {
                color: gray;
                font-size: 14px;
                flex-grow: 1;
                /* Đẩy phần dưới xuống */
            }

            .game-card button {
                width: 100%;
                background-color: #66c2ff;
                /* Màu xanh nhạt */
                color: black;
                border: none;
                padding: 10px;
                border-radius: 5px;
                cursor: pointer;
                font-weight: bold;
                text-transform: uppercase;
                margin-top: auto;
                /* Đẩy button xuống cuối */
            }

            button:hover {
                background-color: #666;
            }

            /* Style for reviews table */
            #reviewsSection .table {
                width: 100%;
                margin-top: 20px;
            }

            #reviewsSection .table th,
            #reviewsSection .table td {
                text-align: center;
                vertical-align: middle;
            }

            #reviewsSection .table th {
                background-color: #f8f9fa;
            }

            #reviewsSection .table td {
                padding: 12px;
            }

            /* Badge for ratings */
            .badge.bg-warning {
                font-size: 14px;
                padding: 5px 10px;
            }

            /* Button Styling */
            #reviewsSection .btn-primary {
                font-size: 12px;
            }

            /* Optional: Table row hover effect */
            #reviewsSection .table tbody tr:hover {
                background-color: #f1f1f1;
                cursor: pointer;
            }

            /* Optional: Space between cards when reviews are shown */
            #reviewsSection .filter-content {
                padding: 20px;
            }
        </style>
    @endpush

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
                <a href="#" class="is_active" data-filter="owned-games">Library</a>
            </li>
            <li>
                <a href="#" data-filter="reviews-made">Reviews Made</a>
            </li>
        </ul>

        <!-- Placeholder Sections -->
        <div id="game-container">
            <div class="row">
                <div id="ownedGamesSection" class="filter-content">
                    @if ($games->isEmpty())
                    <div class="libraryEmpty">
                        <h2>You haven't added anything to your wishlist yet.</h2>
                    <a href="{{ route('menu.gameshop') }}">Shop for Games & Accessories</a>
                    </div>
                    @else
                        <div class="game-library">
                            @foreach ($games as $libraryGame)
                                <div class="game-card">
                                    <a href="{{ route('menu.gamedetails', $libraryGame->id) }}">
                                        <img src=" {{ $libraryGame->image }}" alt="Game 1">
                                        <h3>{{ $libraryGame->title }}</h3>
                                        <p>{{ $libraryGame->library_created_at }} Achievements</p>
                                    </a>
                                    <form action="{{ route('enterDownloadCode', $libraryGame->id) }}">
                                        <button type="submit">Install</button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div id="reviewsSection" class="filter-content" style="display: none;">
                    <h5>Reviews Made</h5>
                    <div id="feedbacksList" class="table-responsive">
                        <!-- Feedbacks will be dynamically injected here -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        // Function to show the appropriate section (owned games or reviews)
        document.querySelectorAll('.trending-filter a').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();

                // Toggle filter visibility
                document.querySelectorAll('.filter-content').forEach(section => {
                    section.style.display = 'none';
                });

                // Get filter type
                const filterType = this.getAttribute('data-filter');

                if (filterType === 'reviews-made') {
                    // Show the reviews section and load the feedbacks
                    document.getElementById('reviewsSection').style.display = 'block';

                    // Fetch reviews made by the current user
                    fetch("{{ route('profile.feedbacks') }}")
                        .then(response => response.json())
                        .then(data => {
                            const feedbacksContainer = document.getElementById('feedbacksList');
                            feedbacksContainer.innerHTML = ''; // Clear any existing feedbacks

                            // Table header
                            const table = document.createElement('table');
                            table.classList.add('table', 'table-striped', 'table-bordered');
                            table.innerHTML = `
                            <thead>
                                <tr>
                                    <th>Game Title</th>
                                    <th>Feedback</th>
                                    <th>Rating</th>
                                    <th>Review Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        `;
                            const tbody = table.querySelector('tbody');

                            // Loop through feedbacks and display them in table rows
                            data.feedbacks.forEach(feedback => {
                                const row = document.createElement('tr');
                                row.innerHTML = `
                                <td>${feedback.game.title}</td>
                                <td>${feedback.content}</td>
                                <td><span class="badge bg-warning">${feedback.star} Stars</span></td>
                                <td>${new Date(feedback.created_at).toLocaleDateString()}</td>
                                <td>
                                    <a href="{{ url('gamedetails') }}/${feedback.game.id}" class="btn btn-primary btn-sm">View Game Details</a>
                                </td>
                            `;
                                tbody.appendChild(row);
                            });

                            feedbacksContainer.appendChild(table);
                        })
                        .catch(error => console.error('Error fetching feedbacks:', error));
                } else if (filterType === 'owned-games') {
                    document.getElementById('ownedGamesSection').style.display = 'block';
                }
            });
        });
    </script>




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
    </script>

@endsection

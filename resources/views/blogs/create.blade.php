<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/ui-forms.html" />
    <title>Create Blog | Admin</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/new.css') }}" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
</head>

<body>
    <div class="wrapper">
        <div class="main">
            <main class="content">
                <div class="container-fluid p-0">
                    <h1 class="h3 mb-4 text-center">Create a New Blog</h1>

                    <!-- Display messages (if any) -->
                    @if (session('message'))
                    <div class="alert alert-info">
                        <strong>Info!</strong> {{ session('message') }}
                    </div>
                    @endif

                    <!-- Blog creation form -->
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <form id="createArticleForm" action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Title Field -->
                                <div class="mb-3">
                                    <label for="title" class="form-label">Blog Title</label>
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Enter the title" required>
                                </div>

                                <!-- Content Field (CKEditor) -->
                                <div class="mb-3">
                                    <label for="content" class="form-label">Content</label>
                                    <div id="content" class="form-control" style="min-height: 200px;" required></div>
                                </div>

                                <!-- Image Upload Field -->
                                <div class="mb-3">
                                    <label for="image" class="form-label">Blog Image</label>
                                    <input type="file" class="form-control" name="image" id="image" accept="image/*">
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary btn-lg w-100">Create Blog</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS & Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="{{ asset('js/new.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let editor;

            // Initialize CKEditor for content field
            ClassicEditor
                .create(document.querySelector('#content'))
                .then(editorInstance => {
                    editor = editorInstance;
                })
                .catch(error => {
                    console.error('Error initializing CKEditor:', error);
                });

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Handle form submission via AJAX
            document.getElementById('createArticleForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const articleData = {
                    title: document.getElementById('title').value,
                    content: editor ? editor.getData() : '',
                    image: document.getElementById('image').files[0],
                };

                const formData = new FormData();
                formData.append('title', articleData.title);
                formData.append('content', articleData.content);
                formData.append('image', articleData.image);

                fetch('{{ route("blogs.store") }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.errors) {
                            console.error('Validation errors:', data.errors);
                        } else {
                            console.log('Blog created successfully:', data);
                            window.location.href = '/admin/blogs';
                        }
                    })
                    .catch(error => {
                        console.error('Error creating blog:', error);
                    });
            });
        });
    </script>

</body>

</html>

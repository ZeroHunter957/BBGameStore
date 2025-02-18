<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-3">
        @if (session('message'))
            <div class="alert alert-info">
                <strong>Info!</strong> {{ session('message') }}
            </div>
        @endif
        <h2>Game Edit Form</h2>
        <form action="{{ route('game.update', $games->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 mt-3">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" value="{{ $games->title }}"
                    placeholder="Enter game title" name="title">
                @error('title')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3 mt-3">
                <label for="category">Category:</label>
                <select class="form-select" name="cat_id">
                    @foreach ($cates as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('category')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3 mt-3">
                <label for="price">Price:</label>
                <input type="number" class="form-control" id="price" value="{{ $games->price }}"
                    placeholder="Enter price" name="price">
                @error('price')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3 mt-3">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter description">{{ $games->description }}</textarea>
                @error('description')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3 mt-3">
                <label for="developer">Developer:</label>
                <input type="text" class="form-control" id="developer" value="{{ $games->developer }}"
                    placeholder="Enter developer" name="developer">
                @error('developer')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3 mt-3">
                <label for="platform">Platform:</label>
                @php
                    $selectedPlatforms = explode(', ', $games->platform); // Convert string to array
                @endphp

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="platform[]" value="PC" id="pc"
                        {{ in_array('PC', $selectedPlatforms) ? 'checked' : '' }}>
                    <label class="form-check-label" for="pc">PC</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="platform[]" value="Mobile" id="mobile"
                        {{ in_array('Mobile', $selectedPlatforms) ? 'checked' : '' }}>
                    <label class="form-check-label" for="mobile">Mobile</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="platform[]" value="Console" id="console"
                        {{ in_array('Console', $selectedPlatforms) ? 'checked' : '' }}>
                    <label class="form-check-label" for="console">Console</label>
                </div>

                @error('platform')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3 mt-3">
                <label for="release_date">Release date:</label>
                <input type="date" id="release_date" value="{{ $games->release_date }}"
                    placeholder="Enter release_date" name="release_date">
                @error('release_date')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3 mt-3">
                <label for="image">Current Image:</label>
                <input type="hidden" value="{{ $games->image }}" name="existingImage">
                <img src="{{ $games->image }}" width="150" alt="">
            </div>
            <div class="mb-3 mt-3">
                <label for="image">Image:</label>
                <input type="file" class="form-control" id="image" name="image">
                @error('image')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3 mt-3">
                <label for="file">Game file:</label>
                <input type="file" class="form-control" id="file" name="file">
                @error('file')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Include CKEditor -->
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
</body>

</html>

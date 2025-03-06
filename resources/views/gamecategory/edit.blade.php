<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Game Category</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
</head>
<style>
        
    body {
        background: linear-gradient(135deg, #3a7bd5, #00d2ff);
        color: #fff;
        font-family: 'Poppins', sans-serif;
    }
    .container {
        max-width: 50%;
        background: rgba(255, 255, 255, 0.1);
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
        margin: auto;
        backdrop-filter: blur(10px);
    }
    label {
        font-weight: bold;
    }
    .form-control, .form-select {
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
        border: 1px solid #fff;
    }
    .form-control:focus, .form-select:focus {
        border-color: #00d2ff;
        box-shadow: 0 0 10px rgba(0, 210, 255, 0.5);
    }
    .btn-primary {
        background: #00d2ff;
        border: none;
        transition: 0.3s;
    }
    .btn-primary:hover {
        background: #3a7bd5;
        box-shadow: 0 0 15px rgba(58, 123, 213, 0.7);
    }
    body {
        background: linear-gradient(135deg, #1a1a2e, #16213e);
        color: #fff;
        font-family: 'Poppins', sans-serif;
    }
    .container {
        max-width: 50%;
        background: #0f3460;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
        margin: auto;
        margin-top: 50px;
    }
    label {
        font-weight: bold;
    }
    .form-control {
        background: #16213e;
        color: #fff;
        border: 1px solid #e94560;
    }
    .form-control:focus {
        border-color: #ff4757;
        box-shadow: 0 0 10px rgba(233, 69, 96, 0.5);
    }
    .btn-primary {
        background: #e94560;
        border: none;
        transition: 0.3s;
    }
    .btn-primary:hover {
        background: #ff4757;
        box-shadow: 0 0 15px rgba(255, 71, 87, 0.7);
    }
    .btn-secondary {
        background: #555;
        border: none;
        transition: 0.3s;
    }
    .btn-secondary:hover {
        background: #777;
        box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
    }
</style>
<body>
    <div class="container mt-3">
        <h2 class="text-center">Edit Game Category</h2>
        <form action="{{ route('gamecategory.update', $gamecategory->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $gamecategory->name) }}" required>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('gamecategory.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>

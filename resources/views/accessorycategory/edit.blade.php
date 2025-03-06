<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Accessory Category</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1e1e2f, #25253e);
            color: #fff;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #2a2a40;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.1);
            width: 40%;
        }
        .form-label {
            font-weight: bold;
        }
        .form-control {
            background: #1e1e2f;
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
            background: #6c757d;
            border: none;
        }
        .btn-secondary:hover {
            background: #5a6268;
        }
    </style>
</head>

<body>
    <div class="container mt-3">
        <h2 class="text-center">Edit Accessory Category</h2>
        <form action="{{ route('accessorycategory.edit', $accessorycategory->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $accessorycategory->name) }}" required>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary w-45">Update</button>
                <a href="{{ route('accessorycategory.index') }}" class="btn btn-secondary w-45">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
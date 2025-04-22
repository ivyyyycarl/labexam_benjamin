<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Task</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Font Awesome for Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .card-header {
      background-color: #007bff;
      color: #fff;
    }
  </style>
</head>
<body>
  
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ url('/') }}">Task Manager</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" 
            data-target="#navbarNav" aria-controls="navbarNav" 
            aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>
  
  <div class="container mt-4">
    <div class="card">
      <div class="card-header">
        <h3>Edit Task</h3>
      </div>
      <div class="card-body">
        <!-- Validation Errors -->
        @if($errors->any())
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif

        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" class="form-control" id="title"
                   value="{{ old('title', $task->title) }}" required>
          </div>
          <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" class="form-control" id="description" rows="4">{{ old('description', $task->description) }}</textarea>
          </div>
          <div class="form-group form-check">
            <input type="checkbox" name="is_completed" class="form-check-input" id="is_completed" {{ $task->is_completed ? 'checked' : '' }}>
            <label class="form-check-label" for="is_completed">Completed</label>
          </div>
          <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i> Update Task
          </button>
          <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
          </a>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" 
          crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" 
          crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" 
          crossorigin="anonymous"></script>
</body>
</html>

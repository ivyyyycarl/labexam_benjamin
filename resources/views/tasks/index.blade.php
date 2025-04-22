<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Task Management System</title>
  <!-- Bootstrap CSS for styling -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Optional: Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
  <style>
    body {
      background-color: #f8f9fa;
    }
    .card-header {
      background-color: #007bff;
      color: #fff;
    }
    .btn-custom {
      margin-right: 5px;
    }
  </style>
</head>
<body>

  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ url('/') }}">Task Manager</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" 
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>

  <div class="container mt-4">
    <div class="card">
      <div class="card-header">
        <h2 class="mb-0">Task Management</h2>
      </div>
      <div class="card-body">

        <!-- Success Message -->
        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif

        <div class="mb-3">
          <a href="{{ route('tasks.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create New Task
          </a>
        </div>

        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead class="thead-light">
              <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th style="width: 150px;">Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($tasks as $task)
                <tr>
                  <td>{{ $task->id }}</td>
                  <td>
                    @if($task->is_completed)
                      <span style="text-decoration: line-through;">{{ $task->title }}</span>
                    @else
                      {{ $task->title }}
                    @endif
                  </td>
                  <td>{{ $task->description }}</td>
                  <td>
                    @if($task->is_completed)
                      <span class="badge badge-success">Completed</span>
                    @else
                      <span class="badge badge-warning">Pending</span>
                    @endif
                  </td>
                  <td>
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-info btn-custom">
                      <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline-block">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger btn-custom" onclick="return confirm('Are you sure?')">
                        <i class="fas fa-trash-alt"></i> Delete
                      </button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center">No tasks found.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" 
          integrity="sha384-DfXdz2hrtcy7i7/fIFqZ02M2J9s4gsQTXz+M4h/w9Cm6lY+rhQ/9t19/KFL64Qet" 
          crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" 
          integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3EVfIuQgyExN8krd7qMrf6tL67e/Ev4S7as" 
          crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" 
          integrity="sha384-B0UglyR+lyqlojK1l9fznLkVHq24smQkh5r0qdeqGr9I6zGukzz" 
          crossorigin="anonymous"></script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('dashboard') }}">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('showAddBookForm') }}">Add Book</a>
                </li>
            </ul>
        </div>
        <!-- User Profile and Logout -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('profile') }}">Welcome, {{$user->first_name}} {{$user->last_name}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}">Logout</a>
            </li>
        </ul>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-9">
                <h2>Authors</h2>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Birthday</th>
                            <th>Gender</th>
                            <th>Place of Birth</th>
                            <th>Actions</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($authors as $author)
                            <tr>
                                <td>{{ $author['id'] }}</td>
                                <td>{{ $author['first_name'] }}</td>
                                <td>{{ $author['last_name'] }}</td>
                                <td>{{ $author['birthday'] }}</td>
                                <td>{{ $author['gender'] }}</td>
                                <td>{{ $author['place_of_birth'] }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Author Actions">
                                        <a href="{{ route('viewAuthor', ['id' => $author['id']]) }}" class="btn btn-primary">View</a>
                                        <a href="{{ route('deleteAuthor', ['id' => $author['id']]) }}" class="btn btn-danger">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            @for ($page = 1; $page <= $totalPages; $page++)
                                <li class="page-item {{ $currentPage == $page ? 'active' : '' }}">
                                    <a class="page-link" href="{{ url('/dashboard') }}?page={{ $page }}">{{ $page }}</a>
                                </li>
                            @endfor
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

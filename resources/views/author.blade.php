<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author Details</title>
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
                
                <h2>Author Details</h2>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{$author['first_name']}} {{$author['last_name']}}</h5>
                        <p class="card-text"><strong>Birthday:</strong> {{$author['birthday']}}</p>
                        <p class="card-text"><strong>Biography:</strong></p>
                        <p class="card-text">{{$author['biography']}}</p>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success mt-3">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger mt-3">{{ session('error') }}</div>
                @endif

                <h3 class="mt-4">Books</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Release Date</th>
                            <th>Description</th>
                            <th>ISBN</th>
                            <th>Format</th>
                            <th>Number of Pages</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <td>{{ $book['id'] }}</td>
                                <td>{{ $book['title'] }}</td>
                                <td>{{ $book['release_date'] }}</td>
                                <td>{{ $book['description'] }}</td>
                                <td>{{ $book['isbn'] }}</td>
                                <td>{{ $book['format'] }}</td>
                                <td>{{ $book['number_of_pages'] }}</td>
                                <td>
                                    <a href="{{ route('deleteBook', ['id' => $book['id'], 'authorId' => $author['id']]) }}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

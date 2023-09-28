<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book</title>
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
            <div class="col-md-6 offset-md-3">
                <h2>Add New Book</h2>
                <form method="post" action="{{ route('addBook') }}">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="release_date">Release Date</label>
                        <input type="date" class="form-control @error('release_date') is-invalid @enderror" id="release_date" name="release_date" required>
                        @error('release_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="author_id">Select Author</label>
                        <select class="form-control @error('author_id') is-invalid @enderror" id="author_id" name="author_id" required>
                            <option value="">Select an author</option>
                            @foreach($authors as $author)
                                <option value="{{ $author['id'] }}">{{ $author['first_name'] }} {{ $author['last_name'] }}</option>
                            @endforeach
                        </select>
                        @error('author_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description">
                    </div>
                    <div class="form-group">
                        <label for="isbn">ISBN</label>
                        <input type="text" class="form-control" id="isbn" name="isbn">
                    </div>
                    <div class="form-group">
                        <label for="format">Format</label>
                        <input type="text" class="form-control" id="format" name="format">
                    </div>
                    <div class="form-group">
                        <label for="number_of_pages">Number of Pages</label>
                        <input type="number" class="form-control" id="number_of_pages" name="number_of_pages" min="0">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Book</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

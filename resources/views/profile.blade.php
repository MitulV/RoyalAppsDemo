<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
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
                <div class="card">
                    <div class="card-header">
                        <h2>User Profile</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>First Name:</th>
                                    <td>{{$user->first_name}}</td>
                                </tr>
                                <tr>
                                    <th>Last Name:</th>
                                    <td>{{$user->last_name}}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{$user->email}}</td>
                                </tr>
                                <tr>
                                    <th>Gender:</th>
                                    <td>{{$user->gender}}</td>
                                </tr>
                                <tr>
                                    <th>Active:</th>
                                    <td>{{$user->active ? 'Yes' : 'No'}}</td>
                                </tr>
                                <tr>
                                    <th>Created At:</th>
                                    <td>{{$user->created_at}}</td>
                                </tr>
                                <tr>
                                    <th>Updated At:</th>
                                    <td>{{$user->updated_at}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

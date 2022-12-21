<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ready Quiz</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        </style>
    </head>
    <body class="antialiased">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>Usuarios</h2>
                    <hr/>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                              <th scope="col">Date</th>
                              <th scope="col">User Id</th>
                              <th scope="col">Identification</th>
                              <th scope="col">Mobile</th>
                              <th scope="col">Birth day</th>
                              <th scope="col">Transactions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->getTimeStamps()['created_at'] }}</th>
                                    <td>{{ $user->getUserId() }}</td>
                                    <td>{{ $user->getIdentification() }}</td>
                                    <td>{{ $user->getMobileNumber() }}</td>
                                    <td>{{ $user->getBirthDate() }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item {{ $pagination['previousPage'] === 0 ? 'disabled': '' }}">
                                <a href="{{ route('users.index', [ 'page' => $pagination['previousPage'] ]) }}" class="page-link">Previous</a>
                            </li>
                            <li class="page-item">
                                <a
                                    class="page-link {{ $pagination['currentPage'] === 1 ? 'active' : ''}}"
                                    href="{{ route('users.index', [ 'page' => $pagination['previousPage'] ]) }}"
                                >
                                    {{ $pagination['previousPage'] }}
                                </a>
                            </li>

                            <li class="page-item">
                                <a
                                    class="page-link {{ $pagination['currentPage'] > 1 ? 'active' : ''}}"
                                    href="{{ $pagination['currentPage'] === 1 ? route('users.index', [ 'page' => $pagination['nextPage'] ]) : '#' }}"
                                >
                                    {{ $pagination['currentPage'] === 1 ? $pagination['currentPage'] + 1 : $pagination['currentPage'] }}
                                </a>
                            </li>

                            <li class="page-item">
                                <a class="page-link" href="{{ route('users.index', [ 'page' => $pagination['nextPage'] ]) }}">
                                    {{ $pagination['currentPage'] === 1 ? $pagination['nextPage'] + 1 : $pagination['nextPage'] }}
                                </a>
                            </li>
                            <li class="page-item {{ $pagination['nextPage'] > $pagination['pages'] ? 'disabled': '' }}"">
                                <a href="{{ route('users.index', [ 'page' => $pagination['nextPage'] ]) }}" class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </body>
</html>

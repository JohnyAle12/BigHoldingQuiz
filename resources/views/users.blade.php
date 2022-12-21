@extends('layouts.main')

@section('content')
    <div class="col">
        <h2>Users</h2>
        <hr/>
        @include('layouts.alerts')
        <form action="{{ route('users.show') }}" method="GET" class="row g-3">
            <div class="col-auto">
              <input type="number" class="form-control" name="userId" placeholder="User Id" required>
            </div>
            <div class="col-auto">
              <button type="submit" class="btn btn-primary mb-3">Find user</button>
            </div>
        </form>
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
                        <td><a href="{{ route('users.transactions', $user->getUserId()) }}" class="btn btn-sm btn-success">Show transactions</a></td>
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
@endsection
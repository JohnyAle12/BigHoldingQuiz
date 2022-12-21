@extends('layouts.main')

@section('content')
    <div class="col">
        <h2>User</h2>
        <hr/>
        <div class="card">
            <div class="card-header">
                User Id {{ $user->getUserId() }}
            </div>
            <div class="card-body">
                <h5 class="card-title">About</h5>
                <ul>
                    <li>Date: {{ $user->getTimeStamps()['created_at'] }}</li>
                    <li>Identification: {{ $user->getIdentification() }}</li>
                    <li>Mobile: {{ $user->getMobileNumber() }}</li>
                    <li>Birth day: {{ $user->getBirthDate() }}</li>
                </ul>
              
            </div>
        </div>
        <h5 class="mt-4">Transactions</h5>
        <hr/>
        @include('layouts.transaction-table')
        <a href="{{ url()->previous() }}" class="btn btn-primary">Go back</a>
    </div>
@endsection
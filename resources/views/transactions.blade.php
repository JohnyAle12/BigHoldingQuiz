@extends('layouts.main')

@section('content')
    <div class="col">
        <h2>Transactions</h2>
        <hr/>

        @include('layouts.transaction-table')

        <a href="{{ url()->previous() }}" class="btn btn-primary">Go back</a>
    </div>
@endsection
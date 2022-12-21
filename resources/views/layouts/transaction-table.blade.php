@if ($transactions->isEmpty())
    <div class="bd-callout bd-callout-info">
        <h5 id="conveying-meaning-to-assistive-technologies">The user does not have transactions</h5>
        <p>
            You can go back and find another user with transactions
        </p>
    </div>
@else
    <table class="table table-striped table-hover">
        <thead>
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Date</th>
            <th scope="col">User</th>
            <th scope="col">Amount</th>
            <th scope="col">Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <th scope="row">{{ $transaction->getId() }}</th>
                    <td>{{ $transaction->getTimeStamps()['created_at'] }}</td>
                    <td>{{ $transaction->getUserId() }}</td>
                    <td>{{ $transaction->getAmount() }}</td>
                    <td>{{ $transaction->getDetail() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
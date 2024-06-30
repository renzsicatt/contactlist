<div class="position-relative p-5">

    <div class="center">
        <h3>WEB SOCKET</h>
    </div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Action</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($WebSocket as $WebSockets)
            <tr>
                <td>{{ $WebSockets->Action }}</td>
                <td>{{ $WebSockets->Date }}</td>
                @endforeach
        </tbody>
    </table>
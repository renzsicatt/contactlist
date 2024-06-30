<div class="position-relative p-5">

    <div class="center">
        <h3>AUDIT TRAIL</h>
    </div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Action</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ATrail as $ATrail)
            <tr>
                <td>{{ $ATrail->Action }}</td>
                <td>{{ $ATrail->Date }}</td>
                @endforeach
        </tbody>
    </table>
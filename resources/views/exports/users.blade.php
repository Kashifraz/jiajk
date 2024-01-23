<table>
    <thead>
        <tr>
            <th><b>name</b></th>
            <th><b>email</b></th>
            <th><b>Father name</b></th>
            <th><b>Cnic</b></th>
            <th><b>Gender</b></th>
            <th><b>Membership Date</b></th>
            <th><b>Geographical Address</b></th>
            <th><b>Local Jamat</b></th>
            <th><b>City</b></th>
            <th><b>Village</b></th>
            <th><b>Mailing Address</b></th>
            <th><b>Occupation</b></th>
            <th><b>Education</b></th>
            <th><b>Home Phone</b></th>
            <th><b>Office Phone</b></th>
            <th><b>Mobile Phone</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->father_name }}</td>
            <td>{{ $user->cnic }}</td>
            <td>{{ $user->gender }}</td>
            <td>{{ $user->membership_date }}</td>
            <td>{{ $user->geographical_address }}</td>
            <td>{{ $user->local_jamat }}</td>
            <td>{{ $user->city }}</td>
            <td>{{ $user->village }}</td>
            <td>{{ $user->mailing_address }}</td>
            <td>{{ $user->occupation }}</td>
            <td>{{ $user->education }}</td>
            <td>{{ $user->home_phone }}</td>
            <td>{{ $user->office_phone }}</td>
            <td>{{ $user->mobile_phone }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
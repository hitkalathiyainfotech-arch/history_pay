<table>
    <thead>
        <tr>
            <th>Session ID</th>
            <th>Logout</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sessions as $session)
            <tr>
                <td>{{ $session->id }}</td>
                <td>
                    <form action="{{ route('logout-session') }}" method="POST">
                        @csrf
                        <input type="hidden" name="session_id" value="{{ $session->id }}">
                        <button type="submit">Logout</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

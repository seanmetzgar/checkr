<a href="{{ route('candidates.create') }}">New Candidate</a>
@if($candidates)
    <table>
        <thead>
            <tr>
                <th>Candidate ID</th>
                <th>Name</th>
                <th>Reports</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
    @foreach($candidates as $candidate)
            <tr>
                <td>{{ $candidate->candidate_id }}</td>
                <td>{{ $candidate->last_name }}, {{ $candidate->first_name }}@unless($candidate->no_middle_name) {{ $middle_name }}@endunless</td>
                <td>... Reports ...</td>
                <td>... Actions ...</td>
            </tr>
    @endforeach
        </tbody>
    </table>
@else
None
@endif
<a href="{{ route('candidates.create') }}">New Candidate</a>
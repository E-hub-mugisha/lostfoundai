<h3>Admin Notification: ID Matched</h3>
<p>A lost ID and a found ID have matched.</p>
<ul>
    <li>Lost ID Number: {{ $lostDoc->id_number }} | Lost by: {{ $lostDoc->user->name }} ({{ $lostDoc->user->email }})</li>
    <li>Found by: {{ $foundDoc->user->name }} ({{ $foundDoc->user->email }})</li>
</ul>
<p>Both users have been notified.</p>

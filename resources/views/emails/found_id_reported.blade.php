<h3>Admin Notification: Found ID Reported</h3>
<p>User <strong>{{ $document->user->name }}</strong> has reported a found ID.</p>
<ul>
    <li>ID Number: {{ $document->id_number }}</li>
    <li>Names: {{ $document->names }}</li>
    <li>Date of Birth: {{ $document->dob ?? '-' }}</li>
    <li>Sex: {{ $document->sex ?? '-' }}</li>
    <li>Place of Issue: {{ $document->place_of_issue ?? '-' }}</li>
</ul>
<p>Uploaded File: <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank">View Document</a></p>

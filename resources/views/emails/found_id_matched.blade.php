<h3>Hello {{ $foundDoc->user->name }},</h3>
<p>The ID you found (ID Number: {{ $foundDoc->id_number }}) matches a previously reported lost ID.</p>
<p>Lost by: {{ $lostDoc->user->name }} (Email: {{ $lostDoc->user->email }})</p>
<p>Please contact the owner to return the ID safely.</p>

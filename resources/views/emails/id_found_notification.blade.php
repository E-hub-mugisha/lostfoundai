<h3>Hello {{ $lostDoc->user->name }},</h3>
<p>Good news! Your lost ID (ID Number: {{ $lostDoc->id_number }}) has been found.</p>
<p>Found by user: {{ $foundDoc->user->name }} (Email: {{ $foundDoc->user->email }})</p>
<p>Please contact the finder to retrieve your ID safely.</p>

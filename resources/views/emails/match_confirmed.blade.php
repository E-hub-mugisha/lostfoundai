<!DOCTYPE html>
<html>
<head>
    <title>Document Match Confirmed</title>
</head>
<body>
    <h1>Document Match Confirmed</h1>

    <p>Hello,</p>

    <p>A match has been confirmed between the found document and a lost document with the following details:</p>

    <h3>Found Document</h3>
    <ul>
        <li>Full Name: {{ $foundDoc->full_name }}</li>
        <li>ID Number: {{ $foundDoc->id_number }}</li>
        <li>ID Type: {{ $foundDoc->id_type }}</li>
        <li>Date Found: {{ $foundDoc->date_found ?? 'N/A' }}</li>
        <li>Location Found: {{ $foundDoc->location_found ?? 'N/A' }}</li>
    </ul>

    <h3>Lost Document</h3>
    <ul>
        <li>Full Name: {{ $lostDoc->full_name }}</li>
        <li>ID Number: {{ $lostDoc->id_number }}</li>
        <li>ID Type: {{ $lostDoc->id_type }}</li>
        <li>Date Lost: {{ $lostDoc->date_lost ?? 'N/A' }}</li>
        <li>Location Lost: {{ $lostDoc->location_lost ?? 'N/A' }}</li>
    </ul>

    <p>Please take the necessary steps to recover the document.</p>

    <p>Thanks,<br>Your Application Team</p>
</body>
</html>

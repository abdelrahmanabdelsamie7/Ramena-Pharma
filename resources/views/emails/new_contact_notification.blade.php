<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap');

        body {
            font-family: "Montserrat", sans-serif;
            background-color: rgb(241, 241, 241);
            text-align: center;
            padding: 20px;
        }

        .email-container {
            background: rgb(245, 245, 245);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
        }

        h2 {
            color: rgb(59, 145, 145);
        }

        h2 span {
            color: #035363;
            font-weight: 600;
        }

        p {
            color: rgb(59, 145, 145);
        }

        strong {
            font-size: 16px;
            font-weight: bold;
            font-family: "Source Sans 3", sans-serif;
            color: rgb(26, 79, 79);
        }
    </style>
</head>

<body>
    <div class="email-container">
        <h2>New Contact Message</h2>
        <p><strong>Name:</strong> {{ $contact->name }}</p>
        <p><strong>Email:</strong> {{ $contact->email }}</p>
        <p><strong>Phone:</strong> {{ $contact->phone }}</p>
        <p><strong>Message:</strong></p>
        <p>{{ $contact->message }}</p>

    </div>
</body>

</html>

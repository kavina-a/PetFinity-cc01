<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start Conversation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        label {
            font-size: 16px;
            margin-right: 10px;
        }
        select {
            width: 300px;
            padding: 8px;
            font-size: 16px;
        }
        button {
            padding: 8px 16px;
            font-size: 16px;
            margin-left: 10px;
            cursor: pointer;
        }
        form {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <form action="{{ route('conversation.store') }}" method="POST">
        @csrf
        <label for="boarder">Select a Pet Boarding Center:</label>
        <select name="boardingcenter_id" id="boarder">
            @foreach($boarders as $boarder)
                <option value="{{ $boarder->id }}">{{ $boarder->business_name }}</option>
            @endforeach
        </select>
        <button type="submit">Start Conversation</button>
    </form>
    

</body>
</html>

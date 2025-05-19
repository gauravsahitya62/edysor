<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Uploaded Excel Data</title>
</head>
<body style="font-family: Arial, sans-serif;">
    <h2>Uploaded Excel Data</h2>
    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr>
                @foreach(array_keys($uploads[0]) as $header)
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f8f8f8;">{{ ucfirst($header) }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($uploads as $row)
                <tr>
                    @foreach($row as $value)
                        <td style="border: 1px solid #ddd; padding: 8px;">{{ $value }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

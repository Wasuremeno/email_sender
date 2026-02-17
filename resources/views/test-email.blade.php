<!DOCTYPE html>
<html>
<head>
    <title>Test Email</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f5f5f5; }
        .container { max-width: 500px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; }
        input, button { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 4px; }
        button { background: #002F2E; color: white; border: none; cursor: pointer; }
        button:hover { background: #004544; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Send Test Email</h2>
        <form action="/send-test-email" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="company" placeholder="Company Name" required>
            <input type="text" name="vacancy" placeholder="Vacancy Title (optional)">
            <button type="submit">Send Email</button>
        </form>
    </div>
</body>
</html>
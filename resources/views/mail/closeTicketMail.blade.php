
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A support ticket has been closed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #ee6e2d;
            color: #ffffff;
            padding: 10px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .header h1 {
            margin: 0;
        }
        .order-details {
            padding: 20px;
            border-bottom: 1px solid #dddddd;
        }
        .order-details h2 {
            margin-top: 0;
        }
        .order-details p {
            margin: 5px 0;
        }
        .order-summary {
            padding: 20px;
        }
        .order-summary h2 {
            margin-top: 0;
        }
        .order-summary table {
            width: 100%;
            border-collapse: collapse;
        }
        .order-summary table, .order-summary th, .order-summary td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        .footer {
            background-color: #f4f4f4;
            color: #555555;
            padding: 10px;
            text-align: center;
            font-size: 12px;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }
        .footer p {
            margin: 5px 0;
        }
        .footer a {
            color: #007BFF;
            text-decoration: none;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }
        .col-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }
        .col-6 > div {
            background-color: lightgray;
            padding: 20px;
            margin: 5px 0;
            text-align: center;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h4 style="margin:0px; text-align: center;">The ticket has been closed by a admin. Here are the details:</h4>
        </div>
        <div class="order-details">
            <p><b>Ticket number: </b>{{$ticket->ticket_number}}</p>
            <p><b>Title: </b>{{$ticket->title}}</p>
            <p><b>Description: </b></p>
            <div style="border: 1px solid #000; padding:5px;">
                {{$ticket->description}}
            </div>
        </div>
    </div>
</body>
</html>
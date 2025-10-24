<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Found Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        
        .container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin: 10px 0 5px;
        }
        
        input,
        select {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        
        button {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            border: none;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        
        button:hover {
            background-color: #45a049;
        }
        
        .message {
            text-align: center;
            margin-top: 15px;
            color: green;
        }
                .btn {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            border: none;
            background-color: #f50808ff;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #f00a44ff;
        }
    </style>
</head>

<body>

   

    <div class="container">
        <h2>Submit Found Item Report</h2>
        <form id="foundForm" method="POST" action="submit_found.php" enctype="multipart/form-data">
            <label for="item_id">Lost Item ID:</label>
            <input type="number" id="item_id" name="item_id" required>

            <label for="finder_name">Your Name:</label>
            <input type="text" id="finder_name" name="finder_name" required>

            <label for="finder_contact">Contact Number:</label>
            <input type="text" id="finder_contact" name="finder_contact" required>

            <label for="location_found">Location Found:</label>
            <input type="text" id="location_found" name="location_found">

            <label for="date_found">Date Found:</label>
            <input type="date" id="date_found" name="date_found">
            <label for="date_found">Bank And Account No:</label>
            <input type="text" id="acc" name="acc">

            <label for="image">Upload Image (optional):</label>
            <input type="file" id="image" name="image" accept="image/*"> <br><br>

            <input type="submit" value="Submit Report">
            <button type="button" class="btn" onclick="window.location.href='../Index.html'">Cancel</button>
            <div class="message" id="message"></div>
        </form>
    </div>

    

</body>

</html>
<!DOCTYPE html>
<?php
   include('session.php');
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style> 

    a{
            text-align:center;
            margin: 0 auto;
            display: block;
            
            background-color: rgba(12, 109, 200, 0.76); /* Green */
            border: none;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 16px;
        }

    </style>
</head>
<body>

<div align="center">
<b> Welcome to Basketball League Database Application </b>
<br>
<br>
Here are the operations you can do in our application:
<br>
<br>
<br>


<a style = "display: inline-block;" href="insertion.php">Insert</a> &nbsp;&nbsp; 
<a style = "display: inline-block;" href="deletion.php">Delete</a>  &nbsp;&nbsp;
<a style = "display: inline-block;" href="selection_view.php">View</a>&nbsp;&nbsp;
<a style = "display: inline-block;" href="filter.php">Filter</a>&nbsp;&nbsp;


</div>
    
</body>
</html>

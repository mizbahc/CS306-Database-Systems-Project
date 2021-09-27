<?php
   include('session.php');
?>
<html>
    <head>
        <title>Country</title>
        <link rel="stylesheet" href="ali.css">
        <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            outline: none;
            margin-left: auto;
            margin-right: auto;
        }

        body {
            font-family: 'Poppings', sans-serif;
        }

        .wrapper {
            justify-content: center;
            padding: 20px 0;
            max-width: 400px;
            margin: 0 auto;
        }

        .menu {
            width: 100%;
        }

        select {
            width: 100%;
            padding: 15px;
            font-size: 16px;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            border: none;
            border-radius: 8px;
            border: 2px solid #3f51b5;
            box-shadow: 0 15px 15px #efefef;
            appearance: none;
            background: #e8eaf6;
            background-position: 95% 55%;
            background-size: 22px;
        }

        button{
            text-align:center;
            margin: 0 auto;
            display: block;
            background-color: #ff0000; /* Red */
            border: none;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 16px;
        }

        .form {
            float:right;
            font-weight: normal;
        }

        table, th, td {
            border: 1px solid black;
            padding: 6px;
        }

        table {
            border-collapse: collapse;
        }
        </style>
    </head>
    <body align="center">
        </br> </br>
        <h1> Deletion </h1>
        <a href="main.php"> Go to the main page</a>

        <?php
            include "../config.php";
            
            $sql_statement = "SHOW TABLES FROM cs306_basketball_project";
            $result = mysqli_query($db, $sql_statement);
            
        ?>
            <div class = "wrapper">
                <div class = "menu">
                    <form action="deletion.php" method="POST">
                        Select a table:
                        <select name="table_name" onchange="this.form.submit()">
                            <option value="" disabled selected><?php if (isset($_POST['table_name'])) {echo $_POST['table_name'];} else { echo 'Select';}?></option>
                            <?php
                                if($result) {
                                    while($table = mysqli_fetch_assoc($result)) { 
                                        foreach ($table as $key => $value) {
                                            echo "<option value =\"$value\">$value</option>";
                                        }
                                    }
                                }
                            ?>
                        </select>
                    </form>
                </div>
            </div>
            </br>
            
            <?php
            if (isset($_POST['table_name'])) {

                $table_name = $_POST['table_name'];
                
                if (isset($_POST['delete_id'])) {
                    $ids = $_POST['delete_id'];
                    $sql_statement = "DELETE FROM ".$table_name." WHERE ";
                    foreach ($ids as $key => $value) {
                        $sql_statement = $sql_statement.$key."=".$value." AND ";
                    }
                    $sql_statement = substr($sql_statement, 0, -4);
                    
                    $result = mysqli_query($db, $sql_statement);
                    
                }

                $sql_statement = "SHOW KEYS FROM ".$table_name." WHERE Key_name = 'PRIMARY'";
                $result = mysqli_query($db, $sql_statement);
                $key_columns=array();
                if($result) {
                    while($table = mysqli_fetch_assoc($result)) { 
                        array_push($key_columns, $table["Column_name"]);
                    }
                }

                $sql_statement = "SELECT * FROM $table_name";
                $result = mysqli_query($db, $sql_statement);
                echo "$table_name table <br/><br/>";

                if(!$result or mysqli_num_rows($result) === 0) {
                    echo 'It is empty!';
                }
                else {
                    $fieldinfo = $result -> fetch_fields();
                    
                    echo '<table> ';
                    echo "<tr>";
                    foreach ($fieldinfo as $val) {
                        echo "<td> ".$val -> name." </td>";
                    }
                    echo "</tr>";
                    while ($row = mysqli_fetch_assoc($result)) { 
                        echo "<tr>";
                        foreach ($row as $key => $value) {
                            echo "<td>".$value."</td>";
                        }
                        echo '<td><form action="deletion.php" method="POST"><input name="table_name" value="'.$table_name.'" hidden></input><button name="delete" value=".">X</button>';
                        foreach ($key_columns as $key => $value) {
                            echo '<input name="delete_id['.$value.']" value="'.$row[$value].'" hidden></input>';
                        }
                        echo "</form></td></tr>";
                    }
                    echo "</table>";
                }
            }
        ?>
    </body>
</html>

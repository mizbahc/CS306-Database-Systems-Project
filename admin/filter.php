<?php
   include('session.php');
?>
<html>
    <head>
        <title></title>
        
        <style>
        .column1 {
            margin-left:25px;
            float: left;
            width: 20%;
        }
        .column2 {
            margin-left:25px;
            padding-top:20px;
            float: left;
            width: 70%;
        }

        /* Clear floats after the columns */
        .row:after {
        content: "";
        display: table;
        clear: both;
        }
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
        <h1>Filter</h1>
        <a href="main.php"> Go to the main page</a>

        <?php
     
            include "../config.php";
       
            $sql_statement = "SHOW TABLES FROM cs306_basketball_project";
            $result = mysqli_query($db, $sql_statement);
            
        ?>
            <div class = "wrapper">
                <div class = "menu">
                    <form action="filter.php" method="POST">
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
            

                echo " <div class='row'>" ;
                echo " <div class='column1'> ";
                echo "<br> ";
                echo "<div class = 'filters'>";
                echo "Filter ";
                echo "<br><br> ";

                echo "<form action='filter.php' method='POST'>";

                echo "<select name='col'>";

                $sql_statement = "SELECT * FROM $table_name";
                $result = mysqli_query($db, $sql_statement);
                $fieldinfo = $result -> fetch_fields();
                    
                foreach ($fieldinfo as $val) {
                    $tmp = $val -> name;

                    echo "<option value ='$tmp'> $tmp </option>" ;
                }

                echo "</select>";
                echo "<br><br> ";
                
                echo "Min:<input type='text' name='min' ><br><br>";
                echo "Max:<input type='text' name='max' ><br><br>";
                echo "<input type='text' name='table_name' value=$table_name hidden></input>";
                echo "<button> FILTER </button>";
                echo "</form>";

                echo "<br> <br>";

                echo "<form  action='filter.php' method='POST'>";
                echo "<input type='text' name='table_name' value='$table_name' hidden></input>";
                echo "<button> CLEAR FILTERS </button>";
                echo "</form>";

                echo "</div>";
                echo "</div>";


                echo "<div class='column2'>";
                $result = "";


                if (isset($_POST['col']) && ($_POST['min'] !== '')  && ($_POST['max'] !== '') ) {
                    $col = $_POST['col'];
                    $min= '"'.$_POST['min'].'"';
                    $max = '"'.$_POST['max'].'"';

                    $sql_statement = "SELECT * FROM $table_name WHERE $col >= $min AND $col <= $max";
                    $result = mysqli_query($db, $sql_statement);

                }

                else if (isset($_POST['col']) && ($_POST['min'] !== '') ) {
                    $col = $_POST['col'];
                    $min= '"'.$_POST['min'].'"';

                    $sql_statement = "SELECT * FROM $table_name WHERE $col >= $min" ;
                    $result = mysqli_query($db, $sql_statement);
                   
                }
                
                else if (isset($_POST['col']) && ($_POST['max'] !== '') ) {
                    $col = $_POST['col'];
                    $max = '"'.$_POST['max'].'"';

                    $sql_statement = "SELECT * FROM $table_name WHERE $col <= $max" ;
                    $result = mysqli_query($db, $sql_statement);
                }
                
                
                else{
                    $sql_statement = "SELECT * FROM $table_name";
                    $result = mysqli_query($db, $sql_statement);

                }

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
                        echo "</form></td></tr>";
                    }
                    echo "</table>";

                    
                }
            

                    
                
                echo "</div>";
                echo "</div> ";
                
               
            }
        ?>
    </body>
</html>

<?php

// include "display_table.php";
?>

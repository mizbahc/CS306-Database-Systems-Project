<!DOCTYPE html>
<html>

<head>
    <title> Basketball League Database Application </title>

    <link rel="stylesheet" href="styles/selection_view.css">
    <!-- BOOTSTRAP CSS -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <style>
        thead {
            border-bottom: 1px solid rgba( 0, 0, 0, 0.30 );
            box-sizing: border-box;
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
            border-collapse: separate;
            border-spacing: 0;
            font-family: MorganSansRegular,Arial;
            font-size: 16px;
            font-weight: 100;
        }
        hr {
            display: block;
            unicode-bidi: isolate;
            margin-block-start: 0.5em;
            margin-block-end: 0.5em;
            margin-inline-start: auto;
            margin-inline-end: auto;
        }
        hr.section-title {
            overflow: visible;
            padding: 0;
            border: none;
            color: #000;
            text-align: center;
            height: 2px;
            background-image: linear-gradient(to right,rgba(0,0,0,0),rgba(0,0,0,.5),rgba(0,0,0,0));
        }

    </style>
</head>

<?php
  include "config.php";
?>

<body style = "background-color: #f6f6f6">
    <!--<div class="dashboard">
        <div class="header">
           
            <h1 class="title text-center"> Basketball App </h1>
        </div>-->

        <ul style ="box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);">
            <li>&nbsp;&nbsp;&nbsp;&nbsp;</li>
            <li><img src="src/logoBlack.jpg" height = "50">&nbsp;&nbsp;</li>
            <li><a href="index.php">Home</a></li>
            <li><a href="teams.php">Teams</a></li>
            <li><a href="players.php">Players</a></li>
            <li><a href="games.php" class="active">Games</a></li>
        </ul>
    </br>




    <div class="container" >
        <div class="row text-center m-0 p-1 align-items-center">
            <?php
            $team_id = $_POST["team_id"];
            $team_stat_query = "SELECT * FROM team_stats WHERE tid=".$team_id;
            $team_stats =  mysqli_query($db, $team_stat_query);
            
            $sql_statement = "SELECT T.name, CONCAT(C.f_name,\" \",C.l_name) as coach_name FROM coaches C LEFT JOIN (teams T JOIN manages M USING (tid)) USING (cid) WHERE tid=$team_id";
            $team_details =  mysqli_query($db, $sql_statement);
            
            $row = mysqli_fetch_assoc($team_details);

            echo "<h1 class='text-left' >".$row["name"]."</h1>";
            echo "<h4 class='text-left' > Coach: <span style='font-weight: 200;'>".$row["coach_name"]."</span></h4>";
            //echo "<h3>".$row[""]." - ".$row["place"]."</h3>";
            ?>
        </div>

        </br>

        <hr class="section-title">


        <div class="row text-center m-0 p-1 align-items-center bg-c-league">
            <?php
                $sql_statement = "";
                $result = mysqli_query($db, $team_stat_query);
                $fieldinfo = $result -> fetch_fields();
            ?>

            <table class="table table-striped" style ="box-shadow: 0 0 10px 0 rgb(208 208 208 / 50%);">
                <thead>
                    <tr>
                    <?php
                    if(isset($fieldinfo)) {
                        foreach ($fieldinfo as $val) {
                            echo "<th style=\"text-align:center\">".$attributes[$val -> name]." </th>";
                        }
                    }
                    ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            foreach ($row as $key => $value) {
                                echo "<td style=\"text-align:center\">".$value."</td>";
                            }
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</body>
</html>

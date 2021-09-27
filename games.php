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

        <div class="row p-2 title">
            <div class="col-12 mt-2">
                <h1 class="custom-font-bold text-center mb-0" style = "color:black;">
                GAMES
                </h1>
            <hr class="section-title">
            </div>
        </div>

    </br>

    <div class="container">
        <div class="row text-center m-0 p-1 align-items-center filters">
            <form action='games.php' method='POST'>
                <div class="form-row">
                    <div class="form-group col-sm-4">
                        <label for="col">Select Team</label>
                        <select id="team" name="team" class="form-control">
                            <?php
                            $sql_statement = "SELECT * FROM teams";
                            $result = mysqli_query($db, $sql_statement);
                            echo "<option name =\"team_id\" value=\"\" disabled selected></option>";

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option name =\"team_id\" value=".$row["tid"].">".$row["name"]."</option>";
                            }

                            ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="start">Games Since</label>
                        <input type="date" class="form-control" id="start_date" name="start_date">
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="end">Games Till</label>
                        <input type="date" class="form-control" id="end_date" name="end_date">
                    </div>
                </div>
                <div class="form-row">
                    <button type="submit" class="btn btn-primary" style="margin-right:19px">Filter</button>
                    <form action='games.php' method='POST'>
                        <button type="submit" class="btn btn-primary">Clear Filters</button>
                    </form>
                </div>
            </form>
        </div>

        </br>

        <hr class="section-title">


        <div class="row text-center m-0 p-1 align-items-center bg-c-league">
            <?php
                $sql_statement = "SELECT game_id, game_date, CONCAT(t1.name,' ',home_score,' - ',away_score,' ',t2.name) AS match_result, place
                FROM games
                LEFT JOIN teams AS t1
                ON home_id = t1.tid
                LEFT JOIN teams AS t2
                ON away_id = t2.tid";

                $conditions = array();

                if (isset($_POST['team']) && $_POST['team']!=="") {
                    $team = '"'.$_POST['team'].'"';
                    array_push($conditions, "(t1.tid=$team OR t2.tid=$team)");
                }
                if (isset($_POST['start_date']) && $_POST['start_date']!=="") {
                    $start_date = '"'.$_POST['start_date'].'"';
                    array_push($conditions, "(game_date >= $start_date)");
                }
                if (isset($_POST['end_date']) && $_POST['end_date']!=="") {
                    $end_date = '"'.$_POST['end_date'].'"';
                    array_push($conditions, "(game_date <= $end_date)");
                }

                if(count($conditions)!==0) {
                    $where = " WHERE ".implode(" AND ", $conditions);
                    $sql_statement = $sql_statement.$where;
                }
                $sql_statement = $sql_statement." ORDER BY games.game_date DESC";
                $result = mysqli_query($db, $sql_statement);


                if(!$result or mysqli_num_rows($result) === 0) {
                    echo 'No matches found!';
                }

                else {
                    $fieldinfo = $result -> fetch_fields();
                }
            ?>


            <table class="table table-striped" style ="box-shadow: 0 0 10px 0 rgb(208 208 208 / 50%);">
                <thead>
                    <tr>
                    <?php
                    if(isset($fieldinfo)) {
                        foreach ($fieldinfo as $val) {
                            if($val->name !== "game_id")
                                echo "<th style=\"text-align:center\">".$attributes[$val -> name]." </th>";
                        }
                        echo "<th></th>";
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
                                if($key!=="game_id")
                                    echo "<td style=\"text-align:center\">".$value."</td>";
                            }
                            echo "
                            <td style=\"text-align:center\">
                                <form method=\"POST\" action=\"game.php\">
                                    <input name=\"game_id\" value=\"".$row["game_id"]."\"hidden></input>
                                    <button class=\"btn btn-primary\">Details
                                    </button>
                                </form>
                            </td>";
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

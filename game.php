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
    <!-- <div class="dashboard">
        <div class="header">
           
            <h1 class="title text-center"> Basketball App </h1>
        </div> -->

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
                GAME DETAILS
                </h1>
            <hr class="section-title">
        </div>
    </div>

    </br>




    <div class="container">
        <div class="row text-center m-0 p-1 align-items-center">
            <?php
            $game_id = $_POST["game_id"];
            $sql_statement = "SELECT CONCAT(t1.name,' ',home_score,' - ',away_score,' ',t2.name) AS match_result, place, DATE_FORMAT(game_date, '%d/%m/%Y') as game_date
                FROM games
                LEFT JOIN teams AS t1
                ON home_id = t1.tid
                LEFT JOIN teams AS t2
                ON away_id = t2.tid
                WHERE game_id=$game_id";
            $result =  mysqli_query($db, $sql_statement);
            $row = mysqli_fetch_assoc($result);
            echo "<h1>".$row["match_result"]."</h1>";
            echo "<h3>".$row["game_date"]." - ".$row["place"]."</h3>";
            ?>
        </div>

        </br>

        <hr class="section-title">


        <div class="row text-center m-0 p-1 align-items-center bg-c-league">
            <?php
                $sql_statement = "SELECT teams.name AS team_name, CONCAT(players.f_name, ' ', players.l_name) as pname, ps.points, ps.assists, ps.rebounds, ps.steals, ps.blocks, ps.mins_played
                FROM player_stats AS ps
                LEFT JOIN players ON ps.player_id=players.player_id
                LEFT JOIN plays_for ON ps.player_id=plays_for.player_id
                LEFT JOIN teams ON teams.tid=plays_for.tid
                WHERE game_id=$game_id
                ORDER BY ps.points DESC";

                $result = mysqli_query($db, $sql_statement);

                if(!$result or mysqli_num_rows($result) === 0) {
                    echo 'Match not found!';
                }

                else {
                    $fieldinfo = $result -> fetch_fields();
                }
            ?>

            <table class="table table-striped" style ="box-shadow:0 0 10px 0 rgb(208 208 208 / 50%);">
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

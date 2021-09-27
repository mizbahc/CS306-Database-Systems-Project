<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="styles/selection_view.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <style>
        .team_filter{
            margin-bottom: 20px;
        }
        .filters{
            margin-top: 30px;
        }

        .avatar{
            width: 2em;
            height: 2em;
        }
        .table {
            text-align: left !important;
            margin-top: 30px;
        }


    </style>

    </head>

    <body style = "background-color: #f6f6f6">
    <ul style ="box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);">
        <li>&nbsp;&nbsp;&nbsp;&nbsp;</li>
        <li><img src="src/logoBlack.jpg" height = "50">&nbsp;&nbsp;</li>
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="teams.php">Teams</a></li>
        <li><a href="players.php">Players</a></li>
        <li><a href="games.php">Games</a></li>
        
      </ul>


        <?php
            include "config.php";
            $tables = "SELECT P.player_id, P.f_name, P.l_name, P.birth_date, P.height, T.name, PF.start_date, PF.end_date
                        from players P LEFT JOIN (teams T JOIN plays_for PF USING (tid)) USING (player_id) ";

            $result = mysqli_query($db, $tables);
            $fieldinfo = $result -> fetch_fields();
            $teams_sql =  "SELECT T.name FROM teams T";
            $teams_result = mysqli_query($db,$teams_sql);
            $team = "";
        ?>


        <div class="container">

            <div class="row p-2 title">

                <div class="col-12 mt-2">
                    <h1 class="custom-font-bold text-center mb-0" style = "color: black;">
                        PLAYERS
                    </h1>
                    <hr class="section-title">
                </div>
            </div>
            <div class="row text-center m-0 p-1 align-items-center team_filter">
                <div class="form-row">
                    <form action='players.php' method='POST'>
                        <div class="form-group col-12">
                        <label for="team">Filter By Team</label>
                        <select id="team" name="team" class="form-control" onchange="this.form.submit()">
                        <option value="" disabled selected><?php if (isset($_POST['team']) && $_POST['team'] !== ''){$team = $_POST['team']; echo $team; } else { echo 'Choose Team';}?></option>

                            <?php

                                while ($row = mysqli_fetch_assoc($teams_result)) {
                                    foreach ($row as $key => $value) {
                                        echo "<option value ='$value'> $value </option>" ;
                                    }
                                }
                            ?>
                        </select>
                     </form>
                </div>

            </div>

            <div class="row p-2 text-center m-0 p-1 align-items-center filters">
                <form action='players.php' method='POST'>
                     <div class="form-row">
                        <div class="form-group col-sm-4">
                        <label for="col">Choose Filter</label>
                        <select id="col" name="col" class="form-control">
                            <?php
                                foreach ($fieldinfo as $val) {
                                    $tmp = $val -> name;

                                    echo "<option value ='$tmp'> $attributes[$tmp] </option>" ;
                                }
                            ?>
                        </select>
                        </div>
                        <div class="form-group col-sm-4">
                        <label for="min">Min</label>
                        <input type="text" class="form-control" id="min" name="min" placeholder="Min">
                        </div>
                        <div class="form-group col-sm-4">
                        <label for="max">Max</label>
                        <input type="text" class="form-control" id="max" name="max" placeholder="Max">
                        <input type='text' name='team' value='<?php if (isset($_POST['team']) && $_POST['team'] !== '') {echo $_POST['team'];} else { echo "";}?>' hidden></input>

                        </div>
                    </div>
                    <div class="form-row">
                        <button type="submit" class="btn btn-primary" style="margin-right:19px">Filter</button>
                        <form action='players.php' method='POST'>
                            <input type='text' name='team' value='' hidden></input>
                            <button type="submit" class="btn btn-primary">Clear Filters</button>
                        </form>
                    </div>
                </form>

            </div>




            <div class="row text-center m-0 p-1 align-items-center ">

                <hr class="section-title">

            <?php
                //<?php if (isset($_POST['team'])) {echo " value='$_POST['team']' ";} else { echo " value='' ";}
                //SELECT P2.tid from (SELECT P1.player_id, P1. FROM players P1 LEFT JOIN plays_for PF ON P1.player_id = PF.player_id) P2 LEFT JOIN teams T ON P2.tid = T.tid ;
                //SELECT * from players JOIN (teams JOIN plays_for USING (tid)) USING (player_id)
                $result = "";
                if (isset($_POST['team']) && ($_POST['team'] !== '')) {
                    $tables = "". $tables ." WHERE T.name = '". $_POST['team']. "'";

                    if (isset($_POST['col']) && ($_POST['min'] !== '')  && ($_POST['max'] !== '') ) {
                        $col = $_POST['col'];
                        $min= '"'.$_POST['min'].'"';
                        $max = '"'.$_POST['max'].'"';

                        $sql_statement = "$tables AND $col >= $min AND $col <= $max";
                        $result = mysqli_query($db, $sql_statement);

                    }

                    else if (isset($_POST['col']) && ($_POST['min'] !== '') ) {
                        $col = $_POST['col'];
                        $min= '"'.$_POST['min'].'"';

                        $sql_statement = "$tables AND $col >= $min" ;
                        $result = mysqli_query($db, $sql_statement);

                    }

                    else if (isset($_POST['col']) && ($_POST['max'] !== '') ) {
                        $col = $_POST['col'];
                        $max = '"'.$_POST['max'].'"';

                        $sql_statement = "$tables AND $col <= $max" ;
                        $result = mysqli_query($db, $sql_statement);
                    }


                    else{
                        $sql_statement = $tables;
                        $result = mysqli_query($db, $sql_statement);

                    }
                }
                else{
                    if (isset($_POST['col']) && ($_POST['min'] !== '')  && ($_POST['max'] !== '') ) {
                        $col = $_POST['col'];
                        $min= '"'.$_POST['min'].'"';
                        $max = '"'.$_POST['max'].'"';

                        $sql_statement = "$tables WHERE $col >= $min AND $col <= $max";
                        $result = mysqli_query($db, $sql_statement);

                    }

                    else if (isset($_POST['col']) && ($_POST['min'] !== '') ) {
                        $col = $_POST['col'];
                        $min= '"'.$_POST['min'].'"';

                        $sql_statement = "$tables WHERE $col >= $min" ;
                        $result = mysqli_query($db, $sql_statement);

                    }

                    else if (isset($_POST['col']) && ($_POST['max'] !== '') ) {
                        $col = $_POST['col'];
                        $max = '"'.$_POST['max'].'"';

                        $sql_statement = "$tables WHERE $col <= $max" ;
                        $result = mysqli_query($db, $sql_statement);
                    }


                    else{
                        $sql_statement = $tables;
                        $result = mysqli_query($db, $sql_statement);

                    }

                }

                if(!$result or mysqli_num_rows($result) === 0) {
                    echo 'It is empty!';
                }
                else {
                    $fieldinfo = $result -> fetch_fields();

                }

            ?>

            <table class="table table-striped" style ="box-shadow: 0 0 10px 0 rgb(208 208 208 / 50%);">
                <thead>
                    <tr>
                    <th scope='col'> </td>
                    <?php
                        foreach ($fieldinfo as $val) {
                            echo "<th scope='col'>".$attributes[$val -> name]." </td>";
                        }
                    ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td> <img src='./src/avatar.png' alt=' ' class='avatar'></td>";
                            foreach ($row as $key => $value) {
                                echo "<td>".$value."</td>";
                            }
                            echo "</tr>";
                        }
                    ?>


                </tbody>
            </table>

            </div>


        </div>


    </body>
</html>

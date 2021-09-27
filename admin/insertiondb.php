<?php
include "../config.php";
include('session.php');    
// players
if (isset($_POST['player_id']) and isset($_POST['f_name']) and isset($_POST['l_name']) and isset($_POST['birth_date']) and isset($_POST['height'])) {

    $player_id = $_POST['player_id'];
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $birth_date = $_POST['birth_date'];
    $height = $_POST['height'];

    $sql_statement = "INSERT INTO players(player_id, f_name, l_name,
                                  birth_date, height)
                      VALUES ('$player_id', '$f_name', '$l_name', '$birth_date', '$height')";



$result = mysqli_query($db, $sql_statement);
    
echo " My result is" . $result;
}

// plays_for
else if (isset($_POST['start_date']) and isset($_POST['end_date']) and isset($_POST['tid']) and isset($_POST['player_id'])) {
    
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $tid = $_POST['tid'];
    $player_id = $_POST['player_id'];
    

    $sql_statement = "INSERT INTO plays_for(start_date, end_date, tid,
                                  player_id)
                      VALUES ('$start_date', '$end_date', '$tid', '$player_id')";



$result = mysqli_query($db, $sql_statement);

echo " My result is" . $result;
}


// team_stats
else if (isset($_POST['tid']) and isset($_POST['s_year']) and isset($_POST['home_win']) and isset($_POST['away_win']) and isset($_POST['home_loses']) 
        and isset($_POST['away_loses']) and isset($_POST['total_scored']) and isset($_POST['standing'])) {

    $tid = $_POST['tid'];
    $s_year = $_POST['s_year'];
    $home_win = $_POST['home_win'];
    $away_win = $_POST['away_win'];
    $home_loses = $_POST['home_loses'];
    $away_loses = $_POST['away_loses'];
    $total_scored = $_POST['total_scored'];
    $standing = $_POST['standing'];

    $sql_statement = "INSERT INTO team_stats(tid, s_year, home_win,
                                  away_win, home_loses, away_loses, total_scored, standing)
                      VALUES ('$tid', '$s_year', '$home_win', '$away_win', '$home_loses', '$away_loses', '$total_scored', '$standing')";



$result = mysqli_query($db, $sql_statement);
    
echo " My result is" . $result;
}


// seasons
else if (isset($_POST['s_year'])) {
    
    $s_year = $_POST['s_year'];
   

    $sql_statement = "INSERT INTO seasons(s_year)
                      VALUES ('$s_year')";



$result = mysqli_query($db, $sql_statement);

echo " My result is" . $result;
}





// teams
else if (isset($_POST['name']) and isset($_POST['tid'])) {
    
    $name = $_POST['name'];
    $tid = $_POST['tid'];

    $sql_statement = "INSERT INTO teams(name, tid)
                      VALUES ('$name', '$tid')";



$result = mysqli_query($db, $sql_statement);

echo " My result is" . $result;
}



// player_stats
else if (isset($_POST['player_id']) and isset($_POST['game_id']) and isset($_POST['rebounds']) and isset($_POST['points']) and isset($_POST['mins_played']) 
        and isset($_POST['assists']) and isset($_POST['blocks']) and isset($_POST['steals'])) {

    $player_id = $_POST['player_id'];
    $game_id = $_POST['game_id'];
    $rebounds = $_POST['rebounds'];
    $points = $_POST['points'];
    $mins_played = $_POST['mins_played'];
    $assists = $_POST['assists'];
    $blocks = $_POST['blocks'];
    $steals = $_POST['steals'];

    $sql_statement = "INSERT INTO player_stats(player_id, game_id, rebounds,
                                  points, mins_played, assists, blocks, steals)
                      VALUES ('$player_id', '$game_id', '$rebounds', '$points', '$mins_played', '$assists', '$blocks', '$steals')";



$result = mysqli_query($db, $sql_statement);
    
echo " My result is" . $result;
}

//games
else if (isset($_POST['game_id']) and isset($_POST['place']) and isset($_POST['home_score']) and isset($_POST['away_score']) and isset($_POST['home_id']) 
        and isset($_POST['away_id']) and isset($_POST['game_date'])) {

    $game_id = $_POST['game_id'];
    $place = $_POST['place'];
    $home_score = $_POST['home_score'];
    $away_score = $_POST['away_score'];
    $home_id = $_POST['home_id'];
    $away_id = $_POST['away_id'];
    $game_date = $_POST['game_date'];
    

    $sql_statement = "INSERT INTO games(game_id, place, home_score,
                                  away_score, home_id, away_id, game_date)
                      VALUES ('$game_id', '$place', '$home_score', '$away_score', '$home_id', '$away_id', '$game_date')";


$result = mysqli_query($db, $sql_statement);
    
echo " My result is" . $result;
}

//plays
else if (isset($_POST['game_id']) and isset($_POST['tid'])) {
    
    $game_id = $_POST['game_id'];
    $tid = $_POST['tid'];

    $sql_statement = "INSERT INTO plays(game_id, tid)
                      VALUES ('$game_id', '$tid')";



$result = mysqli_query($db, $sql_statement);

echo " My result is" . $result;
}

//manages
else if (isset($_POST['start_date']) and isset($_POST['end_date']) and isset($_POST['tid']) and isset($_POST['cid'])) {
    
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $tid = $_POST['tid'];
    $cid = $_POST['cid'];
    

    $sql_statement = "INSERT INTO manages(start_date, end_date, tid,
                                  cid)
                      VALUES ('$start_date', '$end_date', '$tid', '$cid')";



$result = mysqli_query($db, $sql_statement);

echo " My result is" . $result;
}

//coaches
else if (isset($_POST['f_name']) and isset($_POST['l_name']) and isset($_POST['cid'])) {
    
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $cid = $_POST['cid'];
    
    

    $sql_statement = "INSERT INTO coaches(f_name, l_name, cid)
                      VALUES ('$f_name', '$l_name', '$cid')";



$result = mysqli_query($db, $sql_statement);

echo " My result is" . $result;
}

else {
    echo "The form is not set yet.";
}

?>

<?php 
    header("Location: insertion.php"); 
?>

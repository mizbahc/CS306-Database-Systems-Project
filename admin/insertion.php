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
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            outline: none;
        }
        
        body {
            font-family: 'Poppings', sans-serif;
        }
         .wrapper {
            justify-content: center;
            padding: 70px 0;
            max-width: 400px;
            margin: 0 auto;
        }
       
        .menu, .content {
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

        .content {
            margin: 50px 0;
        }
        .content  .data {
            padding: 25px;
            background-color: #fff;
            border: 2px solid #8bc34a;
            border-radius: 8px;
            
        }
        
        .content p{
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid gainsboro;
        }
        .content p:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        } 
         .content p b {
            font-weight: 700;
        }
        .content p span {
            float: right;
            font-weight: normal;
        }

        button{
            text-align:center;
            margin: 0 auto;
            display: block;
            background-color: #4CAF50; /* Green */
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
        
        .data {
            display: none;
        }
    </style>
</head>
<body>
<div align="center">
    <b> Welcome to Basketball League Database Application </b>
    <br> <br>
    Fill the information to insert into tables.
    <br><br><br>
    <a href="main.php"> Go to the main page</a> <br><br>

    <label for="tables">Choose a table to insert:</label>
</div>




<div class = "wrapper">
    <div class = "menu">
        <select id="tables">
            <option value ="players">Players</option>
            <option value ="player_stats">Player Stats</option>
            <option value ="plays">Plays</option>
            <option value ="plays_for">Plays for</option>
            <option value ="teams">Teams</option>
            <option value ="team_stats">Team Stats</option>
            <option value ="seasons">Seasons</option>
            <option value ="coaches">Coaches</option>
            <option value ="manages">Coach Manages</option>
            <option value ="games">Games</option>
        </select>
    </div>
    
     
<div class = "content">
    <div id = "players" class = "data">
        
        <form  action="insertiondb.php" method="POST">
            <nobr><b> Player id: </b></nobr><input type="text" name="player_id" placeholder="Type player id"><br><br>
            <nobr><b> Firstname: </b></nobr><input type="text" name="f_name" placeholder="Type player's firstname"><br><br>
            <nobr><b> Lastname: </b></nobr><input type="text" name="l_name" placeholder="Type player's lastname"><br><br>
            <nobr><b> Birth Date: </b></nobr><input type="date" name="birth_date" placeholder="Type player's birth date"><br><br>
            <nobr><b> Player's height: </b></nobr><input type="number" name="height" placeholder="Type player's height'"><br><br>
            <button> Insert </button>
        </form>
        
    </div>

    <div id = "player_stats" class = "data">
        
        <form  action="insertiondb.php" method="POST">
            <nobr><b> Player id: </b></nobr><input type="text" name="player_id" placeholder="Type player id"><br><br>
            <nobr><b> Game id: </b></nobr><input type="text" name="game_id" placeholder="Type Game id"><br><br>
            <nobr><b> Rebounds: </b></nobr><input type="number" name="rebounds" placeholder="Type player's rebounds"><br><br>
            <nobr><b> Points: </b></nobr><input type="number" name="points" placeholder="Type player's points"><br><br>
            <nobr><b> Mins Played: </b></nobr><input type="number" name="mins_played" placeholder="Type the mins player played"><br><br>
            <nobr><b> Assists: </b></nobr><input type="number" name="assists" placeholder="Type player's assists'"><br><br>
            <nobr><b> Blocks: </b></nobr><input type="number" name="blocks" placeholder="Type player's blocks'"><br><br>
            <nobr><b> Steals: </b></nobr><input type="number" name="steals" placeholder="Type player's steals'"><br><br>
            <button> Insert </button>
        </form>
        
    </div>

    <div id = "teams" class = "data">

        <form action="insertiondb.php" method="POST">
            <nobr><b> Team name: </b></nobr><input type="text" name="name" placeholder="Type team name"><br><br>
            <nobr><b> Team id: </b></nobr><input type="text" name="tid" placeholder="Type team id"><br><br>
            <button> Insert </button>
        </form>

    </div>

    <div id = "team_stats" class = "data">
        
        <form  action="insertiondb.php" method="POST">
            <nobr><b> Team id: </b></nobr><input type="text" name="tid" placeholder="Type team id"><br><br>
            <nobr><b> Season year: </b></nobr><input type="number" name="s_year" placeholder="Type season year"><br><br>
            <nobr><b> Home wins: </b></nobr><input type="number" name="home_win" placeholder="Type home wins"><br><br>
            <nobr><b> Home loses: </b></nobr><input type="number" name="home_loses" placeholder="Type home loses"><br><br>
            <nobr><b> Away wins: </b></nobr><input type="number" name="away_win" placeholder="Type away wins"><br><br>
            <nobr><b> Away loses: </b></nobr><input type="number" name="away_loses" placeholder="Type away loses"><br><br>
            <nobr><b> Total scored: </b></nobr><input type="number" name="total_scored" placeholder="Type total scored points"><br><br>
            <nobr><b> Standing in season: </b></nobr><input type="number" name="standing" placeholder="Type standing in the season"><br><br>
            <button> Insert </button>
        </form>
        
    </div>

    <div id = "plays_for" class = "data">

        <form action="insertiondb.php" method="POST">
            <nobr><b> Start date: </b></nobr><input type="date" name="start_date" placeholder="Type start date"><br><br>
            <nobr><b> End date: </b></nobr><input type="date" name="end_date" placeholder="Type end date"><br><br>
            <nobr><b> Team id: </b></nobr><input type="text" name="tid" placeholder="Type team id"><br><br>
            <nobr><b> Player id: </b></nobr><input type="text" name="player_id" placeholder="Type player id"><br><br>
            <button> Insert </button>
        </form>

    </div>

    <div id = "seasons" class = "data">

        <form action="insertiondb.php" method="POST">
            <nobr><b> Season year: </b></nobr><input type="number" name="s_year" placeholder="Type season year"><br><br>
            <button> Insert </button>
        </form>

    </div>

    <div id = "coaches" class = "data">

        <form action="insertiondb.php" method="POST">
            <nobr><b> Firstname: </b></nobr><input type="text" name="f_name" placeholder="Type coach's firstname"><br><br>
            <nobr><b> Lastname: </b></nobr><input type="text" name="l_name" placeholder="Type coach's lastname"><br><br>          
            <nobr><b> Coach id: </b></nobr><input type="text" name="cid" placeholder="Type coach id"><br><br>
            <button> Insert </button>
        </form>

    </div>

    <div id = "manages" class = "data">

        <form action="insertiondb.php" method="POST">
            <nobr><b> Start date: </b></nobr><input type="date" name="start_date" placeholder="Type start date"><br><br>
            <nobr><b> End date: </b></nobr><input type="date" name="end_date" placeholder="Type end date"><br><br>
            <nobr><b> Team id: </b></nobr><input type="text" name="tid" placeholder="Type team id"><br><br>
            <nobr><b> Coach id: </b></nobr><input type="text" name="cid" placeholder="Type coach id"><br><br>
            <button> Insert </button>
        </form>

    </div>

    <div id = "plays" class = "data">

        <form action="insertiondb.php" method="POST">
            <nobr><b> Game id: </b></nobr><input type="text" name="game_id" placeholder="Type game id"><br><br>
            <nobr><b> Team id: </b></nobr><input type="text" name="tid" placeholder="Type team id"><br><br>
            <button> Insert </button>
        </form>

    </div>

    <div id = "games" class = "data">

        <form action="insertiondb.php" method="POST">
            <nobr><b> Game id: </b></nobr><input type="text" name="game_id" placeholder="Type game id"><br><br>
            <nobr><b> Place: </b></nobr><input type="text" name="place" placeholder="Type the place game was played"><br><br>
            <nobr><b> Home score: </b></nobr><input type="number" name="home_score" placeholder="Type home score"><br><br>
            <nobr><b> Away score: </b></nobr><input type="number" name="away_score" placeholder="Type away score"><br><br>
            <nobr><b> Home id: </b></nobr><input type="number" name="home_id" placeholder="Type home id"><br><br>
            <nobr><b> Away id: </b></nobr><input type="number" name="away_id" placeholder="Type away id"><br><br>
            <nobr><b> Game date: </b></nobr><input type="date" name="game_date" placeholder="Type game date"><br><br>
            <button> Insert </button>
        </form>

    </div>

</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#tables").on('change', function() {
            $(".data").hide();
            $("#" + $(this).val()).fadeIn(700);
        }).change();
    });
</script>


</body>
</html>

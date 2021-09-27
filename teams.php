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
#teams_id td {
  padding: 16px;
  text-align:center;
}

#teams_h_id td {
  padding-bottom :8px;
  text-align:center;
  font-weight: bold;
  font-size: 14.5px;
}

td > a:first-child {
  text-decoration: none;
  color: inherit;
  display: inline-block;
   position: relative;
   z-index: 1;
   padding: 1.5em;
   margin: -2em;
}
a {
  color: #5165ff;
}

.inline_input {
    display: inline-block;
    float: left;
    vertical-align: top;
    margin: 6px;
}

.size_box {
    height: 33px;
}

#teams_id:hover,
focus-within {
  background: #f2f3ff;
  outline: none;
}
</style>
</head>

<body align = "center" style = "background-color: #f6f6f6">
  <!--<div class="dashboard" align="center">
    <div class="header">

    
      <h1 class="title"> Basketball App </h1>

    </div>-->
      <ul style ="box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);">
        <li>&nbsp;&nbsp;&nbsp;&nbsp;</li>
        <li><img src="src/logoBlack.jpg" height = "50">&nbsp;&nbsp;</li>
        <li><a href="index.php">Home</a></li>
        <li><a class="active" href="teams.php">Teams</a></li>
        <li><a href="players.php">Players</a></li>
        <li><a href="games.php">Games</a></li>
      </ul>

      <div class = "container">
    <div class ="row p-2" >
      <div class ="col-12 mt2">
          <h1> TEAMS </h1>
          <hr class ="section-title">
            <br>
          </hr>
      </div>
    </div>



    <div class = "col-12">
          <?php
        include 'config.php';
        $sql_statement = "SELECT T.tid, T.name, CONCAT(C.f_name,\" \",C.l_name) as coach_name FROM coaches C LEFT JOIN (teams T JOIN manages M USING (tid)) USING (cid)";
        $calculate_total_player = "SELECT PF.tid, T.tid, count(*) as total_player from teams T left join plays_for PF on T.tid = PF.tid group by T.name, T.tid";
        // $total_stats = "select ts.tid, count(*) as total_season, SUM(home_win + away_win) as total_win, SUM(away_win + away_loses) as total_loss from Team_stats ts group by ts.tid";
        
        $result = mysqli_query($db, $sql_statement);
        $total_player_table = mysqli_query($db, $calculate_total_player);

        $fieldinfo = $result -> fetch_fields();
        $fieldplayer = $total_player_table -> fetch_fields();

        $total_players = array();
        while ($row_user = $total_player_table->fetch_array()) {
            if ($row_user[0] != null) {
            $total_players[$row_user[1]] = $row_user[2];
            }
            else {$total_players[$row_user[1]] = 0;}
        }

        // FILTER BY
          $fields = "";
          foreach ($fieldinfo as $val) {
              $fields .= $val -> name.", ";
          }
          $fields = substr($fields,0,-2);

          $val = '';
          if (isset($_POST['search'])) {
               $val = $_POST['valueToFilter'];
          }

          echo '<form action="teams.php" method="POST">
          <input class="btn btn-primary inline_input" type="submit" name="search" value="SEARCH" placefolder="filter" onclick="this.form.submit()">
          <input class="inline_input size_box" type="text" name="valueToFilter" value="'.$val.'">
          <input type="hidden" name="selected_table" value="teams">
          <input type="hidden" name="table_attributes" value="('.$fields.')"></form>';

        ?>

        <table class="table table-striped" style ="box-shadow: 0 0 10px 0 rgb(208 208 208 / 50%); border-radius: 0.6rem;">
            <thead>
                <tr>
                <?php
                echo "<th style=\"text-align:center\">".$attributes[$fieldinfo[0] -> name]." </th>";
                echo "<th style=\"text-align:center\">".$attributes[$fieldinfo[1] -> name]." </th>";
                echo "<th style=\"text-align:center\">".$attributes[$fieldinfo[2] -> name]." </th>";
                echo "<th style=\"text-align:center\">".$attributes[$fieldplayer[1] -> name]." </th>";
                ?>
                </tr>
            </thead>
            <tbody>
                <?php

                if (isset($_POST['search'])) {

                      $filterValue = $_POST['valueToFilter'];

                      $query = "SELECT * FROM ( SELECT T.tid, T.name, CONCAT(C.f_name,\" \",C.l_name) as coach_name FROM coaches C LEFT JOIN (teams T JOIN manages M USING (tid)) USING (cid)) as T WHERE CONCAT(T.tid, T.name, T.coach_name) LIKE '%".$filterValue."%'";
                      $result = mysqli_query($db, $query);

                      if($result and mysqli_num_rows($result) != 0) {
                          while ($row = mysqli_fetch_row($result)) {
                              echo "<tr>";
                              echo "<td style=\"text-align:center\">".$row[0]."</td>";
                              echo "<td style=\"text-align:center\">".$row[1]."</td>";
                              echo "<td style=\"text-align:center\">".$row[2]."</td>";
                              echo "<td style=\"text-align:center\">".$total_players[$row[0]]."</td>";
                              echo "
                              <td style=\"text-align:center\">
                                  <form method=\"POST\" action=\"team.php\">
                                      <input name=\"game_id\" value=\"".$row[0]."\"hidden></input>
                                      <button class=\"btn btn-primary\">Details
                                      </button>
                                  </form>
                              </td>";
                              echo "</form></td></tr>";
                          }
                      }
                  } else {
                      if($result) {
                        
                      while ($row = mysqli_fetch_row($result)) {
                        
                          echo "<tr>";
                          echo "<td style=\"text-align:center\">".$row[0]."</td>";
                          echo "<td style=\"text-align:center\">".$row[1]."</td>";
                          echo "<td style=\"text-align:center\">".$row[2]."</td>";
                          if (array_key_exists($row[0], $total_players)) {echo "<td style=\"text-align:center\">".$total_players[$row[0]]."</td>";}
                          
                         
                          echo "
                          <td style=\"text-align:center\">
                              <form method=\"POST\" action=\"team.php\">
                                  <input name=\"team_id\" value=\"".$row[0]."\"hidden></input>
                                  <button class=\"btn btn-primary\">Details
                                  </button>
                              </form>
                          </td>";
                          echo "</tr>";
                      }
                  }
                }
                ?>
            </tbody>
        </table>
    </div>
  </div>
  </div>
</body>
</html>

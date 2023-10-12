<?php
include 'Database.php';
include 'config.php';

?>

<?php

$db = new Database();

$q = "SELECT declamation_score.team_id, registration.school_name, SUM(declamation_score.total) AS total FROM declamation_score INNER JOIN registration ON declamation_score.team_id = registration.team_id GROUP BY declamation_score.team_id ORDER BY total DESC";
$dc = $db->select($q);
$q1 = "SELECT dance_score.team_id, registration.school_name, SUM(dance_score.total) AS total FROM dance_score INNER JOIN registration ON dance_score.team_id = registration.team_id GROUP BY dance_score.team_id ORDER BY total DESC";
$d = $db->select($q1);
$q2 = "SELECT singing_score.team_id, registration.school_name, SUM(singing_score.total) AS total FROM singing_score INNER JOIN registration ON singing_score.team_id = registration.team_id GROUP BY singing_score.team_id ORDER BY total DESC";
$s = $db->select($q2);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interschool - Leaderboard</title>
    <link rel="shortcut icon" href="./assets/images/clipboard.svg" type="image/x-icon">
    <style>
        h1{
            font-size: 30px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        @media screen and (max-width = 600px) {
            .dcLeaderboard {
                width: 100%;
            }
            .dLeaderboard {
                width: 100%;
            }
            .sLeaderboard {
                width: 100%;
            }
            center{
                width: 100%;
            }

        }
    </style>
</head>


<body>
    <CENTER>
        <h1><u>SCORE TABLE</u></h1><br><br>

        <table border="1" cellspacing="0" cellpadding="10" class="dcLeaderboard">
            <tr>
            <th colspan="3">Declamation Leaderboard</th>
        </tr>
        <tr>
            <th>Team Id </th>
            <th>School Name</th>
            <th>Total Score</th>
        </tr>
        <tr>
            <?php
        while($row = $dc->fetch_assoc()) { ?>
            <td>DC<?php echo $row['team_id']; ?></td>
            <td><?php echo $row['school_name']; ?></td>
            <td><?php echo $row['total']; ?></td>
        </tr>
        <?php } ?>
    </table>
    <table border="1" cellspacing="0" cellpadding="10" class="dcLeaderboard">
        <tr>
            <th colspan="3">Singing Leaderboard</th>
        </tr>
        <tr>
            <th>Team Id </th>
            <th>School Name</th>
            <th>Total Score</th>
        </tr>
        <tr>
            <?php
        while($row = $s->fetch_assoc()) { ?>
            <td>S<?php echo $row['team_id']; ?></td>
            <td><?php echo $row['school_name']; ?></td>
            <td><?php echo $row['total']; ?></td>
        </tr>
        <?php } ?>
    </table>
    <table border="1" cellspacing="0" cellpadding="10" class="dcLeaderboard">
        <tr>
            <th colspan="3">Dancing Leaderboard</th>
        </tr>
        <tr>
            <th>Team Id</th>
            <th>School Name</th>
            <th>Total Score</th>
        </tr>
        <tr>
        <?php
        while($row = $d->fetch_assoc()) { ?>
            <td>D<?php echo $row['team_id']; ?></td>
            <td><?php echo $row['school_name']; ?></td>
            <td><?php echo $row['total']; ?></td>
        </tr>
        <?php } ?>
    </table>
    
</CENTER>
</body>

</html>
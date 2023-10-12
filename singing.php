<?php
include 'Database.php';
include 'config.php';

?>
<?php

$db = new Database();
$query = "SELECT * FROM registration";
$read = $db->select($query);
$query1 = "SELECT * FROM judges";
$read1 = $db->select($query1);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Singing Judge Panel</title>
    <link rel="stylesheet" href="assets/css/judge_style.css">
    <link rel="shortcut icon" href="./assets/images/user.svg" type="image/x-icon">

</head>

<body>
    <div id="singingForm">
        <form action="" method="post">
            <h2>Select your Team Id:</h2>
            <select name="team_id" id="team_id">
                <?php if($read){ ?>
                <?php 
                     $i=0;              
                     while($row = $read->fetch_assoc()){ 
                     $i++;
                ?>
                <option value="<?php echo $row['team_id']?>">S<?php echo $row['team_id']?></option>
                <?php } ?>
                <?php }else{ ?>
                <p>Data is not Found!</p>
                <?php } ?>

            </select><br>
            <h2>Select your Judge Id:</h2>
            <select name="judge_id" id="judge_id">
                <?php if($read1){ ?>
                <?php 
                     $i=0;              
                     while($row1 = $read1->fetch_assoc()){ 
                     $i++;
                ?>
                <option value="<?php echo $row1['judge_id']?>"><?php echo $row1['judge_id']?></option>
                <?php } ?>
                <?php }else{ ?>
                <p>Data is not Found!</p>
                <?php } ?>

            </select>
            <h2>Enter the marks in given inputs:</h2>
            <p style="font-size: 20px;">(The value must be less than or equal to 20)</p>
            <label for="song_choice">Song Choice</label><br>
            <input type="number" id="song_choice" name="song_choice" required max="20"><br><br>
            <label for="vocal_quality">Vocal Quality</label><br>
            <input type="number" id="vocal_quality" name="vocal_quality" required max="20"><br><br>
            <label for="creativity">Creativity</label><br>
            <input type="number" id="creativity" name="creativity" required max="20"><br><br>
            <label for="rhythm_timing">Rhythm & Timing</label><br>
            <input type="number" id="rhythm_timing" name="rhythm_timing" required max="20"><br><br>
            <label for="coordination">Coordination</label><br>
            <input type="number" id="coordination" name="coordination" required max="20"><br><br>
            <input type="submit" name="singing_submit" id="submit">
        </form>
    </div>
    <?php
$db = new Database();
if(isset($_POST['singing_submit'])){
    $song_choice = mysqli_real_escape_string($db->link, $_POST['song_choice']);
    $vocal_quality = mysqli_real_escape_string($db->link, $_POST['vocal_quality']);
    $creativity = mysqli_real_escape_string($db->link, $_POST['creativity']);
    $rhythm_timing = mysqli_real_escape_string($db->link, $_POST['rhythm_timing']);
    $coordination = mysqli_real_escape_string($db->link, $_POST['coordination']);
    $team_id = mysqli_real_escape_string($db->link, $_POST['team_id']);
    $judge_id = mysqli_real_escape_string($db->link, $_POST['judge_id']);
    $total = (int)$song_choice + (int)$vocal_quality + (int)$creativity + (int)$rhythm_timing + (int)$coordination;

    $duplicate = "SELECT * FROM singing_score WHERE team_id = '$team_id' AND judge_id = '$judge_id'";
    $check = $db->select($duplicate);

    
    if($song_choice == "" || $vocal_quality == "" || $creativity == "" || $rhythm_timing == "" || $coordination == "" || $team_id == "" || $judge_id == ""){
        $error = "Field must not be Empty !!";
    } else {
        if($check){
            $error = "This team has already been scored by this judge."; ?>

    <?php if(isset($error)){ ?>
    <script>
        alert("<?php echo $error ?>");
    </script>
    <?php } ?>
    <?php
        } else {
            $query = "INSERT INTO singing_score(`team_id`, `judge_id`, `song_choice`, `vocal_quality`, `coordination`, `creativity`, `rhythm_timing`, `total`) 
        VALUES('$team_id', '$judge_id', '$song_choice', '$vocal_quality', '$coordination', '$creativity', '$rhythm_timing',  '$total')";
        $create = $db->insert($query);
        }
    }  
    }
    
?>
</body>

</html>
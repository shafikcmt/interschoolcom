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
    <title>Dancing Judge Panel</title>
    <link rel="stylesheet" href="assets/css/judge_style.css">
    <link rel="shortcut icon" href="./assets/images/user.svg" type="image/x-icon">
</head>

<body>
    <div id="dancingForm">
        <form action="" method="post">
            <h2>Select your Team Id:</h2>
            <select name="team_id" id="team_id">
                <?php if($read){ ?>
                <?php 
                     $i=0;              
                     while($row = $read->fetch_assoc()){ 
                     $i++;
                ?>
                <option value="<?php echo $row['team_id']?>">D<?php echo $row['team_id']?></option>
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
            <p style="font-size: 1rem;">(The value must be less than or equal to 20)</p>
            <label for="stage_presence">Stage Presence</label><br>
            <input type="number" id="stage_presence" name="stage_presence" required max="20"><br><br>
            <label for="face_expression">Face Expression</label><br>
            <input type="number" id="face_expression" name="face_expression" required max="20"><br><br>
            <label for="costume">Costume</label><br>
            <input type="number" id="costume" name="costume" required max="20"><br><br>
            <label for="choreography">Choreography</label><br>
            <input type="number" id="choreography" name="choreography" required max="20"><br><br>
            <label for="coordination">Coordination</label><br>
            <input type="number" id="coordination" name="coordination" required max="20"><br><br>
            <input type="submit" name="dancing_submit" id="submit">
        </form>
    </div>
    <?php
$db = new Database();
if(isset($_POST['dancing_submit'])){
    $stage_presence  = mysqli_real_escape_string($db->link, $_POST['stage_presence']);
    $face_expression = mysqli_real_escape_string($db->link, $_POST['face_expression']);
    $costume = mysqli_real_escape_string($db->link, $_POST['costume']);
    $choreography = mysqli_real_escape_string($db->link, $_POST['choreography']);
    $coordination = mysqli_real_escape_string($db->link, $_POST['coordination']);
    $team_id = mysqli_real_escape_string($db->link, $_POST['team_id']);
    $judge_id = mysqli_real_escape_string($db->link, $_POST['judge_id']);
    $total = (int)$stage_presence + (int)$face_expression + (int)$costume + (int)$choreography + (int)$coordination;

    $duplicate = "SELECT * FROM dance_score WHERE team_id = '$team_id' AND judge_id = '$judge_id'";
    $check = $db->select($duplicate);

    if($stage_presence == "" || $face_expression == "" || $costume == "" || $choreography == "" || $coordination == "" || $team_id == "" || $judge_id == ""){
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
            $query = "INSERT INTO dance_score(`team_id`, `judge_id`, `stage_presence`, `face_expression`, `costume`, `choreography`, `coordination`,`total`) VALUES('$team_id', '$judge_id', '$stage_presence', '$face_expression', '$costume', '$choreography', '$coordination','$total')";

            $create = $db->insert($query);
        }
    }
    }

?>

</body>

</html>
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
    <title>Declamation Judge Panel</title>
    <link rel="stylesheet" href="assets/css/judge_style.css">
    <link rel="shortcut icon" href="./assets/images/user.svg" type="image/x-icon">
</head>

<body>
    <div id="declamationForm">

        <form action="" method="post">
            <h2>Select your Team Id:</h2>
            <select name="team_id" id="team_id">
                <?php if($read){ ?>
                <?php 
                     $i=0;              
                     while($row = $read->fetch_assoc()){ 
                     $i++;
                ?>
                <option value="<?php echo $row['team_id']?>">DC<?php echo $row['team_id']?></option>
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
            <label for="dictation_articulation">Dictation & Articulation</label><br>
            <input type="number" id="dictation_articulation" name="dictation_articulation" required max="20"><br><br>
            <label for="expression_emotions">Expression & Emotions</label><br>
            <input type="number" id="expression_emotions" name="expression_emotions" required max="20"><br><br>
            <label for="interpretation">Interpretation</label><br>
            <input type="number" id="interpretation" name="interpretation" required max="20"><br><br>
            <label for="stage_presence">Stage Presence</label><br>
            <input type="number" id="stage_presence" name="stage_presence" required max="20"><br><br>
            <label for="timing_pace">Timing & Pace<br>
                <input type="number" id="timing_pace" name="timing_pace" required max="20"><br><br>
                <input type="submit" name="declamation_submit" id="submit">
        </form>
    </div>
    <?php
$db = new Database();
if(isset($_POST['declamation_submit'])){
    $dictation_articulation = mysqli_real_escape_string($db->link, $_POST['dictation_articulation']);
    $expression_emotions = mysqli_real_escape_string($db->link, $_POST['expression_emotions']);
    $interpretation = mysqli_real_escape_string($db->link, $_POST['interpretation']);
    $stage_presence = mysqli_real_escape_string($db->link, $_POST['stage_presence']);
    $timing_pace = mysqli_real_escape_string($db->link, $_POST['timing_pace']);
    $team_id = mysqli_real_escape_string($db->link, $_POST['team_id']);
    $judge_id = mysqli_real_escape_string($db->link, $_POST['judge_id']);
    $total = (int)$dictation_articulation + (int)$expression_emotions + (int)$interpretation + (int)$stage_presence + (int)$timing_pace;

    $duplicate = "SELECT * FROM declamation_score WHERE team_id = '$team_id' AND judge_id = '$judge_id'";
    $check = $db->select($duplicate);
    
    
    if ($dictation_articulation == "" || $expression_emotions == "" || $interpretation == "" || $stage_presence == "" || $timing_pace == "" || $team_id == "" || $judge_id == "") {
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
            $query = "INSERT INTO declamation_score(`team_id`, `judge_id`, `dictation_articulation`, `expression_emotions`, `interpretation`, `stage_presence`, `timing_pace`, `total`) Values('$team_id', '$judge_id', '$dictation_articulation', '$expression_emotions', '$interpretation', '$stage_presence', '$timing_pace', '$total')";
            $create = $db->insert($query);
        }
        
        
    }
}


?>
</body>

</html>
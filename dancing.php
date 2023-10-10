<?php
include 'Database.php';
include 'config.php';


$db = new Database();

// Fetch team names from registration table
$query = "SELECT team_name FROM registration";
$result = $db->select($query);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/judge_style.css">
</head>
<body>
    <div id="dancingForm">
        <form action="" method="post">
            <h2>Enter the Marks in given Inputs:</h2> <br><br>
            <label for="team_name">Select Team:</label>
            <select name="team_name" id="team_name">
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <option value="<?php echo $row['team_name']; ?>"><?php echo $row['team_name']; ?></option>
                <?php } ?>
            </select><br><br>
            <label for="stage_presence">Stage Presence</label><br>
            <input type="number" id="stage_presence" name="stage_presence"><br><br>
            <label for="face_expression">Face Expression</label><br>
            <input type="number" id="face_expression" name="face_expression"><br><br>
            <label for="costume">Costume</label><br>
            <input type="number" id="costume" name="costume"><br><br>
            <label for="choreography">Choreography</label><br>
            <input type="number" id="choreography" name="choreography"><br><br>
            <label for="coordination">Coordination</label><br>
            <input type="number" id="coordination" name="coordination"><br><br>
            <input type="submit" name="dancing_submit" id="submit">
        </form>
    </div>
</body>
</html>
<?php
$db = new Database();
if(isset($_POST['dancing_submit'])){
    $stage_presence  = mysqli_real_escape_string($db->link, $_POST['stage_presence']);
    $face_expression = mysqli_real_escape_string($db->link, $_POST['face_expression']);
    $costume = mysqli_real_escape_string($db->link, $_POST['costume']);
    $choreography = mysqli_real_escape_string($db->link, $_POST['choreography']);
    $coordination = mysqli_real_escape_string($db->link, $_POST['coordination']);

    if($stage_presence == "" || $face_expression == "" || $costume == "" || $choreography == "" || $coordination == ""){
        $error = "<div class='alert alert-danger'>Field Must not be Empty.</div>";
    }else{
        $query = "INSERT INTO `dancing_judge`(`stage_presence`, `face_expression`, `costume`, `choreography`, `coordination`) values('$stage_presence','$face_expression','$costume','$choreography','$coordination')";
        $create = $db->insert($query);
    }

}


?>
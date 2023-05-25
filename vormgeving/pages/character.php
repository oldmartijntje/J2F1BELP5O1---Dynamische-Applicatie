<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Character - Bowser</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="resources/css/style.css" rel="stylesheet"/>
</head>
<body>

<?php
require_once "resources/config.php";

$id = $_GET['id'];
$sql = "SELECT * FROM characters WHERE id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $id); // Assuming 'id' is an integer (yes it is, thanks GPT :)

if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_array()) {
            $newDict = [];
            foreach ($row as $key => $value) {
                $newDict[$key] = stripslashes(trim(htmlspecialchars($value)));
                $newDict[$key] = str_replace('\'', '', $newDict[$key]);
            }
            foreach ($newDict as $key => $value) {
                if (is_string($value) && strpos($value, "\r") !== false) {
                    $newDict[$key] = str_replace("\r\n", " ", $value);
                }
            }
    }
    $result->free();
    } else{
        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
        ?>
        <script>
            window.location.href = "?page=404character";
        </script>
        <?php
    }
} else{
    echo "Oops! Something went wrong. Please try again later.";
    ?>
        <script>
            window.location.href = "?page=404character";
        </script>
    <?php
}

// Close connection
$mysqli->close();

?>
<script>
    var obj = JSON.parse('<?php echo json_encode($newDict) ?>');
    console.log(obj)
</script>

<header><h1><?php echo $newDict['name'] ?></h1>
    <a class="backbutton" href="?page=home"><i class="fas fa-long-arrow-alt-left"></i> Terug</a></header>
<div id="container">
    <div class="detail">
        <div class="left">
            <img class="avatar <?php if ($newDict['name'] == "Captain America") { echo 'rotated'; } ?>" src="resources/images/<?php echo $newDict['avatar'] ?>">
            <div class="stats" style="background-color: <?php echo $newDict['color'] ?>">
                <ul class="fa-ul">
                    <li><span class="fa-li"><i class="fas fa-heart"></i></span> <?php echo $newDict['health'] ?></li>
                    <li><span class="fa-li"><i class="fas fa-fist-raised"></i></span> <?php echo $newDict['attack'] ?></li>
                    <li><span class="fa-li"><i class="fas fa-shield-alt"></i></span> <?php echo $newDict['defense'] ?></li>
                </ul>
                <ul class="gear">
                    <li><b>Weapon</b>: <?php echo $newDict['weapon'] ?></li>
                    <li><b>Armor</b>: <?php echo $newDict['armor'] ?></li>
                </ul>
            </div>
        </div>
        <div class="right">
            <p>
            <?php echo $newDict['bio'] ?>
            </p>
        </div>
        <div style="clear: both"></div>
    </div>
</div>
<footer>&copy; OldMartijntje 2023</footer>
</body>
</html>
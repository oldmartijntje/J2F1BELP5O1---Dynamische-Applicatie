<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Characters</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="resources/css/style.css" rel="stylesheet"/>
</head>
<body>
<?php
require_once "resources/config.php";

$allCharacters = array();
$sql = "SELECT * FROM characters";
    if($result = $mysqli->query($sql)){
        if($result->num_rows > 0){
            while($row = $result->fetch_array()){
            
                $newDict = [];
                foreach($row as $key=>$value) {
                    $newDict[$key] = stripslashes(trim(HTMLspecialchars($value)));
                    $newDict[$key] = str_replace('\'', '', $newDict[$key]);
                } 
                // Loop through each property in the object
                foreach ($newDict as $key => $value) {
                    // If the property value is a string containing unescaped "\r" characters
                    if (is_string($value) && strpos($value, "\r") !== false) {
                        // Replace unescaped "\r" characters with escaped "\r" characters
                        $newDict[$key] = str_replace("\r\n", " ", $value);
                    }
                }
                array_push($allCharacters, $newDict);
                
    }
        $result->free();
    } else{
        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
    }
} else{
    echo "Oops! Something went wrong. Please try again later.";
}

// Close connection
$mysqli->close();

?>

<script>
    var obj = JSON.parse('<?php echo json_encode($allCharacters) ?>');
    console.log(obj)
</script>
<header><h1>Alle <?php echo count($allCharacters) ?> characters uit de database</h1>

</header>
<div id="container">
    <?php 
    for ($i=0; $i < count($allCharacters); $i++) { 
    ?>
    <a class="item" href="?page=character&id=<?php echo $allCharacters[$i]['id'] ?>">
        <div class="left">
            <img class="avatar <?php if ($allCharacters[$i]['name'] == "Captain America") { echo 'rotated'; } ?>" src="resources/images/<?php echo $allCharacters[$i]['avatar'] ?>">
        </div>
        <div class="right">
            <h2><?php echo $allCharacters[$i]['name'] ?></h2>
            <div class="stats">
                <ul class="fa-ul">
                    <li><span class="fa-li"><i class="fas fa-heart"></i></span> <?php echo $allCharacters[$i]['health'] ?></li>
                    <li><span class="fa-li"><i class="fas fa-fist-raised"></i></span> <?php echo $allCharacters[$i]['attack'] ?></li>
                    <li><span class="fa-li"><i class="fas fa-shield-alt"></i></span> <?php echo $allCharacters[$i]['defense'] ?></li>
                </ul>
            </div>
        </div>
        <div class="detailButton"><i class="fas fa-search"></i> bekijk</div>
    </a>
    <?php } ?>
</div>
<footer>&copy; OldMartijntje 2023</footer>
</body>
</html>
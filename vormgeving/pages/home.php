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
            ?><script>
                <?php
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
                array_push($allCharacters, $newDict)
                ?>
            var obj = JSON.parse('<?php echo json_encode($newDict) ?>');
        </script>
<?php
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
    <a class="item" href="?page=character">
        <div class="left">
            <img class="avatar" src="resources/images/bowser.jpg">
        </div>
        <div class="right">
            <h2>Bowser</h2>
            <div class="stats">
                <ul class="fa-ul">
                    <li><span class="fa-li"><i class="fas fa-heart"></i></span> 10000</li>
                    <li><span class="fa-li"><i class="fas fa-fist-raised"></i></span> 400</li>
                    <li><span class="fa-li"><i class="fas fa-shield-alt"></i></span> 100</li>
                </ul>
            </div>
        </div>
        <div class="detailButton"><i class="fas fa-search"></i> bekijk</div>
    </a>
</div>
<footer>&copy; OldMartijntje 2023</footer>
</body>
</html>
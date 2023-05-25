<?php
require_once "resources/config.php";
if ($_GET['page'] == "character") {
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
} else if ($_GET['page'] == "home") {

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

}
?>
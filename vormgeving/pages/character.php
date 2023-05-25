

<?php
require_once "resources/queries.php";
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
            <img class="avatar <?php if ($newDict['name'] == "Captain America") { echo 'rotated'; } ?>" src="resources/images/<?php echo $newDict['avatar'] ?>" alt="<?php echo $allCharacters[$i]['avatar'] ?> image should be here">
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
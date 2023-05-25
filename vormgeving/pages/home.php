
<?php
require_once "resources/queries.php";
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
            <img class="avatar <?php if ($allCharacters[$i]['name'] == "Captain America") { echo 'rotated'; } ?>" src="resources/images/<?php echo $allCharacters[$i]['avatar'] ?>" alt="<?php echo $allCharacters[$i]['avatar'] ?> image should be here">
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

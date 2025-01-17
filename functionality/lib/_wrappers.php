<?php    
    function custom_header(string $isAdmin=null) {
        $title = ($isAdmin == 1) ? "BotsApp Admin" : "BotsApp" ;
?>
        <div class="title">
            <img src="../img/logo.png" onclick="tohomepage()">
            <h1 onclick="tohomepage()"><?= $title?></h1>
        </div>
        <p>-A Better place for chat.</p>
<?php
    }

    function custom_footer() {
        // if any changes made in this also change in _chat.php for inbox footer.
        ?>
        <div>
            <span id="user-ip"></span>
            
            All rights NOT -_- reserverd by <a href="/t&c/policy.php" class="link">BotsApp</a>.
        </div>
        <a href="/help/user-help.php" class="link">Need help?</a>
        <?php
    }
?>

<!-- Notifications -->
<div id="notification" class=""></div>
<div id="alert" class=""></div>

<style>
#notification , #alert{
    display: flex;
    opacity: 0;
    flex-wrap: wrap;
    justify-content: center;
    align-content: center;
    position: fixed;
    height: auto;
    min-height: 50px;
    width: auto;
    bottom: 0px;
    right: -100px;
    border: 1px solid black;
    padding: 5px 30px;
    margin: 20px;
    z-index: 10;
    transition:all .5s cubic-bezier(0.4, 0.6, 0, 1.17);
    border-radius: 5px;
    font-family: var(--text-font);
    font-size: 14px;

}

#notification   {
    color: aliceblue;
    background-color: rgba(79, 15, 197, 0.623);
    box-shadow: 3px 3px 30px rgba(0, 0, 255, 0.296);

}

#alert {
    color: red;
    background-color: aliceblue;
    box-shadow: 3px 3px 30px rgba(255, 0, 0, 0.296);

}

</style>
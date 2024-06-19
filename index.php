<?php
    include_once("interface.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Personal Chat -- BOTSAPP</title>

    <link rel="stylesheet" type="text/css" href="css/index.css">

    <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript" src="/js/lib/_classes.js"></script>
    <script type="text/javascript" src="/js/lib/_status.js"></script>
</head>
<body>

    <div class="center">
    <!-- chat-box -->
    <div class="chat-box bg-img">
        <!-- chat-list -->
        <div class="inbox">

            <div class="page-title">
                <h2 id="cname">Personal Chat</h2>
                
                <img class="icon ele" data-show="false" src="/img/icons/options/plus.png" title="Create New Group">
            </div>
            
            <div class="hr"></div>
            
            <!-- search-box -->
            <div class="search">
                <input type="search" name="seach" placeholder="search" autocomplete="off" accesskey="f">
            </div>
            
            <table class="list" id="chatterList" title="Chatter List"> 
                <tbody class="listBody">

                </tbody>
            </table>
        </div>

        <!-- opened-chat -->
        <div class="chat">
        </div>

    </div>
    </div>
</body>
</html>
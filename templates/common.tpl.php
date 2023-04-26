<?php 
function drawHeader($animationFlag, $nextAnimation, $title){
?>
    <header class="header">
    <form action="/../actions/logout.action.php">
        <input name= "next-logout" type="hidden" id="next-animation" value=<?=$nextAnimation?>>
        <input name= "logout" type="hidden" id="animation" value=<?=$animationFlag?>> <!--<?=$animation?> -->
        <h1>Ticket System</h1>
        <h2><?=$title?></h2>
      <section id="logout" >
        <div>
          <button type="submit" class="logout-box">Logout</button>
        </div>
      </section>
      </form>
    </header>    
<?php 
}
?>
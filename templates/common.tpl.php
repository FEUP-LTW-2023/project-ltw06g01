<?php 
function drawHeader($animationFlag, $nextAnimation, $title){ /* o argumento title devia ser subtitle*/
?>
    <form id="drawHeader" action="/../actions/logout.action.php" method="get">
      <input type="hidden" name="csrf" value=<?= $_SESSION['csrf'] ?>>
        <input name= "next-logout" type="hidden" id="next-animation" value=<?=$nextAnimation?>>
        <input name= "logout" type="hidden" id="animation" value=<?=$animationFlag?>> 
        <div id="title">
          <h1>Ticket System</h1>
        </div>
        <div id="home-or-subtitle">
            <a id="home" href = "page.php">
              <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
              <span class="icon-hover"><ion-icon name="home"></ion-icon></span>
            </a>
            <?php if ($title != "") { ?> <h2 id="subtitle" ><?=$title?></h2> <?php } ?>
        </div>
        <div id="profile-or-logout">
          <a class="profile-box" href="/../pages/profile.php">
            <ion-icon id="profile-button" name="person-outline"></ion-icon>
            <ion-icon id="profile-button-hover" name="person"></ion-icon>
          </a>
          <button type="submit" class="logout-box">
            <ion-icon id="logout-icon" name="log-out"></ion-icon>
            <ion-icon id="logout-icon-hover" name="log-out-outline"></ion-icon>
          </button>
        </div>
    </form>
<?php 
}
?>

<?php 
function drawSideBar(){ 
?>
    <nav id="drawSideBar">
      <ul>
        <?php $user_type = $_SESSION['level'] ?? -1?>
        <?php if (isset($user_type)): ?>
          <li class="item-menu">
            <a href = "ticket.php">
              <span class = "icon"><ion-icon name="ticket-outline"></ion-icon></span>
              <span class = "txt-link">Create Ticket</span>
            </a>
          </li>
        <?php endif; if ($user_type >= 1): ?>
          <li class="item-menu">
            <a href = "all_tickets.php">
              <span class = "icon"><ion-icon name="file-tray-stacked-outline"></ion-icon></span>
              <span class = "txt-link">All Tickets</span>
            </a>
        </li>
        <?php endif; if ($user_type == 2): ?>
        <li class="item-menu">
          <a href = "user_management.php">
            <span class = "icon"><ion-icon name="cog-outline"></ion-icon></span>
            <span class = "txt-link">Manage Users</span>
          </a>
        </li>
        <?php endif; ?>
      </ul>
    </nav>
<?php 
}
?>

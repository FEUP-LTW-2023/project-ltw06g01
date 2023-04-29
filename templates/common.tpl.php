<?php 
function drawHeader($animationFlag, $nextAnimation, $title){ /* o argumento title devia ser subtitle*/
?>
    <form id="drawHeader" action="/../actions/logout.action.php">
        <input name= "next-logout" type="hidden" id="next-animation" value=<?=$nextAnimation?>>
        <input name= "logout" type="hidden" id="animation" value=<?=$animationFlag?>> 
        <div id="title">
          <h1>Ticket System</h1>
        </div>
        <div id="subtitle">
          <h2><?=$title?></h2>
        </div>
        <div id="logout0">
          <button type="submit" class="logout-box">Logout</button>
        </div>
        <div id="profile">
          <a class="profile-box" href="/../pages/profile.php"><ion-icon name="person-outline"></ion-icon></a>
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
        <li class="item-menu">
          <a href = "page.php">
            <span class = "icon"><ion-icon name="home-outline"></ion-icon></span>
            <span class = "txt-link">Home</span>
          </a>
        </li>
        <?php $user_type = $_SESSION['level'] ?>
        <?php if (isset($user_type)): ?>
          <li class="item-menu">
            <a href = "ticket.php">
              <span class = "icon"><ion-icon name="ticket-outline"></ion-icon></span>
              <span class = "txt-link">Create Ticket</span>
            </a>
          </li>
          <li class="item-menu">
            <a href = "open_tickets.php">
              <span class = "icon"><ion-icon name="file-tray-stacked-outline"></ion-icon></span>
              <span class = "txt-link">All Tickets</span>
            </a>
        </li>
        <!--  Podemos colocar este filtro dentro da página com todos os tickets
        <?php endif; if ($user_type >= 1): ?>
        <li class="item-menu">
          <a href = "open_tickets.php">
            <span class = "icon"><ion-icon name="cog-outline"></ion-icon></span>
            <span class = "txt-link">Tickets do Departamento</span>
          </a>
        </li>
        -->
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
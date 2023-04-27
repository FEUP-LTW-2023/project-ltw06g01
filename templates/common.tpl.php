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
    </form>
<?php 
}
?>

<?php 
function drawSideBar(){ 
?>
    <nav id="drawSideBar">
      <ul>
        <?php $user_type = 'client'; ?>
        <?php if ($user_type === 'client'): ?>
          <li class="item-menu">
            <a href = "#">
              <span class = "icon"><ion-icon name="cog-outline"></ion-icon></span>
              <span class = "txt-link">Enviar Ticket</span>
            </a>
          </li>
          <li class="item-menu">
            <a href = "open_tickets.php">
              <span class = "icon"><ion-icon name="cog-outline"></ion-icon></span>
              <span class = "txt-link">Tickets Abertos</span>
            </a>
        </li>
        <?php elseif ($user_type === 'agent'): ?>
        <li class="item-menu">
          <a href = "#">
            <span class = "icon"><ion-icon name="cog-outline"></ion-icon></span>
            <span class = "txt-link">Tickets do Departamento</span>
          </a>
        </li>
        <?php elseif ($user_type === 'admin'): ?>
        <li class="item-menu">
          <a href = "#">
            <span class = "icon"><ion-icon name="cog-outline"></ion-icon></span>
            <span class = "txt-link">Associar Agentes</span>
          </a>
        </li>
        <li class="item-menu">
          <a href = "#">
            <span class = "icon"><ion-icon name="cog-outline"></ion-icon></span>
            <span class = "txt-link">Associar novos departamentos/dados/entidades</span>
          </a>
        </li>
        <li class="item-menu">
          <a href = "#">
            <span class = "icon"><ion-icon name="cog-outline"></ion-icon></span>
            <span class = "txt-link">Promover</span>
          </a>
        </li>
        <?php endif; ?>
      </ul>
    </nav>
<?php 
}
?>
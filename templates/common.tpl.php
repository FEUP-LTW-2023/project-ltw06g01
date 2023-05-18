<?php 
function drawHeader($animationFlag, $nextAnimation, $title){ /* o argumento title devia ser subtitle*/
  if (isset($_SESSION['loggedin'])){
    $loggedin = $_SESSION['loggedin'];
  }
  else{
    $loggedin = 0;
  } 
?>
  <script src="/../javascript/header.js" defer></script>
    <form>
      <input type="hidden" id="loggedin" value=<?=$loggedin?>>
    </form>
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
function drawNav(){ 
?>
    <script src="/../javascript/nav.js" defer></script>
    <nav id="drawNav">
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

<?php 
function drawEnterBoxes(){ 
?>
<script src="/../javascript/enter_boxes_transitions.js" defer></script>
            <div id="login-box-animated">
              <div class ="form-box-login" id="login-box">
                <div class="form-value">
                  <form>
                    <input type="hidden" name="csrf" value=<?= $_SESSION['csrf'] ?>>
                    <h2>Login</h2>
                    <div class="inputbox">
                      <ion-icon name="person-outline"></ion-icon>
                      <input type="text" required class="username" name="username">
                      <label for="username">Username:</label>
                    </div>
                    <div class="inputbox">
                      <ion-icon name="lock-closed-outline"></ion-icon>
                      <input type="password" required class="password" name="password">
                      <label for="password">Password:</label>
                    </div>
                    <button type="submit" class="submit-login" formaction="/../actions/login.action.php" formmethod="post">Login</button>
                    <div class="Reg-forget">
                      <div class="Register" id="Register-button">
                        <p>New account?</p>
                      </div>
                      <div class="forget">
                        <a href="#">Forget Password?</a>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          
          <div id="signup-box-animated" style="display: none;">
            <div class ="form-box-signup" id="signup-box">
              <div class="form-value">
                <form action='/../actions/register.action.php' method = "post">
                  <input type="hidden" name="csrf" value=<?= $_SESSION['csrf'] ?>>
                  <h2>Sign Up</h2>
                  <div class="inputbox">
                    <ion-icon name="person-outline"></ion-icon>
                    <input type="text" required class="username" name="username">
                    <label for="username">Username:</label>
                  </div>
                  <div class="inputbox">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="text" required id="email" name="email">
                    <label for="email">Email:</label>
                  </div>
                  <div class="inputbox">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" required class="password" name="password">
                    <label for="password">Password:</label>
                  </div>
                  <div class="inputbox">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" required id="confirm-password" name="confirm-password">
                    <label for="confirm-password">Confirm Password:</label>
                  </div>
                  <button type="submit" class="submit-signup">Sign Up</button>
                  <div class="Enter" id="login-button">
                    <p>Already have an account? </p>
                  </div>
                </form>
              </div>
            </div>
          </div>
<?php 
}

function drawMessages($session) {
  foreach ($session->getMessages() as $message) { ?>
  <div class="message-category">
    <input type="hidden" class="message-type" value=<?= $message['type'] ?>>
    <p><?= $message['text'] ?></p>
  </div>  
  <?php }
}
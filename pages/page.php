<?php
  require_once(__DIR__ . '/../classes/session.class.php');

  $session = new Session();
  
  require_once(__DIR__ . '/../classes/ticket.class.php');
  require_once(__DIR__ . '/../classes/user.class.php');
  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../database/status.php');
  require_once(__DIR__ . '/../database/departments.php');
  require_once(__DIR__ . '/../templates/ticket.tpl.php');
  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../database/tags.php');

  $db = getDatabaseConnection();

  $user_id = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;

  if ($user_id !== null) {
    $tickets = Ticket::getTicketsFromUser($db, $user_id);

    if (empty($tickets)) {
        $tickets = null;
    }
  } else {
      $tickets = null;
  }

  if (empty($tickets)) {
    $tickets = null;}

  if (isset($_SESSION['animation'])) {
    $animation = $_SESSION['animation'];
    unset($_SESSION['animation']);
  }
  else {
    $animation = 0;
  }

  if (isset($_SESSION['loggedin'])){
    $loggedin = $_SESSION['loggedin'];
  }
  else{
    $loggedin = 0;
  }
?>

<!DOCTYPE html>
<html>
<head>
<title>Ticket System</title>
<script src="/../javascript/scr.js" defer></script>
<script src="/../javascript/page.js" defer></script>
<script src="/../javascript/priority_change.js" defer></script>
  <link rel="stylesheet" href="/../css/pageStyle.css">
  
</head>
<body>
  <form>
    <input type="hidden" id="loggedin" value=<?=$loggedin?>>
  </form>

  <?php if (!$loggedin) { ?>
    <header id="not-logged-in">
      <?php drawHeader($animation, 3,  ""); ?>
    </header>
  <?php } else { ?>
    <header id="logged-in">
      <?php drawHeader($animation, 3,  "Home"); ?>
    </header>
  <?php } ?>
  
  <div id="nav">
          <?php drawSideBar(); ?>
  </div>
  <div id="content-home">
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
          <?php if($loggedin){ ?>
          <div id="allTickets" > 
            <p>My tickets:</p>
            <?php foreach ((array)$tickets as $ticket) {
                    $tags = getTicketTags($db, $ticket->id); ?>
                    <div class="ticket-display">
                    
                      <?php drawTicketForm($ticket, false, $tags); ?>

                      <div class="options">
                            <div class="filters-toggle">
                                <ion-icon class="settings-not-hover" name="settings-outline"></ion-icon>
                                <ion-icon class="settings-hover" name="settings"></ion-icon>
                            </div>
                            <div class="filters-container">
                                <?php drawAssignAgent($db, $ticket);
                                      drawChangeStatus($db, $ticket); 
                                      drawPriorityButtons($ticket); ?>
                            </div>

                          <a href="/../pages/view_ticket.php?id=<?php echo $ticket->id ?>">
                            <ion-icon class="view-not-hover" name="eye-outline"></ion-icon>
                            <ion-icon class="view-hover" name="eye"></ion-icon>
                          </a>

                          <div class="delete-button">
                              <button class="delete-button-submit" type="submit" onclick="window.location.href = '../actions/delete_ticket.action.php';">
                                  <ion-icon class="delete-not-hover" name="trash-outline"></ion-icon>
                                  <ion-icon class="delete-hover" name="trash"></ion-icon>
                              </button>
                          </div>
                      </div>
                    </div>
            <?php } ?>
           </div>
           <?php } ?>

    </div>
  <div id="faqs">
    <section class="FAQs">
      <h6 id="Faqs-icon">
      <ion-icon name="help-circle-outline" id="icon"></ion-icon>
      FAQ's
      </h6>
    </section>
  </div>
  <div id="footer">
      <p>Algum footer que queiramos</p>
  </div>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>


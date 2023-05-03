<?php
  session_start();

  require_once(__DIR__ . '/../templates/common.tpl.php');

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
  <link rel="stylesheet" href="/../css/pagestyle.css">
</head>
<body>
  <form>
    <input type="hidden" id="loggedin" value=<?=$loggedin?>>
  </form>
  <header>
    <?php drawHeader($animation, 3,  "");?>
  </header>
  <div id="content">
      <section id="login">
              <div class ="form-box-login" id="login-box">
                <div class="form-value">
                  <form>
                    <h2>Login</h2>
                    <div class="inputbox">
                      <ion-icon name="person-outline"></ion-icon>
                      <input type="text" required id="username" name="username">
                      <label for="username">Username:</label>
                    </div>
                    <div class="inputbox">
                      <ion-icon name="lock-closed-outline"></ion-icon>
                      <input type="password" required id="password" name="password">
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
        </section>
        
        <section id="signup">
          <div class ="form-box-signup" id="signup-box">
            <div class="form-value">
              <form action='/../actions/register.action.php' method = "post">
                <h2>Sign Up</h2>
                <div class="inputbox">
                  <ion-icon name="person-outline"></ion-icon>
                  <input type="text" required id="username" name="username">
                  <label for="username">Username:</label>
                </div>
                <div class="inputbox">
                  <ion-icon name="mail-outline"></ion-icon>
                  <input type="text" required id="email" name="email">
                  <label for="email">Email:</label>
                </div>
                <div class="inputbox">
                  <ion-icon name="lock-closed-outline"></ion-icon>
                  <input type="password" required id="password" name="password">
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
        </section>
      <section>
        <nav class="buttons">
          <div class="before-menu">
          </div>
          <div class="menu">
          <?php $user_type = 'client'; ?>
          <?php if ($user_type === 'client'): ?>
              <a class="client-button" href="ticket.php">
                <p> Criar um novo Ticket </p>
                <ion-icon name="ticket-outline"></ion-icon>
              </a>
              <a class="client-button" href="open_tickets.php">
                  <p>Todos os Tickets</p>
                  <ion-icon name="file-tray-stacked-outline"></ion-icon>
              </a>
          <?php elseif ($user_type === 'agent'): ?>
              <a class="agent-button" href="#"></a>
                  <p>Tickets do próprio departamento</p>
                  <ion-icon name="construct-outline"></ion-icon>
              </a>
          <?php elseif ($user_type === 'admin'): ?>
              <a class="admin-button" href="#">
                  <p>Página do admin</p>
                  <ion-icon name="construct-outline"></ion-icon>
              </a>
              <a class="admin-button" href="#"></a>
                    <p>Adicionar novos departamentos/dados/entidades</p>
                    <ion-icon name="add-circle-outline"></ion-icon>
              </a>
              <a class="admin-button" href="#"></a>
                    <p>Promover</p>
                    <ion-icon name="person-add-outline"></ion-icon>
              </a>
          <?php endif; ?>
          </div>
          </nav>
      </section>
  </div>
  <div id="faqs">
    <section class="FAQs">
      <div id="Faqs-icon">
      <ion-icon name="help-circle-outline" id="icon"></ion-icon>
      <p id="p">FAQ's</p>
      <div>
    </section>
  </div>
  <div id="footer">
      <p>Algum footer que queiramos</p>
  </div>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>


<?php
    session_start();
    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/client.php'); 
    require_once(__DIR__ . '/../templates/profile.tpl.php');

    $user_id = $_SESSION['uid'];
    $db = getDatabaseConnection();
    $curr_user = getUser($db, $user_id);

?>

<!DOCTYPE html>
<html>
<head>
  <title>Profile Page</title>
  <link rel="stylesheet" href="pagestyle.css">
</head>
<body>
  <h1>Profile Page</h1>
  <section id="login">
          <div class ="form-box-login" id="login-box">
            <div class="form-value">
              <form>
                <h2>Login</h2>
                <div class="inputbox">
                  <ion-icon name="person-outline"></ion-icon>
                  <input type="text" required id="username" name="username">
                  <label for="username">Username: <?php echo $curr_user['name']; ?></label>
                </div>
                <div class="inputbox">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="text" required id="email" name="email">
                    <label for="email">Email: <?php echo $curr_user['email']; ?></label>
                </div>
                <div class="inputbox">
                  <ion-icon name="lock-closed-outline"></ion-icon>
                  <input type="password" required id="password" name="password">
                  <label for="password">Password: </label>
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
</body>
</html>

<?php
// Fechar a conexão com a base de dados
$db->null;
?>

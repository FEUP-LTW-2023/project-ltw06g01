if (animationFlag == "1") {
  loginBox.style.animation = 'slideOutLoginToLogout 0.6s ease-in-out';
  loginBox2.style.animation = 'slideOutLoginToLogout 0.6s ease-in-out';
  logoutBox.style.display = "grid";
  logoutBox.style.animation = "slideInLogout 2s ease-in-out";
  profileBox.style.display = "grid";
  profileBox.style.animation = "slideInLogout 2s ease-in-out"
  menuBox.style.display = "block";
  menuBox.style.animation = "slideInButtons 2s ease-in-out";

  setTimeout(() => {
  allTicketsDiv.style.display = 'grid';
  allTicketsDiv.style.animation = "slideInButtons 2s ease-in-out";
}, 500)


  setTimeout(() => {
    loginBox.style.display = 'none';
    loginBox2.style.display = 'none';
  }, 500)
}

if (animationFlag == "2") {
  signupBox.style.display = "grid";
  signupBox2.style.display = "flex";
  loginBox.style.display = "none";
  loginBox2.style.display = "none";
  signupBox.style.animation = 'slideOutLoginToLogout 0.6s ease-in-out';
  signupBox2.style.animation = 'slideOutLoginToLogout 0.6s ease-in-out';
  logoutBox.style.display = "grid";
  logoutBox.style.animation = "slideInLogout 2s ease-in-out";
  profileBox.style.display = "flex";
  profileBox.style.display = "slideInLogout 2s ease-in-out";
  setTimeout(() => {
    menuBox.style.display = "flex";
    menuBox.style.animation = "slideInButtons 2s ease-in-out";
  }, 500);
  setTimeout(() => {
  signupBox.style.display = 'none';
  signupBox2.style.display = 'none';
}, 500);
}

if (animationFlag == "3") {

  loginBox.style.display = "none";
  loginBox2.style.display = "none";
  menuBox.style.animation = 'slideOutButtons 2s ease-in-out';
  /*allTicketsDiv.style.animation = 'slideOutButtons 2s ease-in-out';*/ 
  logoutBox.style.animation = 'slideOutLoginToLogout 2s ease-in-out';
  profileBox.style.animation = "slideOutLoginToLogout 2s ease-in-out";

  setTimeout(() => {
    loginBox.style.display = "grid";
    loginBox2.style.display = "flex";
    loginBox.style.animation = "slideInLogout 1s ease-in-out";
    loginBox2.style.animation = "slideInLogout 1s ease-in-out";
    logoutBox.style.display = 'none';
    profileBox.style.display = 'none';
    menuBox.style.display = 'none';
}, 1000)
}

/*para além de criar uma nova transição para o logout a partir de outra page que não a inicial, criar uma transição para o signup, identica à transição 3, mas para o signup*/

if (animationFlag == "4"){
  setTimeout(() => {
  }, 3000)

  console.log('ola');
  logoutBox.style.animation = 'slideOutLoginToLogout 2s ease-in-out';
  profileBox.style.animation = "slideOutLoginToLogout 2s ease-in-out";


  setTimeout(() => {
    logoutBox.style.display = 'none';
    profileBox.style.display = 'none';
  }, 500)
}


if (loggedinFlag != 0 && animationFlag !=1 ) { ///quando se está com sessão iniciada e se dá refresh
  loginBox.style.display = "none";
  loginBox2.style.display = "none";
  logoutBox.style.display = "flex";
  profileBox.style.display = "flex";
  menuBox.style.display = "flex";
  menuBox.style.animation = "slideInButtons 0s ease-in-out"; //pode-se alterar isto para chegar um pouco mais suave, tipo apareceer ja a meio da tela e subir somente um pouco
  allTicketsDiv.style.display = 'grid';

}


if (loggedinFlag == 0 && (animationFlag != 3)) { //quando não se está com a sessão iniciada
  loginBox2.style.display = "flex";
  loginBox.style.display = "grid";
  logoutBox.style.display = "none";
  profileBox.style.display = "none";
  menuBox.style.display = "none";

}




/* para o pop up do user box na página dops admins */

function toggleUserBoxPopup(userId) {
  const userBoxPopup = document.getElementById("userBoxPopup-" + userId);
  const backdrop = document.getElementById("backdrop");

  userBoxPopup.classList.toggle("active");
  backdrop.style.display = userBoxPopup.classList.contains("active") ? "block" : "none";
}

  
  faqsSection.addEventListener('click', function() {
    
    window.location.href = 'faq.php';
  });


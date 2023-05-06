
/*verificar onde colocar esta função, serve para colocar os itens da antiga side bar todos ao mesmo tamanho*/
var itemMenus = document.querySelectorAll('.item-menu');
console.log(itemMenus);
var maxWidth = 0;
for (var i = 0; i < itemMenus.length; i++) {
  var width = itemMenus[i].offsetWidth;
  if (width > maxWidth) {
    maxWidth = width;
  }
}
for (var i = 0; i < itemMenus.length; i++) {
  itemMenus[i].style.width = maxWidth + 'px';
}



//Caso não tenha conta e queira dar signup ou vice versa, então fzemos animações com as boxs
// selecione os elementos DOM
const loginBox = document.querySelector('#login-box');
const signupBox = document.querySelector('#signup-box');
const loginButton = document.querySelector('#login-button');
const signupButton = document.querySelector('#Register-button');
const loginForm = document.querySelector('.submit-login');
const signupForm = document.querySelector('.submit-signup');
const logoutBox = document.querySelector('.logout-box');
const profileBox = document.querySelector('.profile-box');
const menuBox = document.querySelector('#nav');
const afterLoginBox = document.querySelector('.after-login');
const playAnimation = document.querySelector('#animation');
const playLogin = document.querySelector('#loggedin');


const animationFlag = playAnimation.getAttribute('value');
//const loggedinFlag = playLogin.getAttribute('value');  //para verificar a sessão iniciada ou não





// adicione o manipulador de eventos de clique aos botões
loginButton.addEventListener('click', () => {
// verifica se a caixa de login já está visível
if (loginBox.style.display === 'grid') {
return; // não faz nada se já estiver visível
}
else{// esconde a caixa de inscrição e mostra a caixa de login
signupBox.style.animation = 'slideOutRight 1s ease-in-out';
setTimeout(() => {
signupBox.style.display = 'none';
loginBox.style.display = 'grid';
loginBox.style.animation = 'slideInLeft 1s ease-in-out';
}, 900)
}
});

signupButton.addEventListener('click', () => {
// verifica se a caixa de inscrição já está visível
if (signupBox.style.display === 'grid') {
return; // não faz nada se já estiver visível
}
// esconde a caixa de login e mostra a caixa de inscrição
else{
loginBox.style.animation = 'slideOutLeft 1s ease-in-out';
setTimeout(() => {
loginBox.style.display = 'none';
signupBox.style.display = 'grid';
signupBox.style.animation = 'slideInRight 1s ease-in-out';
}, 900)
}
});

/*
logoutForm.addEventListener('click', (event) => {
  console.log("a segunda flag do login, depois de carregar no logout é:" , loggedinFlag);
  logoutBox.style.animation = 'slideOutLoginToLogout 2s ease-in-out';
    
  
  menuBox.style.animation = 'slideOutButtons 1s ease-in-out';
  setTimeout(() => {
    outButtons(user.type);
    loginBox.style.display = "grid";
    loginBox.style.animation = "slideInLogout 1s ease-in-out";
  }, 500)

  setTimeout(() => {
    logoutBox.style.display = 'none';
    menuBox.style.display = 'none';
}, 500)
});
*/


if (animationFlag == "1") {
  loginBox.style.animation = 'slideOutLoginToLogout 0.6s ease-in-out';
  logoutBox.style.display = "grid";
  logoutBox.style.animation = "slideInLogout 2s ease-in-out";
  profileBox.style.display = "grid";
  profileBox.style.animation = "slideInLogout 2s ease-in-out"
  menuBox.style.display = "block";
  menuBox.style.animation = "slideInButtons 2s ease-in-out";
  
  setTimeout(() => {
    loginBox.style.display = 'none';
  }, 500)
}



if (animationFlag == "2") {
  signupBox.style.display = "flex";
  loginBox.style.display = "none";
  signupBox.style.animation = 'slideOutLoginToLogout 0.6s ease-in-out';
  logoutBox.style.display = "grid";
  logoutBox.style.animation = "slideInLogout 2s ease-in-out";
  profileBox.style.display = "flex";
  profileBox.style.display = "slideInLogout 2s ease-in-out";
  setTimeout(() => {
    menuBox.style.display = "flex";
    menuBox.style.animation = "slideInButtons 2s ease-in-out";
  }, 500)
  setTimeout(() => {
  signupBox.style.display = 'none';
}, 500)
}

if (animationFlag == "3") {

  console.log(animationFlag);
  setTimeout(() => {

  menuBox.style.animation = 'slideOutButtons 2s ease-in-out';
  logoutBox.style.animation = 'slideOutLoginToLogout 2s ease-in-out';
  profileBox.style.animation = "slideOutLoginToLogout 2s ease-in-out";
}, 200)

  setTimeout(() => {
    loginBox.style.display = "grid";
    loginBox.style.animation = "slideInLogout 1s ease-in-out";
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



if (loggedinFlag && animationFlag !=1 ) { ///quando se está com sessão iniciada e se dá refresh
  loginBox.style.display = "none";
  logoutBox.style.display = "flex";
  profileBox.style.display = "flex";
  menuBox.style.display = "flex";
  menuBox.style.animation = "slideInButtons 0s ease-in-out"; //pode-se alterar isto para chegar um pouco mais suave, tipo apareceer ja a meio da tela e subir somente um pouco
}


if (loggedinFlag == 0 && (animationFlag != 3)) { //quando não se está com a sessão iniciada
  loginBox.style.display = "grid";
  logoutBox.style.display = "none";
  profileBox.style.display = "none";
  menuBox.style.display = "none";
}






// Exemplo de autenticação 
var user = {
  type: 'client'
};
//Caso não tenha conta e queira dar signup ou vice versa, então fzemos animações com as boxs
// selecione os elementos DOM
const loginBox = document.querySelector('#login-box');
const signupBox = document.querySelector('#signup-box');
const loginButton = document.querySelector('#login-button');
const signupButton = document.querySelector('#Register-button');
const loginForm = document.querySelector('.submit-login');
const signupForm = document.querySelector('.submit-signup');
const logoutForm = document.querySelector('.logout-box');
const logoutBox = document.querySelector('.logout-box');
const beforeMenuBox = document.querySelector('.before-menu');
const menuBox = document.querySelector('.menu');
const afterLoginBox = document.querySelector('.after-login');


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

//Para ao dar login enviar a box do login para cima e aparecer logout:
<<<<<<< HEAD
loginForm.addEventListener('click', (event) => {
  //event.preventDefault();
=======
loginForm.addEventListener('submit', (event) => {
  event.preventDefault();
>>>>>>> ad66340962e40e7b74b5eb19f69e74a0ff148050
  loginBox.style.animation = 'slideOutLoginToLogout 0.6s ease-in-out';
  logoutBox.style.display = "grid";
  logoutBox.style.animation = "slideInLogout 2s ease-in-out";
  /* ainda a implementar
  beforeMenuBox.style.display = "grid";
  beforeMenuBox.style.animation = "slideInButtons 2s ease-in-out";
  */

  setTimeout(() => {
    menuBox.style.display = "flex";
    menuBox.style.animation = "slideInButtons 1.2s ease-in-out";
  }, 500)
  
  showButtons(user.type);
  setTimeout(() => {
    loginBox.style.display = 'none';
  }, 500)
});

//Para ao dar signup enviar a box do signup para cima e aparecer logout:
signupForm.addEventListener('click', (event) => {
  event.preventDefault();
  signupBox.style.animation = 'slideOutLoginToLogout 0.6s ease-in-out';
  logoutBox.style.display = "grid";
  logoutBox.style.animation = "slideInLogout 2s ease-in-out";
  beforeMenuBox.style.display = "grid";
  beforeMenuBox.style.animation = "slideInButtons 2s ease-in-out";
  setTimeout(() => {
    menuBox.style.display = "flex";
    menuBox.style.animation = "slideInButtons 2s ease-in-out";
  }, 500)
  showButtons(user.type);
  setTimeout(() => {
  signupBox.style.display = 'none';
}, 500)
});

logoutForm.addEventListener('click', (event) => {
  event.preventDefault();
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

function showButtons(userType) {
  if(userType != 'none'){
  var clientButtons = document.querySelectorAll('.client-button');
    for (var i = 0; i < clientButtons.length; i++) {
      clientButtons[i].style.animation = "expand 2s ease-out";
      clientButtons[i].style.display = 'inline-grid';
    }
  
  // Mostrar botões relevantes com base no tipo de usuário
  if (userType === 'admin') {
    var agentButtons = document.querySelectorAll('.agent-button');
    for (var i = 0; i < agentButtons.length; i++) {
      agentButtons[i].style.animation = "expand 2s ease-out";
      agentButtons[i].style.display = 'inline-grid';
    }
    var adminButtons = document.querySelectorAll('.admin-button');
    for (var i = 0; i < adminButtons.length; i++) {
      adminButtons[i].style.animation = "expand 2s ease-out";
      adminButtons[i].style.display = 'inline-grid';
    }
  } 
  else if (userType === 'agent') {
    var agentButtons = document.querySelectorAll('.agent-button');
    for (var i = 0; i < agentButtons.length; i++) {
      clientButtons[i].style.animation = "expand 2s ease-out";
      agentButtons[i].style.display = 'inline-grid';
    }
  } 
}
}

function outButtons(userType) {
  if(userType != 'none'){
  var clientButtons = document.querySelectorAll('.client-button');
    for (var i = 0; i < clientButtons.length; i++) {
      clientButtons[i].style.animation = "slideOutButtons 1s ease-in-out";
      setTimeout(() => {
      clientButtons[i].style.display = 'none';
    }, 500)
    }
  
  // Mostrar botões relevantes com base no tipo de usuário
  if (userType === 'admin') {
    var agentButtons = document.querySelectorAll('.agent-button');
    for (var i = 0; i < agentButtons.length; i++) {
      agentButtons[i].style.animation = "slideOutButtons 1s ease-in-out";
      setTimeout(() => {
      agentButtons[i].style.display = 'none';
    }, 500)
    }
    var adminButtons = document.querySelectorAll('.admin-button');
    for (var i = 0; i < adminButtons.length; i++) {
      adminButtons[i].style.animation = "slideOutButtons 1s ease-in-out";
      setTimeout(() => {
      adminButtons[i].style.display = 'none';
    }, 500)
    }
  } 
  else if (userType === 'agent') {
    var agentButtons = document.querySelectorAll('.agent-button');
    for (var i = 0; i < agentButtons.length; i++) {
      clientButtons[i].style.animation = "slideOutButtons 1s ease-in-out";
      setTimeout(() => {
      agentButtons[i].style.display = 'none';
    }, 500)
    }
  } 
}
}


function showButtons(userType) {
  if(userType != 'none'){
  // Esconder todos os botões primeiro
  var clientButtons = document.querySelectorAll('.client-button');
    for (var i = 0; i < clientButtons.length; i++) {
      clientButtons[i].style.display = 'inline-block';
    }
  
  // Mostrar botões relevantes com base no tipo de usuário
  if (userType === 'admin') {
    var agentButtons = document.querySelectorAll('.agent-button');
    for (var i = 0; i < agentButtons.length; i++) {
      agentButtons[i].style.display = 'inline-block';
    }
    var adminButtons = document.querySelectorAll('.admin-button');
    for (var i = 0; i < adminButtons.length; i++) {
      adminButtons[i].style.display = 'inline-block';
    }
  } 
  else if (userType === 'agent') {
    var agentButtons = document.querySelectorAll('.agent-button');
    for (var i = 0; i < agentButtons.length; i++) {
      agentButtons[i].style.display = 'inline-block';
    }
  } 
}
}

// Exemplo de autenticação 
var user = {
  type: 'none'
};

window.onload = function() {
  showButtons(user.type);
};


//Caso não tenha conta e queira dar signup ou vice versa, então fzemos animações com as boxs
// selecione os elementos DOM
const loginBox = document.querySelector('#login-box');
const signupBox = document.querySelector('#signup-box');
const loginButton = document.querySelector('#login-button');
const signupButton = document.querySelector('#Register-button');


// adicione o manipulador de eventos de clique aos botões
loginButton.addEventListener('click', () => {
// verifica se a caixa de login já está visível
if (loginBox.style.display === 'block') {
return; // não faz nada se já estiver visível
}
else{// esconde a caixa de inscrição e mostra a caixa de login
signupBox.style.animation = 'slideOutRight 1s ease-in-out';
setTimeout(() => {
signupBox.style.display = 'none';
loginBox.style.display = 'block';
loginBox.style.animation = 'slideInLeft 1s ease-in-out';
}, 900)
}
});

signupButton.addEventListener('click', () => {
// verifica se a caixa de inscrição já está visível
if (signupBox.style.display === 'block') {
return; // não faz nada se já estiver visível
}
// esconde a caixa de login e mostra a caixa de inscrição
else{
loginBox.style.animation = 'slideOutLeft 1s ease-in-out';
setTimeout(() => {
loginBox.style.display = 'none';
signupBox.style.display = 'block';
signupBox.style.animation = 'slideInRight 1s ease-in-out';
}, 900)
}
});

const loginForm = document.querySelector('.form-box-login');
//Para ao dar login enviar a box do login para cima:
loginForm.addEventListener('submit', (event) => {
  event.preventDefault();
  loginForm.classList.add('hidden');
  setTimeout(() => {
    window.location.href = 'mainpage.html';
  }, 500);
});



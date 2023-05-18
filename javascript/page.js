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
// Quando se passa da box de login para a de signup

loginButton.onclick = function() {
    if (loginBox.style.display === 'grid') {return;}
    else{
        signupBox.style.animation = 'slideOutRight 1s ease-in-out';
        signupBox2.style.animation = 'slideOutRight 1s ease-in-out';
        setTimeout(() => {
        signupBox.style.display = 'none';
        signupBox2.style.display = 'none';
        loginBox.style.display = 'grid';
        loginBox.style.animation = 'slideInLeft 1s ease-in-out';
        loginBox2.style.display = 'flex';
        loginBox2.style.animation = 'slideInLeft 1s ease-in-out';
        }, 900)
        }
    }

signupButton.onclick = function() {
    if (signupBox.style.display === 'grid') {return;}

    else{
        loginBox.style.animation = 'slideOutLeft 1s ease-in-out';
        loginBox2.style.animation = 'slideOutLeft 1s ease-in-out';
        setTimeout(() => {
        loginBox.style.display = 'none';
        loginBox2.style.display = 'none';
        signupBox.style.display = 'grid';
        signupBox2.style.display = 'flex';
        signupBox.style.animation = 'slideInRight 1s ease-in-out';
        signupBox2.style.animation = 'slideInRight 1s ease-in-out';
        }, 900)
        }
    }
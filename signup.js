document.addEventListener("DOMContentLoaded", function(){
    const BtnSubmit = document.getElementById("submit-btn")  || document.querySelector(".signup-button");

    const validate = (e) => {
        const name = document.getElementById("name");
        const surname = document.getElementById("surname");
        const email = document.getElementById("email");
        const username = document.getElementById("username");
        const password = document.getElementById("password");
        const confirmpassword = document.getElementById("confirmpassword");
    
    if(name.value === ""){
        e.preventDefault();
        alert("Please enter your name.");
        name.focus();
        return false;
    }
    if(surname.value === ""){
        e.preventDefault();
        alert("Please enter your surname.");
        surname.focus();
        return false;
    }
    if(email.value === ""){
        e.preventDefault();
        alert("Please enter your email.");
        email.focus();
        return false;
    }
    if (!emailValid(email.value)) {
        e.preventDefault();
            alert("Please enter a valid email.");
            email.focus();
            return false;
        }
    if(username.value === ""){
        e.preventDefault();
        alert("Please enter your username.");
        username.focus();
        return false;
    }
    if(password.value === ""){
        e.preventDefault();
        alert("Please enter your password.");
        password.focus();
        return false;
    }
    if (!passwordValid(password.value)) {
        e.preventDefault();
            alert("Password must be at least 8 characters long, contain one uppercase letter and one special character.");
            password.focus();
            return false;
        }
    if(confirmpassword.value === ""){
        e.preventDefault();
        alert("Please enter your password.");
        confirmpassword.focus();
        return false;
    }
    if(password.value !== confirmpassword.value){
        e.preventDefault();
        alert("Password didn't match");
        confirmpassword.focus();
        return false;
    }
    return true;
};
    const emailValid = (email) => {
    const emailRegex = /^([A-Za-z0-9_\-.])+@([A-Za-z0-9_\-.])+\.([A-Za-z]{2,4})$/;
    return emailRegex.test(email.toLowerCase());
  };
  const passwordValid = (password) => {
        const passwordRegex = /^(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$/;
        return passwordRegex.test(password);
    };

  document.getElementById("registerForm").addEventListener("submit", validate);

});
document.addEventListener("DOMContentLoaded", function(signup){
    const BtnSubmit = document.getElementById("submit-btn")  || document.querySelector(".signup-button");

    const validate = (signup) => {
        signup.preventDefault();

        const name = document.getElementById("name");
        const surname = document.getElementById("surname");
        const email = document.getElementById("email");
        const username = document.getElementById("username");
        const password = document.getElementById("password");
        const confirmpassword = document.getElementById("confirmpassword");
    
    if(name.value === ""){
        alert("Please enter your name.");
        name.focus();
        return false;
    }
    if(surname.value === ""){
        alert("Please enter your surname.");
        surname.focus();
        return false;
    }
    if(email.value === ""){
        alert("Please enter your email.");
        email.focus();
        return false;
    }
    if (!emailValid(email.value)) {
            alert("Please enter a valid email.");
            email.focus();
            return false;
        }
    if(username.value === ""){
        alert("Please enter your username.");
        username.focus();
        return false;
    }
    if(password.value === ""){
        alert("Please enter your password.");
        password.focus();
        return false;
    }
    if (!passwordValid(password.value)) {
            alert("Password must be at least 8 characters long, contain one uppercase letter and one special character.");
            password.focus();
            return false;
        }
    if(confirmpassword.value === ""){
        alert("Please enter your password.");
        confirmpassword.focus();
        return false;
    }
    if(password.value !== confirmpassword.value){
        alert("Password didn't match");
        confirmpassword.focus();
        return false;
    }
    alert("Your data was saved successfully!");
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

  BtnSubmit.addEventListener("click", validate);
});
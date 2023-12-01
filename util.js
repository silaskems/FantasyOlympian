//creat accont.
var createAccount = document.getElementById("create-account");
var login = document.getElementById("login");
var createLink = document.getElementById("create-link");
var loginLink = document.getElementById("login-link");
var checkUser = document.getElementById("check-user");


var usernames = {"a": "a"};

createLink.addEventListener("click", function(){
    createAccount.style.display = "block";
    login.style.display = "none";
})

loginLink.addEventListener("click", function(){
    createAccount.style.display = "none";
    login.style.display = "block";
})

login.addEventListener("submit", function(event) {
    event.preventDefault(); 

    var currentUser = document.getElementById("username").value;
    var currentPassword = document.getElementById("password").value;

    if (usernames[currentUser] !== currentPassword) {
        alert("Incorrect username or password");
    } else {
        console.log("Login successful");
        window.location.assign("index.html");
    }
});


var createUser = document.getElementById("create-user");
createUser.addEventListener("click", function(){
    var username = document.getElementById("c-user").value;
    var password = document.getElementById("c-password").value;
    var confirm = document.getElementById("conf-password").value;

    //logic to handle create account.
    
    if (password != confirm){
        alert("Passwords don't match.")
    } else if (username in usernames){
        alert("Username Already exists");
    }else {
        usernames[username] = password;
    }
})


//forgot password
var passwordReset = document.getElementById("password-reset");
var forgotPasswordLink = document.getElementById("forgot-password");
var backToLoginLink = document.getElementById("back-to-login");
var sendResetLink = document.getElementById("send-reset-link");


forgotPasswordLink.addEventListener("click", function() {
    passwordReset.style.display = "block";
    login.style.display = "none";
    createAccount.style.display = "none";
});


backToLoginLink.addEventListener("click", function() {
    login.style.display = "block";
    passwordReset.style.display = "none";
});

sendResetLink.addEventListener("click", function() {
    var resetUsername = document.getElementById("reset-username").value;
    var resetEmail = document.getElementById("reset-email").value;

    //logic to handle the password reset request
    
    alert("Reset link sent to: " + resetEmail);

    
    login.style.display = "block";
    passwordReset.style.display = "none";
});


function isValidEmail(email) {
    var pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return pattern.test(email);
}


sendResetLink.addEventListener("click", function(event) {
    event.preventDefault(); 

    var resetUsername = document.getElementById("reset-username").value;
    var resetEmail = document.getElementById("reset-email").value;

    if (resetUsername.trim() === "") {
        alert("Please enter your username.");
        return;
    }

    if (!(resetUsername in usernames)) {
        alert("User does not exist.");
        return;
    }

    if (resetEmail.trim() === "") {
        alert("Please enter your email address.");
        return;
    }

    if (!isValidEmail(resetEmail)) {
        alert("Invalid email address.");
        return;
    }

    // logic to handle the password reset request
    
    alert("Reset link sent to: " + resetEmail);

    
    login.style.display = "block";
    passwordReset.style.display = "none";
});

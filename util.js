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

checkUser.addEventListener("click", function(){
    var currentUser = document.getElementById("username").value;
    var currentPassword = document.getElementById("password").value;
    if (usernames[currentUser] != currentPassword){
        alert("incorrect username or password");
    } else {
        console.log("hello");
        var host = window.location.host; 
        location.assign("index.html");
        console.log(window.location.href);
    }
});

var createUser = document.getElementById("create-user");
createUser.addEventListener("click", function(){
    var username = document.getElementById("c-user").value;
    var password = document.getElementById("c-password").value;
    var confirm = document.getElementById("conf-password").value;
    
    if (password != confirm){
        alert("Passwords don't match.")
    } else if (username in usernames){
        alert("Username Already exists");
    }else {
        usernames[username] = password;
    }
})


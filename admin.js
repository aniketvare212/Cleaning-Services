function admin() {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    
    if (username === "admin" && password === "123") {
        alert("Login successful!");
        
        window.location.href ="#";
    } else {
        alert("Invalid username or password.");
    }
}
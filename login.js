function admin() {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    // Check for "user" credentials
    if (username === "user" && password === "123") {
        alert("Login successful!");
        window.location.href = "Home.html";  // Redirect to the Home page

    // Check for "admin" credentials
    } else if (username === "admin" && password === "123") {
        alert("Login successful!");
        window.location.href = "Admin_dashboard.php";  // Redirect to the Admin dashboard

    // If neither of the conditions match, show an error
    } else {
        alert("Invalid username or password.");
    }
}

function customer_reg() {
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var con_password = document.getElementById('Confirm password').value;

    
    if (name === "" && email==="" && password === "" && con_password==="") {
        alert("Register successful!");
        
        window.location.href ="login.html";
    } else {
        alert("Invalid Data.");
    }
    document.getElementById('registrationForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting the traditional way
        // Here you would typically make an AJAX request to your server-side script (register.php)
        // For simplicity, we're just showing the success message
        document.getElementById('successMessage').style.display = 'block';
    });
    
}
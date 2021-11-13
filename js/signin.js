// Page Title
$('#page-title').text('Signin - Haldoor')

// On Form Submit
$('#singin-form').on('submit', function(e) {
    e.preventDefault()  

    var email = document.getElementById('email').value
    var password = document.getElementById('pwd').value

    $.ajax({
        url:"/api/signin.php",
        method:"POST",
        data: { email: email, password: password },
        beforeSend: function(){
            $("#overlay").fadeIn(300);
        },
        success:function(data)
        {
            var response = JSON.parse(JSON.stringify(data))
                
            if (response.error === true) {
                
                // Alert
                notify_error(response.message)
            }
            else {
                
                // Redirect to home 
                window.location.replace("")
                
            }
            
        },
        complete:function(){
            $("#overlay").fadeOut(300);
        }

    });

})
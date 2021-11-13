// Page Title
$('#page-title').text('New User - Haldoor')

// Active Page
$('#users-nav').addClass('selected')

$('#users-nav .has-arrow, #new-user-nav').addClass('active')

$('#users-nav .base-level-line').addClass('in')

// Focus Name
$('#user_name')[0].focus()

var pwd = document.getElementById("pwd")
var cpwd = document.getElementById("cpwd")
var cpwdHelp = document.getElementById("cpwdHelp")

pwd.addEventListener("input", function (event) {
    validate_Password()
});

cpwd.addEventListener("input", function (event) {
    validate_Password()
});

function validate_Password() {
  
    if(pwd.value !== '') {
  
      if (pwd.value === cpwd.value) {
        cpwdHelp.className = "form-text text-success"
        cpwdHelp.innerHTML = "Password Confirmed"
      } 
      else {
        cpwdHelp.className = "form-text text-danger"
        cpwdHelp.innerHTML = "Confirm Password"
      }
  
    }
  
    else {
      cpwdHelp.className = "form-text text-muted"
      cpwdHelp.innerHTML = "Re write password"
    }
  
}

$('#users-form').on('submit', function(e) {
  e.preventDefault()

  var name = document.getElementById("user_name").value
  var email = document.getElementById("user_email").value
  var password = document.getElementById("pwd").value
  var confirm_password = document.getElementById("cpwd").value

  if (password === "" || password !== confirm_password) {
    cpwd.focus()
  }
  else {

    $.ajax({
      url:"/api/users.php",
      method:"POST",
      data: {action: "new" , name: name, email: email, password: password,  confirm_password: confirm_password },
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
              
              // Alert
              notify_success(response.message)

             // Redirect after 3 milli second
             setTimeout(() => {
                window.location.replace("/users/listing.php")
             }, 300);
              
          }
         
          
      },
      complete:function(){
          $("#overlay").fadeOut(300);
      }

    });

  }

})


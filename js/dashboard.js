// Page Title
$('#page-title').text('Dashboard - Haldoor')

// Active Page
$('#dashboard-nav').addClass('selected')


// Fetch Informations
$.ajax({
    url:"/api/dashboard.php",
    method:"POST",
    beforeSend: function() {
        $("#overlay").fadeIn(300);
    },
    success:function(data)
    {

        var response = JSON.parse(JSON.stringify(data))
        var row = ''  

        if (response.error === true) {
            $('#graduations-number').text("**")
            $('#achievements-number').text("**")
            $('#keynotes-number').text("**")
        }

        else {

            $('#graduations-number').text(response.data[0].graduations)
            $('#achievements-number').text(response.data[0].achievements)
            $('#keynotes-number').text(response.data[0].keynotes)
                        
        }
       
    },
    complete:function(data){
        $("#overlay").fadeOut(300);
    }
})
// Page Title
$('#page-title').text('New Achievements - Haldoor')

$('#achievements-form').on('submit', function(e) {

    e.preventDefault()

    var image = document.getElementById("image").files[0]

    // Validate File
    const fileMimeTypes = /jpeg|jpg|png|gif/;
    const fileTypes     = /jpeg|jpg|png|gif/;

    const fileName = image.name
    const fileSize = image.size
    const mimetype = fileMimeTypes.test(image.type);
    const extname = fileTypes.test(image.name.split('.').pop());        
  
    if (!mimetype || !extname) {
        notify_error(fileName +" is not an Image file, only JPG, PNG and GIF are allowed")
    }
    else if (fileSize > 5000000) {
        notify_error(fileName +" is large file, please use file with size less than 5MB")
    }
    else {

        // Get form
        var form = $('#achievements-form')[0];

        // Create an FormData object 
        var data = new FormData(form);

        $.ajax({
            url:"/api/achievements.php",
            method:"POST",
            data: data,
            enctype: 'multipart/form-data',
            contentType: false,
            cache: false,
            processData: false,
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
                        window.location.replace("/achievements/listing.php")
                    }, 300);
                        
                }
                
            },
            complete:function(){
                $("#overlay").fadeOut(300);
            }

        });

    }

})

// Page Title
$('#page-title').text('Listing of Achievements - Haldoor')

// Fetch
var fetch_container = document.getElementById('achievments-table')

// Fetch
fetch()
function fetch(pageNo = 1) {

    $.ajax({
        url:"/haldoor-admin/api/achievements.php",
        method:"POST",
        data: {action: "fetch", page_no: pageNo },
        beforeSend: function() {
            $("#overlay").fadeIn(300);
            $('#search-input').val('') // Empty Search
        },
        success:function(data)
        {

            var response = JSON.parse(JSON.stringify(data))
            var row = ''  

            if (response.error === true) {
                row += '<tr>'
                row += '<td colspan="3">' + response.message + '</td>'
                row += '</tr>'

                // Initialize fetched data to container
                fetch_container.innerHTML = row
                // pagination_container.innerHTML = ""

            }

            else {

                var no  = response.pageNo       // Get current page
                no *= response.singlePageRows   // Multiply with the page rows
                no -= response.singlePageRows   // Substitute the page rows in order to get the first number of this page

                for (i = 0; i < response.data.length; i++) {

                    no ++ // Increment

                    row += '<tr>'

                    row += '<td>'+ no +'</td>'

                    row += `<td>
                                <img onerror="this.onerror=null;this.src='/haldoor-admin/assets/img/placeholder.png';" src="/haldoor-admin/uploads/achievements/`+ response.data[i].image +`" alt="" style="max-width: 120px;">
                            </td>`

                    row += '<td>'+ response.data[i].title +'</td>'

                    row += `<td class="text-end">
                                <a onclick="edit('`+ response.data[i].id +`')">
                                    <i class="far fa-edit text-dark"></i> 
                                </a>   
                                <a onclick="remove('`+ response.data[i].id  +`', '`+ response.data[i].image +`')">
                                    <i class="fas fa-trash-alt text-dark"></i> 
                                </a>   
                            </td>`;

                    row += '</tr>'

                } 

                // // Initialize fetched data to container
                fetch_container.innerHTML = row
                
                /*
                var paginationsHtml = ""

                var total_pages = Math.ceil(response.totalRows / response.singlePageRows)
                var pageNo = parseInt(response.pageNo)
                var next = 0

                if(response.data.length >= response.singlePageRows && total_pages > 1) {    

                    if((pageNo * response.singlePageRows) === response.totalRows) {
                        next = 0
                    }
                    else {
                        next = pageNo + 1  
                    }
                    
                }

                var previous = pageNo - 1
                var current = pageNo
                var next = next
                var pages = total_pages               
                
                if(previous !== 0) {
                    paginationsHtml += '<li  onclick="goPage('+ previous +')" class="page-item previous"><span class="page-link">Previous</span></span></li>'
                }
                else {
                    paginationsHtml += '<li class="page-item previous disabled"><span class="page-link">Previous</span></span></li>'
                }
                
                if(pages !== 0) {
              
                    var page = 1
              
                    while(page <= pages) {
              
                        if(page === current) {
                            paginationsHtml += '<li class="page-item active"><a class="page-link">'+ page +'</a></li>'
                        }
                        else {
                            paginationsHtml += '<li class="page-item"><a onclick="goPage('+ page +')" class="page-link">'+ page +'</a></li>'
                        }
                        
                        page ++
                    }
              
                }

                if(response.data.length > 0 && next !== 0 && current !== pages) {
                    paginationsHtml += '<li class="page-item next"><a class="page-link" onclick="goPage('+ next +')">Next</span></a></li>'
                }
                else {
                    paginationsHtml += '<li class="page-item next disabled"><a class="page-link" onclick="goPage('+ next +')">Next</span></a></li>'
                }

                pagination_container.innerHTML = paginationsHtml
                */

            }
           
        },
        complete:function(data){
            $("#overlay").fadeOut(300);
        }
    })
    
}

// Search
$('#search-input').keyup(function(e) {
    e.preventDefault()

    // Its Enter Click
    var code = e.keyCode || e.which;
    if(code == 13) { 
        
        var searchingText = document.getElementById('search-input').value

        if (searchingText === "" || searchingText === null) {   
            fetch()   // Refresh Data
        }
        else {

            $.ajax({
                url:"/haldoor-admin/api/achievements.php",
                method:"POST",
                data: { action: "search", searching_text: searchingText },
                beforeSend: function() {
                    $("#overlay").fadeIn(300);
                },
                success:function(data)
                {

                    var response = JSON.parse(JSON.stringify(data))
                    var row = ''  
        
                    if (response.error === true) {
                        row += '<tr>'
                        row += '<td colspan="3">' + response.message + '</td>'
                        row += '</tr>'
        
                        // Initialize fetched data to container
                        fetch_container.innerHTML = row
                        // pagination_container.innerHTML = ""
        
                    }
        
                    else {
        
                        var no  = 0

                        for (i = 0; i < response.data.length; i++) {
        
                            no ++ // Increment
        
                            row += '<tr>'

                            row += '<td>'+ no +'</td>'

                            row += `<td>
                                        <img onerror="this.onerror=null;this.src='/haldoor-admin/assets/img/placeholder.png';" src="/haldoor-admin/uploads/achievements/`+ response.data[i].image +`" alt="" style="max-width: 120px;">
                                    </td>`
        
                            row += '<td>'+ response.data[i].title +'</td>'
        
                            row += `<td class="text-end">
                                        <a onclick="edit('`+ response.data[i].id +`')">
                                            <i class="far fa-edit text-dark"></i> 
                                        </a>   
                                        <a onclick="remove('`+ response.data[i].id  +`', '`+ response.data[i].image +`')">
                                            <i class="fas fa-trash-alt text-dark"></i> 
                                        </a>   
                                    </td>`;
                
                            row += '</tr>'
        
                        } 
        
                        // Initialize fetched data to container
                        fetch_container.innerHTML = row
                        // pagination_container.innerHTML = ""
        
                    }
        
                },
                complete:function(data){
                    $("#overlay").fadeOut(300);
                }
            })

        }


    }
    
})

// Edit
function edit(id) {
    window.location.replace("edit.php?id="+ id)
}

// Remove
function remove(id, filename) {

    $.ajax({
        url:"/haldoor-admin/api/achievements.php",
        method:"POST",
        data: {action: "remove" , id: id, deleting_filename: filename },
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
                  window.location.replace("/haldoor-admin/achievements/listing.php")
               }, 500);
                
            }
           
            
        },
        complete:function(){
            $("#overlay").fadeOut(300);
        }
  
    });

}

// Page Title
$('#page-title').text('Contacts - Haldoor')

var fetch_container = document.getElementById('contacts-table')

var contacts_data = []

// Fetch
fetch()
function fetch(pageNo = 1) {

    $.ajax({
        url:"/haldoor-admin/api/contacts.php",
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

                contacts_data = response.data;
                
                for (i = 0; i < response.data.length; i++) {

                    no ++ // Increment

                    row += '<tr>'

                    row += '<td>'+ no +'</td>'
                    row += '<td>'+ response.data[i].name +'</td>'
                    row += '<td>'+ response.data[i].email +'</td>'
                    row += '<td>'+ response.data[i].subject +'</td>'

                    row += `<td class="text-end">
                                <a onclick="detail('`+ i +`')">
                                    <i class="fas fa-eye text-dark"></i> 
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
                url:"/haldoor-admin/api/contacts.php",
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
                            row += '<td>'+ response.data[i].name +'</td>'
                            row += '<td>'+ response.data[i].email +'</td>'
                            row += '<td>'+ response.data[i].subject +'</td>'
        
                            row += `<td class="text-end">
                                        <a onclick="detail('`+ i +`')">
                                            <i class="fas fa-eye text-dark"></i> 
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


// Detail 
function detail(index) {
    $('#show-feedback-detail').click()
    $('#feedback-contents').text(contacts_data[index].message)
}

function notify_error(msg) {

    $.notify({
        // options
        icon: "perm_scan_wifi",
        message: '<b> '+ msg +' </b>'
      },{
        // settings
        type: 'danger',
        placement: {
            from: "bottom",
            align: "left"
        },
        timer: 5000,
        spacing: 10,
        offset: 20
    });   

}

function notify_success(msg) {

    $.notify({
        // options
        icon: "perm_scan_wifi",
        message: '<b> '+ msg +' </b>'
      },{
        // settings
        type: 'success',
        placement: {
            from: "top",
            align: "center"
        },
        timer: 5000,
        spacing: 10,
        offset: 20
    });
       
}
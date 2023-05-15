/* Login AJAX */

$('.login').click(function() {
    $.ajax({
        url:'./assets/dist/php/router/router.php?action=login',
        data:$('#login-form').serialize(),
        type:'POST',
        beforeSend:function() {
        //   add loading gif soon pls dont forogo 
        },
        success:function(e) {
            if(e === 'Invalid credentials') {
                $('.login-msg-status').removeClass('invi');
                $('.login-msg-status').text('* ' + e);
            } else {
                window.location.href = "./assets/dist/php/pages/chatroom.php";
            }
        }
    })
})

/* $('.register').click(function() {
    $.ajax({
        url:'../router/router.php?action=register',
        data:$("#register-form").serialize(),
        type:'POST',
        beforeSend:function() {
            
        },
        success:function(e) {
            if (e === 'Registration Success') {
                window.location.href = "../../../../index.php";
            } else {
                console.log(e);
            }
        }
    })
}) */

$('#logout').click(function() {
    $.ajax({
        url:'../router/router.php?action=logout',
        type:'POST',
        beforeSend:function() {
            // add loading gif soon (dont forgor)
        },
        success:function() {
            window.location.href = "../../../../index.php"
        }
    })
})
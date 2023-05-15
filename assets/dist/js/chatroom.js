const chatbox = document.querySelector(".chat-box");

chatbox.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
        $.ajax({
            url:'../../php/router/router.php?action=send',
            data:{
                'message':chatbox.value
            },
            type: 'POST',
            success:function() {
                chatbox.value = "";
            }
        })
    }
})

setInterval(function() {
    $.ajax({
        url:'../../php/router/router.php?action=fetch',
        type: 'GET',
        success:function(e) {
            $('main').html(e);
        }
    })
}, 1000)
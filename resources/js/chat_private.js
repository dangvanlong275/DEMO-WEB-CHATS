const content_el = $("#content")
const id_room = $("#room_input").val()
const user_name = $("#user_name").val()
$('#content_input').keypress(function() {

    const channel = Echo.private('chat_private.' + id_room)
    setTimeout(() => {
        channel.whisper('typing', {
            name: user_name,
            typing: true
        })
    }, 500)
})
$('#content_input').blur(function() {
    const channel = Echo.private('chat_private.' + id_room)
    setTimeout(() => {
        channel.whisper('typing', {
            name: null,
            typing: true
        })
    }, 500)
})

window.Echo.private('chat_private.' + id_room)
    .listenForWhisper('typing', (e) => {
        notifi = $("#notifi_text")
        if (e.name == null)
            notifi.remove()
        else
            notifi.html(e.name + " đang soạn tin.....")
    })
    .listen('.chat.private', (e) => {
        console.log(e)
        const date = new Date(e.created_at)
        const div = document.createElement('div');
        div.className = 'd-flex justify-content-start mb-4';
        div.innerHTML = `<div class="img_cont_msg">
                                     <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                                         class="rounded-circle user_img_msg">
                                 </div>
                                 <div class="msg_cotainer" title="` + date.getHours() + ` : ` + date.getMinutes() + `">
                                     ` + e.content + `
                                 </div>`
        content_el.append(div)
    })
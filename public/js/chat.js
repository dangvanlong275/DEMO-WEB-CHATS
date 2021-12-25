$(document).ready(function() {
    $('#action_menu_btn').click(function() {
        $('.action_menu').toggle();
    });
});
const room_input = document.getElementById("room_input")
const content_input = document.getElementById("content_input")

const content_el = document.getElementById("content")
const message_form = document.getElementById("message_form")

message_form.addEventListener("submit", function(e) {
    e.preventDefault();
    let has_errors = false;
    if (content_input.value == '') {
        alert("Please enter message....")
        has_errors = true
    }
    if (has_errors) {
        return
    }
    const options = {
        method: 'post',
        url: '/send-message',
        data: {
            room: room_input.value,
            content: content_input.value
        }
    }
    $("#content_input").attr("placeholder", "Type your message...")
    const div = document.createElement('div');
    const now = Date.now()
    const date = new Date(now)
    div.className = 'd-flex justify-content-end mb-4';
    div.innerHTML = `<div class="msg_cotainer_send" title="` + date.getHours() + ` : ` + date.getMinutes() + `">
                            ` + content_input.value + `
                        </div>
                        <div class="img_cont_msg">
                            <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                                class="rounded-circle user_img_msg">
                        </div>`
    content_el.appendChild(div)
    content_input.value = ""
    axios(options)
})
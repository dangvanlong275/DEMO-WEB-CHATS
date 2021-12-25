$('#search_user').keyup(function() {
    keyword = this.value
    user_id = $('#user_id').val()
    $.ajax({
        type: 'get',
        url: '/search-user',
        data: {
            keyword: keyword,
            user_id: user_id
        },
        success: function(data) {
            $('#list_user').html(data)
        }
    })
})

$('#add_member').keyup(function() {
    keyword = this.value
    room_id = $('#room_input').val()
    $.ajax({
        type: 'get',
        url: '/search-add-user',
        data: {
            keyword: keyword,
            room_id: room_id
        },
        success: function(data) {
            $('#seach_add_member').html(data)
        }
    })
})

$('#form_remove_member').submit(function() {
    if (confirm('Agree to delete member ?'))
        return true
    return false
})
/** Unfriend User */
function unfriend(callback) {
    $(document).on('click', '.unfriend', function () {
        let relationship = $(this).data('relationship');
        $(this).prop('disabled', true);
        makeAjaxRequest('users/unfriend','post', {relationship: relationship},(err, res) => {
            callback()
        })
    })
}

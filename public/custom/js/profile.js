$(document).ready(function () {
    handlePostClick();
    friend();
    unfriend(() => {
        pageReload();
    });
    handleSentRequest();
    handleNotificationStatusChange();
})


function handlePostClick() {
    $(".post").click(function () {
        postOnProfile();
    });
    $("textarea").keyup(function(e) {
        let enterKeyCode = 13;
        let code = e.keyCode ? e.keyCode : e.which;
        if (code === enterKeyCode) {
            postOnProfile();
        }
    });
}

function postOnProfile() {
    let postContent = $("textarea").val();
    let user = $('.post').data('target-user');
    if(postContent.length === 0) {
        return;
    }
    $('.post').prop('disabled', true);
    makeAjaxRequest('user/post', 'post', {user: user, value: postContent}, (err, res) => {
        if(!err) {
            $(".kt-chat__messages").append(`<div class="kt-chat__message kt-chat__message--right">
                                        <div class="kt-chat__user">
                                            <span class="kt-chat__datetime"></span>
                                            <a href="#" class="kt-chat__username">You</span></a>
                                            <span class="kt-media kt-media--circle kt-media--sm"></span>
                                        </div>
                                        <div class="kt-chat__text kt-bg-light-brand">
                                            ${postContent}
                                        </div>
                                    </div>`)
            $("textarea").val("");
        }
        $('.post').prop('disabled', false)
    })
}

// /** Unfriend User */
// function unfriend() {
//     $(document).on('click', '.unfriend', function () {
//         let relationship = $(this).data('relationship');
//         $(this).prop('disabled', true);
//         fireLoading();
//         makeAjaxRequest('users/unfriend','post', {relationship: relationship},(err, res) => {
//             pageReload();
//         })
//     })
// }

/** Sends friends request */
function friend() {
    $(document).on('click', ".friend", function () {
        let user = $(this).data('user');
        let data = {
            user: user,
        }
        fireLoading();
        makeAjaxRequest("users/friend", 'post', data, (err, res) => {
            pageReload();
        })
    })
}

/*** Cancel already sent request  */
function handleSentRequest() {
    $(document).on('click', '.handle-sent-request', function () {
        $(this).prop('disabled', true);
        let relationship = $(this).data('relationship');
        makeAjaxRequest('relationships/cancel', 'post', {relationship: relationship}, (err, res) => {
            pageReload();
        })
    })
}


/** Approve or Reject received notification from the user  */
function handleNotificationStatusChange() {
    $(document).on('click', ".suggestion-action", function () {
        let action = $(this).data("action");
        let relationship = $(this).data('relationship');
        $(this).prop('disabled', true);
        fireLoading();
        makeAjaxRequest('users/notification/respond','post', {relationship: relationship, action: action}, (err, res) => {
            pageReload();
        })
    })
}

function pageReload() {
    window.location.reload();
}

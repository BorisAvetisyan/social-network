$(document).ready(function () {
    handlePostClick();
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

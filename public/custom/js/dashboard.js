$(document).ready(function () {
    initializeSelect2();
    friend();
})


function initializeSelect2() {
    $("#search-people").select2({
        ajax: {
            url: url + '/users/search',
            dataType: 'json',
            delay: 250
        },
        closeOnSelect: false,
        templateResult: template
    })
}


function template(row) {
    if (row.loading) {
        return row.text;
    }

    let container = $(
        "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__avatar'><img src='" + row.image + "' /></div>" +
        "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__title'></div>" +
        "<div class='select2-result-repository__forks'> <button class='friend' data-user="+row.id+">Friend</button> </div>" +
        "</div>" +
        "</div>" +
        "</div>"
    );

    container.find(".select2-result-repository__title").text(row.name + " " + row.surname + `(${row.email})`);

    return container;
}


function friend() {
    $(document).on('click', ".friend", function () {
        let user = $(this).data('user');
        makeAjaxRequest("users/friend", 'post', {user: user}, (err, res) => {
            console.log(res);
        })
    })
}

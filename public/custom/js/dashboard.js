var usersDatatable;

$(document).ready(function () {
    $('#kt_form_status').selectpicker();

    initializeSelect2();
    friend();
    handleSuggestionsAction();
    constructUsersList();
    handleDatatableFiltering();

})

function handleDatatableFiltering() {
    $('#kt_form_status').on('change', function() {
        usersDatatable.API.params = getAPIParams();
        usersDatatable.reload();
    });

    searchEvent('search', usersDatatable, getAPIParams)
}

function constructUsersList() {
    let columns = [
        {
            color: "#000000",
            width: 150,
            field: 'name',
            title: 'Name',
            sortable: false,
            template: function(row) {
                return row.name;
            }
        },
        {
            color: "#000000",
            width: 100,
            field: 'surname',
            title: 'Surname',
            sortable: false,
            template: function(row) {
                return row.surname;
            }
        },
        {
            color: "#000000",
            width: 100,
            field: 'email',
            title: 'Email',
            sortable: false,
            template: function(row) {
                return row.email;
            }
        },
        {
            color: "#000000",
            width: 80,
            field: 'status',
            title: 'Status',
            sortable: false,
            template: function(row) {
                let classname = {"approved": "success", "rejected": "danger", "pending": "info"}
                return `<span class="kt-badge kt-badge--${classname[row.status]} kt-badge--inline kt-badge--pill">${row.status}</span>`;
            }
        },
        {
            color: "#000000",
            width: 100,
            field: 'action',
            title: 'Actions',
            sortable: false,
            template: function(row) {
                if(row.status === 'pending') {
                    // cancel
                    return 'cancel'
                } else if (row.status === 'approved') {
                    // unfriend
                    return 'unfriend'
                } else {
                    // retry
                    // cancel
                    return 'retry/cancel'
                }
            }
        },
    ];
    usersDatatable = initialiseKtDatatable('users-datatable', '/users/data', columns, () => {

    }, {}, getAPIParams());
}

function handleSuggestionsAction() {
    $(".suggestion-action").click(function () {
        let action = $(this).data("action");
        let suggestion = $(this).data('suggestion');

        makeAjaxRequest('users/suggestion/respond','post', {suggestion: suggestion, action: action}, (err, res) => {
            let className = action === 'approved' ? "success" : "danger";
            $(this).closest('.right-status').html(`<span class="kt-badge kt-badge--${className} kt-badge--inline kt-badge--pill">${action}</span>`)
        })
    })
}


/** Select2 library invokation based ajax approach */
function initializeSelect2() {
    $("#search-people").select2({
        ajax: {
            url: url + '/users/search',
            dataType: 'json',
            delay: 250
        },
        minimumInputLength: 2,
        placeholder: "Find People",
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
        "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__title'></div>" +
        "<div class='select2-result-repository__forks'> <button class='friend btn btn-success btn-sm' data-user="+row.id+">Friend</button> </div>" +
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
            if(res.success) {
                usersDatatable.reload();
                $(this).attr('disabled', true);
            }
        })
    })
}


function getAPIParams() {
    return {
        target: $("#search").val(),
        status: $("#kt_form_status").val(),
    }
}

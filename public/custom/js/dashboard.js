var usersDatatable,
    notificationsDatatable;

$(document).ready(function () {
    $('#kt_form_status').selectpicker();

    initializeSelect2();
    friend();
    handleNotificationStatusChange();
    constructUsersList();
    handleDatatableFiltering();
    initializeNotificationsDatatable();
    handleSentRequest();
    unfriend();
})

function handleDatatableFiltering() {
    $('#kt_form_status').on('change', function() {
        usersDatatable.API.params = getAPIParams();
        usersDatatable.reload();
    });

    searchEvent('search', usersDatatable, getAPIParams)
}

function initializeNotificationsDatatable() {
    let columns = getColumns();
    columns.push({
        color: "#000000",
        width: 200,
        field: 'action',
        title: 'Actions',
        sortable: false,
        template: function(row) {
            return `<button class="btn btn-sm btn-clean btn-icon btn-icon-sm suggestion-action" title="Approve" data-action="approved" data-notification="${row.id}" >Approve</button><button data-action="rejected" data-notification="${row.id}" class="btn btn-sm btn-clean btn-icon btn-icon-sm suggestion-action" title="Reject">Reject</button>`
        }
    });
    notificationsDatatable = initialiseKtDatatable('notifications-datatable', '/users/notifications/data', columns, () => {})
}

function constructUsersList() {
    let columns = getColumns();
    columns.push({
        color: "#000000",
        width: 100,
        field: 'action',
        title: 'Actions',
        sortable: false,
        template: function(row) {
            if(row.status === 'pending') {
                return `<button class="btn btn-default handle-sent-request" data-status="cancel" data-relationship="${row.id}">Cancel</button>`
            } else if (row.status === 'approved') {
                return `<button class="btn btn-default unfriend" data-relationship="${row.id}">Unfriend</button>`
            } else {
                return 'retry/cancel'
            }
        }
    });
    usersDatatable = initialiseKtDatatable('users-datatable', '/users/data', columns, () => {}, {}, getAPIParams());
}

function handleSentRequest() {
    $(document).on('click', '.handle-sent-request', function () {
        let relationship = $(this).data('relationship');
        let action = $(this).data('action');
        makeAjaxRequest('relationships/cancel', 'post', {relationship: relationship, action: action}, (err, res) => {
            usersDatatable.reload();
        })
    })
}

function handleNotificationStatusChange() {
    $(document).on('click', ".suggestion-action", function () {
        let action = $(this).data("action");
        let notification = $(this).data('notification');

        makeAjaxRequest('users/notification/respond','post', {notification: notification, action: action}, (err, res) => {
            console.log(res);
            notificationsDatatable.reload();
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

function unfriend() {
    $(document).on('click', '.unfriend', function () {
        let relationship = $(this).data('relationship');
        console.log("unfriend")
        makeAjaxRequest('users/unfriend','post', {relationship: relationship},(err, res) => {
            usersDatatable.reload();
        })
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
        "<div class='select2-result-repository__forks'></div>" +
        "</div>" +
        "</div>" +
        "</div>"
    );

    let html = "<button class='friend btn btn-success btn-sm' data-user="+row.id+">Friend</button>";
    if(row.status === 'pending') {
        html = `<button class='btn btn-info btn-sm' disabled="disabled">Pending</button>`;
    }
    if(row.status === 'rejected') {
        html = "<button class='friend btn btn-danger btn-sm' data-status='pending' data-user="+row.id+">Rejected/Resend</button>";
    }
    container.find(".select2-result-repository__title").text(row.name + " " + row.surname + `(${row.email})`);
    container.find(".select2-result-repository__forks").html(html);
    return container;
}


function friend() {
    $(document).on('click', ".friend", function () {
        let user = $(this).data('user');
        let status = $(this).data('status');
        let data = {
            user: user,
            status: status
        }
        makeAjaxRequest("users/friend", 'post', data, (err, res) => {
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

function getColumns() {
    return [
        {
            color: "#000000",
            width: 100,
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
            width: 70,
            field: 'status',
            title: 'Status',
            sortable: false,
            template: function(row) {
                let classname = {"approved": "success", "rejected": "danger", "pending": "info"}
                return `<span class="kt-badge kt-badge--${classname[row.status]} kt-badge--inline kt-badge--pill">${row.status}</span>`;
            }
        }
    ];
}

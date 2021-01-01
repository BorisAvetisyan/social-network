/** Executes ajax request and returns callback function */
function makeAjaxRequest(endpoint, method, data, callback, additionalOptions = {}) {
    let settings = {
        method: method,
        url: url + '/' + endpoint,
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (res) {
            let result;
            try {
                result = JSON.parse(res)
            } catch (e) {
                result = res;
            }
            callback(null, result);
        },
        error: function (err) {
            callback(err)
        }
    };
    if (!$.isEmptyObject(additionalOptions)) {
        settings = {...settings, ...additionalOptions};
    }
    $.ajax(settings);
}

function initialiseKtDatatable(elementId, url, columns, callback, additionalOptions = {}, additionalData = {}, map = null, pageSize = 50, params= {}) {
    let dataTableOptions = {
        data: {
            type: 'remote',
            source: {
                read: {
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    params: params
                }
            },
            pageSize: pageSize,
            serverPaging: true,
            serverFiltering: false,
            serverSorting: true,
            saveState: {
                webstorage: false
            },
        },

        // layout definition
        layout: {
            footer: false,
            spinner: {
                type: 'loader',
                message: true
            }
        },
        // column sorting
        sortable: true,
        pagination: true,
        columns: columns,
    };

    if (map) {
        dataTableOptions.data.source.read.map = map;
    }

    if (!$.isEmptyObject(additionalOptions)) {
        dataTableOptions = {...dataTableOptions, ...additionalOptions};
    }
    if (!$.isEmptyObject(additionalData)) {
        dataTableOptions.data.source.read.params = {...dataTableOptions.data.source.read.params, ...additionalData}
    }
    let datatable = $(`#${elementId}`).KTDatatable(dataTableOptions);

    datatable.on('kt-datatable--on-init', function (event, options) {
        if (callback) {
            callback(event);
        }
    });

    datatable.on('kt-datatable--on-layout-updated', function (event, options) {
        // unBlock('#' + elementId);
        if (callback) {
            callback(event);
        }
    });

    datatable.on('kt-datatable--on-ajax-fail', function (event, jqXHR) {
        // unBlock('#' + elementId);
    });
    return datatable;
}


/**
 * Search event: trigger when element with id elementId input changes and updates corresponding datatable
 * @param elementId
 * @param datatable
 * @param getDataFunction
 */
function searchEvent(elementId, datatable, getDataFunction) {
    $(`#${elementId}`).bind("input propertychange", function (evt) {
        if (window.event && event.type == "propertychange" && event.propertyName != "value")
            return;
        window.clearTimeout($(this).data("timeout"));
        $(this).data("timeout", setTimeout(function () {
            datatable.API.params = getDataFunction();
            datatable.reload();
        }, 300));
    });
}

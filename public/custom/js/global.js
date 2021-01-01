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

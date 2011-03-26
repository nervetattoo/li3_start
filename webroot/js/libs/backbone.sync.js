/* 
 * Override the `Backbone.sync` method as it is
 * completely REST based whereas Lithium by defaults doesnt respond
 * to rest routes
 *
 * We require some special new policies from Backbone models:
 *
 * `Model.url` is no longer optional whether it is a function or not,
 *     must be function and must exist. Also it will take one argument;
 *     the method pased to `Backbone.sync` (create,update,delete,read)
 *
 * The server emulation part is also removed as Lithium users are unlikely to
 * need it.
 */
Backbone.sync = function(method, model, success, error)
{
    var methodMap = {
        'create': 'POST',
        'update': 'PUT',
        'delete': 'DELETE',
        'read'  : 'GET'
    };
    var type = methodMap[method];
    var modelJSON = (method === 'create' || method === 'update') ?
        JSON.stringify(model.toJSON()) : null;

    // Default JSON-request options.
    var params = {
        url:          model.url(method),
        type:         type,
        contentType:  'application/json',
        data:         modelJSON,
        dataType:     'json',
        processData:  false,
        success:      function(data, textStatus, request) {
            if (data.errors)
                error(data, textStatus, request);
            else
                success(data, textStatus, request);
        },
        error:        error
    };
    $.ajax(params);
};

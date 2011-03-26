/**
 * Main App controller.
 * Controlls routing and delegating to the real views
 */
AppController = Backbone.Controller.extend({

    el : $("#container"),

    initialize : function(options) {
        _.bindAll(this, "home");

        /**
         * When a user enters without a hash in url (/)
         * pass over to #send. This kickstarts the send view
         */
        var hash = window.location.hash;
        if (hash == "" || hash == "#")
            window.location.hash = "home";
    },

    routes : {
        "home" : "home"
    },

    /**
     * Render the default start page of app
     * You most likely want to utilize a `Backbone.View` for all routes
     */
    home : function() {
    }
});

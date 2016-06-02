portalApp.directive("editable", function() {
    return {
        scope: {}, // create isolated scope, so as not to touch the parent
        link: function(scope, elem, attrs) {
            console.log(elem);
            $(elem).find(".edit-link").addClass('editing');
        }
    };
});
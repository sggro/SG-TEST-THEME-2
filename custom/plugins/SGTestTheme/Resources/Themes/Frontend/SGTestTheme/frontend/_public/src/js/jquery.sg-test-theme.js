(function($, window) {

    /*console.log(window.StateManager.getCurrentState());*/

    window.StateManager
        .addPlugin('*[data-offcanvas="true"]', 'swOffcanvasMenu', ['m'])
        .addPlugin('*[data-sg-search-offcanvas="true"]', 'swOffcanvasMenu', ['m','l','xl'])
        .addPlugin('*[data-subcategory-nav="true"]', 'swSubCategoryNav', ['m'])
        .removePlugin('*[data-collapse-cart="true"]', 'swCollapseCart', ['xs', 's'])
        .addPlugin('*[data-collapse-cart="true"]', 'swCollapseCart', ['m','l','xl']);

    if(window.StateManager.isCurrentState('l')){
        $('.sidebar-main.off-canvas').removeClass('off-canvas');
        /*window.StateManager.destroyPlugin('*[data-offcanvas="true"]', 'swOffcanvasMenu')*/
    }

})(jQuery, window);
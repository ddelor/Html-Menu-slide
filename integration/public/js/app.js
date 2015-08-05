jQuery( document ).ready(function( $ ) {

    var App = {

        events: function() {

            // Menu
            var menuBtn = $('header .toggle-menu');
            var menu = $('nav.menu');
            var globalContent = $('.global-content');

            menuBtn.on('click', function(e) {
                e.preventDefault();
                $(this).toggleClass('open');
                menu.toggleClass('open');
                globalContent.toggleClass('out');
            });

            $(document).on('click', 'footer, section', function() {
                if (menu.hasClass('open')) {
                    menuBtn.removeClass('open');
                    menu.removeClass('open');
                    globalContent.removeClass('out');
                }
            });
        },

        init: function() {
            this.events();
        }
    };

    App.init();
});

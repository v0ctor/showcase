/**
 * Main script.
 */

$(function () {

    /** Scroll animation **/
    $('#scroll').click(function () {
        $('html, body').animate({
            scrollTop: $('header').outerHeight(true)
        });
    });

    /** Cookie consent **/
    window.cookieconsent.initialise({
        palette: {
            popup: {
                background: '#edeff5',
                text: '#838391',
            },
            button: {
                background: '#304860',
                text: '#ffffff',
            }
        },
        theme: 'classic',
        position: 'bottom-right',
        content: {
            message: Lang.get('cookies.message'),
            dismiss: Lang.get('cookies.dismiss'),
            link: Lang.get('cookies.link'),
            href: '/cookies',
        },
        elements: {
            messagelink: '<span id="cookieconsent:desc" class="cc-message">{{message}}</span>',
        }
    });

});

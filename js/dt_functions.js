/**
 * Using a simple module pattern for the JS, since it provides encapsulation
 * and we won't be unit testing the private methods.
 *
 * @package datag
 * @since v0.2
 */

var DatTag =(function($) {

    var $window = $(window);

    /**
     * Constructor will call the methods from the class. Typically, I'll add event listeners in here too,
     * but they're not necessary for this plugin.
     */
    var init = function () {

        tag_append();
        drag_and_drop();

    };

    /**
     * Append our draggable selector to the tag box
     */
    var tag_append = function(){

        var $tags_mb = document.getElementById( 'tagsdiv-post_tag' );

        $($tags_mb).find('.inside').append(
          '<div id="datag">' +
          '<span class="drag"></span>' +
          '<p class="howto">Drag this color droplet onto the <strong>highlighted tag</strong> you wish to select.</p>' +
          '</div>'
        );

    };

    /**
     * Specifies the behavior of droppable for the tag highlighter and the tag elements
     */
    var drag_and_drop = function(){

        var drop        = document.getElementsByClassName('drop'),
            drag        = document.getElementsByClassName('drag'),
            tagsParent  = document.getElementsByClassName('tagchecklist'),
            hiddenInput = document.getElementById('highlight-tag'),
            $drop       = $(drop),
            $drag       = $(drag),
            $tagsParent = $(tagsParent),
            $tags       = $tagsParent.find('span'),
            $hiddenInput= $(hiddenInput),
            HTML;

        /** Bail if draggable is not present */
        if( ! $drag.length > 0 )
            return;

        /** Add existing tags to droppable targets */
        $tags.each( function() {
            $(this).droppable({
                greedy: true,
                drop: function (e, ui) { // Where the magic happens
                    $(this).siblings().removeClass('highlight');
                    $(this).addClass('highlight');
                    HTML = $(this).text().substring(2); // Since the tag is rendered with the X for the close button, we substring it
                    $hiddenInput.val(HTML); // Set our hidden field to the value
                },
                tolerance: "intersect"
            });

            /** This is necessary to ensure that the proper tag is highlighted when the page is initially loaded. */
            if( $hiddenInput.val() === $(this).text().substring(2) )
                $(this).addClass('highlight');

        });

        /** Since tags are added dynamically, we need to listen for it */
        $tagsParent.on( 'DOMNodeInserted', function(e){

            $(e.target).droppable({
                greedy: true,
                drop: function(e, ui){
                    $(this).siblings().removeClass('highlight');
                    $(this).addClass('highlight');
                    var HTML = $(this).text().substring(2);
                    $hiddenInput.val(HTML);
                },
                tolerance: "intersect"
            }).each( function(){
                if( $hiddenInput.val() === $(this).text().substring(2) )
                    $(this).addClass('highlight');
            });

        });

        $drag.draggable({
            revert: true,
            revertDuration: 100,
            scroll: false,
            stack: '.drop'
        });

        /** Clear the highlighted tag field if that tag is removed */
        $tags.find('a.ntdelbutton').click( function(e){

            e.preventDefault();

            if( $(this).parent().text().substring(2) === $hiddenInput.val() )
                $hiddenInput.val('');

        });

    };

    /**
     * Public API
     */
    return {
        init: init
    }

})(jQuery);

jQuery(document).ready(function () {
    DatTag.init();
});
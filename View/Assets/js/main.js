
function fitRows( $container, options ) {

    var cols = options.numColumns,
        $els = $container.children(),
        maxH = 0, j;

    $els.each(function( i, p ) {

        var $p = $( p ), h;

        $p.css( 'min-height', '' );

        maxH = Math.max( $p.outerHeight( true ), maxH );
        if ( i % cols == cols - 1 || i == cols - 1 ) {
            for ( j=cols;j;j--) {
                $p.css( 'min-height', maxH );
                $p = $p.prev();
            }
            maxH = 0;
        }

    });
}

$(function() {

    var opts = {
        numColumns: 3
    };

    fitRows( $( '.tiles' ), opts );

});
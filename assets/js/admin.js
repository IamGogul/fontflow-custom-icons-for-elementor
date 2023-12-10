var $         = jQuery.noConflict();
var FCIFE_OBJ = FCIFE_OBJ || {};

(function($){
    FCIFE_OBJ.saveFontIcons = {
        init: function() {
            var $actions = $("a.fontflow-ajax");
            var $loader  = '<span class="fontflow-btn-dot-loader">' +
                '<span class="fontflow-dot fontflow-dot-1"></span>' +
                '<span class="fontflow-dot fontflow-dot-2"></span>' +
                '<span class="fontflow-dot fontflow-dot-3"></span>' +
            '</span>';

            if( $actions.length > 0 ) {
                $actions.on("click",function(e){
                    e.preventDefault();
                    var $this     = $(this);
                    var $formData = [];

                    $formData.push(
                        { name:'action', value: 'fontflow-action/plugin/settings/update' },
                        { name:'key', value: $this.data("db") },
                    );

                    $.ajax({
                        type      : 'POST',
                        dataType  : 'json',
                        url       : FCIFE_OBJ.ajax,
                        data      : $formData,
                        beforeSend: function(){
                            $this.html( $loader );
                        },
                        success   : function ( $res ) {
                            setTimeout(function(){ $this.html( $res.data.btn ) }, 1000);
                        }
                    });
                });
            }
        }
    };

    FCIFE_OBJ.documentOnReady = {
        init: function() {
            FCIFE_OBJ.saveFontIcons.init();
        }
    };

    $(document).ready( FCIFE_OBJ.documentOnReady.init );
})(jQuery);
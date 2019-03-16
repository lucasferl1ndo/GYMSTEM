jQuery(function($){
    $(document).ready( function() {
        $('.upload-custom-img').on( 'click', function(event) {
            event.preventDefault();
            var frame = new wp.media.view.MediaFrame.Select({
                title: 'Selecione a imagem',
                multiple: true,
                button: {
                    text: 'Selecionar'
                }
            });
            frame.on( 'select', () => {
                var _class = $(this).data('class');
                var _input = $(this).data('input');
                var _add = this;
                var _rm = $(this).data('rm');
                var attachment = frame.state().get('selection').first().toJSON();

                $(_class).append('<img src="'+attachment.url+'" alt="" style="max-height:50px;"/>');
                $(_input).val( attachment.id );
                $(_add).addClass( 'hidden' );
                $(_rm).removeClass( 'hidden' );
            } );
            frame.open();
        });

        $('.delete-custom-img').on('click', function (event) {
            event.preventDefault();
            var _class = $(this).data('class');
            var _input = $(this).data('input');
            var _add = $(this).data('add');
            var _rm = this;

            $(_class).html( '' );
            $(_input).val( '' );
            $(_add).removeClass( 'hidden' );
            $(_rm).addClass( 'hidden' );
        });
    });
});
jQuery(function($){
    $('.add-video').on( 'click', function() {
        // Accepts an optional object hash to override default values.
        var frame = new wp.media.view.MediaFrame.Select({
            title: 'Selecione o Vídeo',
            multiple: false,
            library: {
                orderby: 'title',
                type: 'video/mp4'
            },

            button: {
                text: 'Selecionar'
            }
        });
        frame.on( 'select', function() {
            var selectionCollection = frame.state().get('selection').first().toJSON();
            $('.video').empty().append($(`<video controls><source src="${selectionCollection.url}" type="video/mp4"></video>`))
            $('.video-id').val(selectionCollection.id);
            $('.add-video').addClass('hidden');
            $('.rem-video').removeClass('hidden');
        } );
        frame.open();
    });

    $('.rem-video').on('click', function(){
        $('.video').empty();
        $('.video-id').val('');
        $('.add-video').removeClass('hidden');
        $('.rem-video').addClass('hidden');
    });
});

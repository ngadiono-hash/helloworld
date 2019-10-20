
CKEDITOR.plugins.add( 'imageuploader', {
    init: function( editor ) {
        editor.config.filebrowserBrowseUrl = ''+ host +'assets/js/ckeditor/plugins/imageuploader/imgbrowser.php';
    }
});

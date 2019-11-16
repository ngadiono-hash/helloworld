
CKEDITOR.plugins.add( 'imageuploader', {
    init: function( editor ) {
        // editor.config.filebrowserBrowseUrl = ''+ host +'assets/js/ckeditor/plugins/imageuploader/imgbrowser.php';
        editor.config.filebrowserBrowseUrl = 'http://localhost/helloworld/assets/js/ckeditor/plugins/imageuploader/imgbrowser.php';
    }
});

<script src="{{ asset('vendor/flatfilecmsgui/ckeditor.js') }}"></script>

<textarea name="{{$name}}" id="editor" rows="10">{{$value}}</textarea>

<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
            console.log( editor );
        } )
        .catch( error => {
            console.error( error );
        } );
</script>
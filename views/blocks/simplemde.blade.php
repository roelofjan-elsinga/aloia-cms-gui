<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>

<textarea name="{{$name}}" id="editor">{{$value}}</textarea>


<script>
    var simplemde = new SimpleMDE({ element: document.getElementById("editor") });
</script>
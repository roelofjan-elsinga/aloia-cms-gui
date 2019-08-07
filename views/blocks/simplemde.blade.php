<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/inscrybmde@1.11.6/dist/inscrybmde.min.css">
<script src="https://cdn.jsdelivr.net/npm/inscrybmde@1.11.6/dist/inscrybmde.min.js"></script>

<textarea name="{{$name}}" id="editor">{{$value}}</textarea>


<script>
    var simplemde = new InscrybMDE({ element: document.getElementById("editor") });
</script>
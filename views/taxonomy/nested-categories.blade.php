@foreach($taxonomies as $taxonomy)

    <option value="{{$taxonomy->name()}}" {{$taxonomy->name() === $selected ? 'selected' : ''}}>
        {{$taxonomy->name()}} (/{{$taxonomy->fullUrl()}})
    </option>

@endforeach
@foreach($taxonomies as $taxonomy)

    <option value="{{$taxonomy['category_name']}}" {{$taxonomy['category_name'] === $selected ? 'selected' : ''}}>
        {{$taxonomy['category_name']}} (/{{$taxonomy['category_url_prefix']}})
    </option>

    @if(count($taxonomy['children']) > 0)

        <optgroup label="{{$taxonomy['category_name']}}">

            @include('flatfilecmsgui::taxonomy.nested-categories', ['taxonomies' => $taxonomy['children']])

        </optgroup>

    @endif

@endforeach
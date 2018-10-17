        '{{$modelLangFormatPlural}}'  => [
        @foreach($columns as $col)
            '{{ $col['name'] }}' => "{{ $col['title'] }}",
        @endforeach
        ],
// Do not delete me :) I'm used for auto-generation
<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            @foreach ($columns as $item)
                <th>{{'{{'}} __('labels.backend.{{$tableName}}.table.{{$item['name']}}') }}</th>
            @endforeach
                @foreach ($relations['belongsToMany'] as $item)
                    @if($item['weakness'])
                    <th>{{'{{'}} __('{{$item['related_model_name_plural']}}') }}</th>
                    @endif
                @endforeach
            <th>{{'{{'}} __('labels.general.actions') }}</th>
        </tr>
        </thead>
        <tbody>
        {{'@'}}{{'foreach'}} (${{$tableName}} as ${{ $modelDotNotation}})

        <tr>
            @foreach ($columns as $item)
                @if(isset($item['foreign']))
                    <td>{{"{"}}!! ${{$modelDotNotation}}->{{$item['foreign']['lowerModelName']}}->{{$item['foreign']['field_view']}} !!}</td>
                @elseif(isset($item['dbtype'])&&$item['dbtype']=="enum")
                    {{"@"}}{{"php"}}   ${{$item['name']}}_arr=[@foreach ($item['selected_data'] as $key=> $el) '{{$key}}'=>'{{$el}}', @endforeach];    {{"@"}}{{"endphp"}}
                    <td>{{'{{'}} ${{$item['name']}}_arr [${{ $modelDotNotation}}->{{$item['name']}} ]}}</td>
                @else
                <td>{{'{{'}}  ${{ $modelDotNotation}}->{{$item['name']}} }}</td>
                @endif
            @endforeach
                @foreach ($relations['belongsToMany'] as $item1)
                    @if($item1['weakness'])
                        <td>{{"@"}}{{"foreach"}} (${{$item1['related_table']}}[${{$modelVariableName}}->id] as $item){{"{{"}}$item['{{$item1['field_view']}}']}}      {{"@"}}{{"endforeach"}}</td>
                    @endif
                @endforeach
            <td>{{'{'}}!! ${{ $modelDotNotation}}->action_buttons !!}</td>
        </tr>

        {{'@'}}{{'endforeach'}}
        </tbody>
    </table>
</div>

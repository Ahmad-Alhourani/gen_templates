<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">

            @foreach ($columns as $item)
            <tr>
                <th>{{'{{'}} __('labels.backend.{{$tableName}}.content.{{$item['name']}}') }}</th>
                <td>{{'{{'}} ${{$modelDotNotation}}->{{$item['name']}} }}</td>
            </tr>
            @endforeach



        </table>
    </div>
</div><!--table-responsive-->
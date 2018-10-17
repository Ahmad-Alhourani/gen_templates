@php echo "<?php"
@endphp namespace App\Http\Requests\Backend\{{ $modelWithNamespaceFromDefault }};
@php
    if($translatable) {
        $translatableColumns = $columns->filter(function($column) use ($translatable) {
            return in_array($column['name'], $translatable->toArray());
        });
        $standardColumn = $columns->reject(function($column) use ($translatable) {
            return in_array($column['name'], $translatable->toArray());
        });
    }
@endphp

@if($translatable)use XLabTechs\Translatable\TranslatableFormRequest;
@else
use Illuminate\Foundation\Http\FormRequest;
@endif
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

@if($translatable)class Update{{ $modelBaseName }} extends TranslatableFormRequest
@else
class Update{{ $modelBaseName }} extends FormRequest
@endif
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
      return true;
     //   return Gate::allows('admin.{{ $modelDotNotation }}.edit', $this->{{ $modelVariableName }});
    }

@if($translatable)/**
     * Get the validation rules that apply to the requests untranslatable fields.
     *
     * @return  array
     */
    public function untranslatableRules() {
        return [
            @foreach($standardColumn as $column)'{{ $column['name'] }}' => [{!! implode(', ', (array) $column['serverUpdateRules']) !!}],
            @endforeach
@if (count($relations))
    @if (isset($relations['belongsToMany'])&&count($relations['belongsToMany']))

            @foreach($relations['belongsToMany'] as $belongsToMany)'{{ $belongsToMany['related_table'] }}' => [{!! implode(', ', ['\'sometimes\'', '\'array\'']) !!}],
            @endforeach
    @endif
@endif

        ];
    }

    /**
     * Get the validation rules that apply to the requests translatable fields.
     *
     * @return  array
     */
    public function translatableRules($locale) {
        return [
            @foreach($translatableColumns as $column)'{{ $column['name'] }}' => [{!! implode(', ', (array) $column['serverUpdateRules']) !!}],
            @endforeach

        ];
    }
@else/**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            @foreach($columns as $column)//'{{ $column['name'] }}' => [{!! implode(', ', (array) $column['serverUpdateRules']) !!}],
            @endforeach
@if (count($relations))
    @if (isset($relations['belongsToMany'])&&count($relations['belongsToMany']))

            @foreach($relations['belongsToMany'] as $belongsToMany)//'{{ $belongsToMany['related_table'] }}' => [{!! implode(', ', ['\'sometimes\'', '\'array\'']) !!}],
            @endforeach
    @endif
@endif

        ];
    }
@endif
}

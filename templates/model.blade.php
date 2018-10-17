    @php echo "<?php "

    @endphp namespace {{ $modelNameSpace }};
    @php

     $hasRoles = false;
    @endphp

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Traits\Attribute\{{ $modelBaseName }}Attribute;
    use App\Models\Auth\User;
    use Illuminate\Support\Collection;
    use Sofa\Eloquence\Eloquence;
    use Sofa\Eloquence\Metable;
    @if(count($sluggable))use Spatie\Sluggable\HasSlug;
    use Spatie\Sluggable\SlugOptions;
    @endif
    @if($hasSoftDelete)use Illuminate\Database\Eloquent\SoftDeletes;
    @endif
    @if($hasRoles)
        use Spatie\Permission\Traits\HasRoles;
    @endif
    @if($translatable)
        use XLabTechs\Translatable\Traits\HasTranslations;
    @endif

    class {{ $modelBaseName }} extends Model
    {
            use
    {{ $modelBaseName }}Attribute ,Eloquence, Metable @if($hasSoftDelete),SoftDeletes @endif @if($hasRoles),HasRoles @endif @if($translatable), HasTranslations @endif @if(count($sluggable)),HasSlug @endif;

            @if(count($sluggable))
                /**
                * Get the options for generating the slug.
                */

                public function getSlugOptions() : SlugOptions
                {
                return SlugOptions::create()
                ->generateSlugsFrom('{{$sluggable[0]}}')
                ->saveSlugsTo('{{$sluggable[1]}}');
                }
            @endif


            /**
            * The attributes that are mass assignable.
            *
            * @var array
            */

            @if ($fillable)protected $fillable = [
            @foreach($fillable as $f)
                "{{ $f }}",

            @endforeach
            ];
            @endif

            @if ($hidden)protected $hidden = [
            @foreach($hidden as $h)
                "{{ $h }}",
            @endforeach
            ];
            @endif

            @if ($dates)protected $dates = [
            @foreach($dates as $date)
                "{{ $date }}",
            @endforeach
            ];
            @endif

            @if ($translatable)// these attributes are translatable
            public $translatable = [
            @foreach($translatable as $translatableField)
                "{{ $translatableField }}",
            @endforeach
            ];
            @endif

            @if (!$timestamps)public $timestamps = false;
            @endif
            /**
            * Get the key name for route model binding.
            *
            * @return string
            */
            public function getRouteKeyName()
            {
            return 'id';
            }

            @if (count($relations))/* ************************ RELATIONS ************************ */

            @if (isset($relations['hasMany'])&&count($relations['hasMany']))
                @foreach($relations['hasMany'] as $hasMany)/**
                * Get all the {{ $hasMany['related_table'] }} for the {{$modelBaseName}}.
                * @return \Illuminate\Database\Eloquent\Relations\HasMany
                */
                public function {{ $hasMany['related_table'] }}() {
                return $this->hasMany({{ $hasMany['related_model_name'] }}::class)->latest();
                }

                @endforeach
            @endif

            @if (isset($relations['belongsToMany'])&&count($relations['belongsToMany']))
                @foreach($relations['belongsToMany'] as $belongsToMany)/**
                * Get all the {{ $belongsToMany['related_table'] }} that belong to the {{$modelBaseName}}.
                * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
                */
                public function {{ $belongsToMany['related_table'] }}() {
                return $this->belongsToMany({{ $belongsToMany['related_model_name'] }}::class);
                }

                @endforeach
            @endif

            @if (isset($relations['belongsTo'])&&count($relations['belongsTo']))
                @foreach($relations['belongsTo'] as $belongsTo)/**
                * Get  the {{ $belongsTo['related_model_name'] }} that owns the {{$modelBaseName}}.
                * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
                */
                public function {{ $belongsTo['related_class'] }}() {
                return $this->belongsTo({{ $belongsTo['related_model_name'] }}::class);
                }
                @endforeach
            @endif
            @endif

    @if (count($foreign))
        @foreach($foreign as $item)/**
        * Get  the {{ $item['modelName'] }} that owns the {{$modelBaseName}}.
        * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
        */
        public function {{ $item['lowerModelName'] }}() {
        return $this->belongsTo({{ $item['modelName'] }} ::class);
        }
        @endforeach
    @endif

    }

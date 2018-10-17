    @php echo "<?php "
    @endphp namespace {{ $RepositoryNameSpace }};

    use App\Models\{{$RepositoryBaseName}};
    use App\Repositories\BaseRepository;
    use Prettus\Repository\Contracts\CacheableInterface;
    use Prettus\Repository\Traits\CacheableRepository;

    class {{ $RepositoryBaseName }}Repository  extends BaseRepository implements CacheableInterface
    {
            use CacheableRepository;

            protected  $defaultOrderBy ='id';
            protected  $defaultSortBy = 'asc';

            @if ($searchable)protected $fieldSearchable  = [
            @foreach($searchable as $s)
                "{{ $s }}",
            @endforeach
            ];
            @endif

            /**
            * Configure the Model
            **/
            public function model()
            {
            return {{$RepositoryBaseName}}::class;
            }

    public function getPaginated($paged = 25,$condions_array=null)
    {
        if($condions_array)
        {
            return $this->model
            ->where($condions_array)
            ->paginate($paged);
        }
        return $this->model
        ->paginate($paged);
    }

    }

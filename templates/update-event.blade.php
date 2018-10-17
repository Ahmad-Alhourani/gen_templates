    @php echo "<?php"
    @endphp namespace App\Events\Backend\{{ $modelWithNamespaceFromDefault }};

    use Illuminate\Queue\SerializesModels;
    /**
    * Class {{$modelWithNamespaceFromDefault}}Updated.
    */
    class {{ $modelBaseName }}Updated
    {
            use SerializesModels;
            /**
            * @var
            */

            public ${{$modelDotNotation}} ;

            /**
            * @param ${{$modelDotNotation}}
            */

            public function __construct(${{$modelDotNotation}})
            {
            $this->{{$modelDotNotation}} = ${{$modelDotNotation}};
            }
    }


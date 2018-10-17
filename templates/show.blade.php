{{'@'}}extends ('backend.layouts.app')

{{'@'}}section ('title', __('labels.backend.{{$tableName}}.management') . ' | ' . __('labels.backend.{{$tableName}}.view'))

{{'@'}}section('breadcrumb-links')
{{'@'}}include('backend.{{$tableName}}.includes.breadcrumb-links')
{{'@'}}endsection


{{'@'}}section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{'{{'}} __('labels.backend.{{$tableName}}.management') }}
                        <small class="text-muted">{{'{{'}} __('labels.backend.{{$tableName}}.view') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4 mb-4">
                <div class="col">
                    {{'@'}}include('backend.{{$tableName}}.show_fields')
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <small class="float-right text-muted">
                        <strong>{{'{{'}} __('labels.backend.{{$tableName}}.content.created_at') }}:</strong> {{'{{'}} ${{$modelDotNotation}}->updated_at->timezone(get_user_timezone()) }} ({{'{{'}} ${{$modelDotNotation}}->created_at->diffForHumans() }}),
                        <strong>{{'{{'}}__('labels.backend.{{$tableName}}.content.last_updated') }}:</strong> {{'{{'}} ${{$modelDotNotation}}->created_at->timezone(get_user_timezone()) }} ({{'{{'}}${{$modelDotNotation}}->updated_at->diffForHumans() }})
                        {{'@'}}{{'if'}} (${{$modelDotNotation}}->trashed())
                            <strong>{{'{{'}} __('labels.backend.{{$tableName}}.content.deleted_at') }}:</strong> ${{ $modelDotNotation}}->deleted_at->timezone(get_user_timezone())  (${{ $modelDotNotation}}->deleted_at->diffForHumans() )
                        {{'@'}}{{'endif'}}
                    </small>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{'@'}}endsection

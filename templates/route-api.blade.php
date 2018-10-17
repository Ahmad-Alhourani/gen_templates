@if(isset($full_routing)&&$full_routing)
Route::resource('{{$modelDotNotation}}', 'API\{{$modelBaseName}}APIController');
@else
    Route::get('/{{$modelDotNotation}}',                              'Backend\\{{$modelBaseName}}Controller@index');
     Route::get('/{{$modelDotNotation}}/{id}',                   'API\{{$modelBaseName}}APIControlle@{{"show"}}')->name('api/{{$modelDotNotation}}/show');
@endif

//*****Do Not Delete Me
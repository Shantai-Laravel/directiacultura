<?php

$prefix = session('applocale');
$lang = App\Models\Lang::where('default', 1)->first();

Route::get('/', 'PagesController@index')->name('home');

Route::get('/sitemap.xml', 'SitemapController@xml')->name('sitemap.xml');

Route::group(['prefix' => $prefix], function() {

    Route::get('/404', 'PagesController@get404')->name('404');

    Route::get('/sitemap', 'SitemapController@html')->name('sitemap.html');

    Route::post('/search/autocomplete', 'SearchController@search');

    Route::get('/', 'PagesController@index')->name('home');

    Route::get('contacts', 'FeedBackController@index');
    Route::post('contacts', 'FeedBackController@feedBack');

    Route::get('/events', 'BlogController@getEvents');
    Route::get('/events/{slug}', 'BlogController@getEventsBySlug');
    Route::post('/events/addMorePosts', 'BlogController@addMorePosts');
    Route::get('/institutions', 'BlogController@getInstitutions');
    Route::get('/institutions/{slug}', 'BlogController@getInstitutionBySlug');

    Route::get('/{pages}', 'PagesController@getPages')->name('pages');
});

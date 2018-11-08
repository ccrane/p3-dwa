<?php

Route::get('/', 'ForeignExchangeController@index');

Route::post('/convert', 'ForeignExchangeController@convert');

Route::fallback('ForeignExchangeController@index');

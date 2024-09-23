<?php
use LP\Calculator\CalculatorController;


Route::get('add/{a}/{b}',[CalculatorController::class, 'add']);
Route::get('substract/{a}/{b}',[CalculatorController::class, 'substract']);
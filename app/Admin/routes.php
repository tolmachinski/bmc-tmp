<?php

use Illuminate\Routing\Router;
// use App\Admin\Controllers\MainPageBlockController;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {
    $router->get('/', 'HomeController@index');
    $router->resource('/property-types', PropertyTypeController::class);
    $router->resource('/loan-programs', LoanProgramController::class);
    $router->resource('/sections', SectionController::class);
    $router->resource('/transactions', TransactionController::class);
    $router->resource('/management', ManagementController::class);
    $router->resource('/testimonial', TestimonialController::class);
    $router->resource('/presses', PressController::class);
    $router->resource('/contact-us', ContactUsController::class);
    $router->resource('/main-page', MainPageBlockController::class);
    $router->resource('/jobs', JobsController::class);
    $router->resource('/career', CareerController::class);
});

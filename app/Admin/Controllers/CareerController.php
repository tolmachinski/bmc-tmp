<?php

namespace App\Admin\Controllers;

use App\Career;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Support\Str;

class CareerController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Jobs');
            $content->description('Jobs');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('Jobs');
            $content->description('Jobs');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('Jobs');
            $content->description('Jobs');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Career::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->title('Title')->sortable();
            $grid->location('Location')->sortable();
            $grid->salary('Salary')->sortable();
            $grid->description('Description')->sortable()->display(function($text) {
                return Str::limit(strip_tags($text), 400, '...');
            });
            $grid->responsibilities('Responsibilities')->sortable()->display(function($text) {
                return Str::limit(strip_tags($text), 400, '...');
            });
            $grid->is_visible('Visible')->sortable()->display(function($value){
                return $value ? 'Yes' : 'No';
            });
            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Career::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('title', 'Title')->rules('required|string|min:3|max:200');;
            $form->text('location', 'Location')->rules('required|string|min:3|max:200');;
            $form->text('salary', 'Salary')->rules('required|min:1|max:200');
            $form->ceditor('description', 'Description')->rules('required|string|min:3|max:6300');
            $form->ceditor('responsibilities', 'Responsibilities')->rules('required|string|min:3|max:6300');
            $form->radio('is_visible', 'Visible')->options([0 => 'Not visible', 1 => 'Visible'])->default(1);
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}

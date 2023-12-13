<?php

namespace App\Admin\Controllers;

use App\Job;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class JobsController extends Controller
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
            $content->header('Press');

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

            $content->header('Press');

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
        return Admin::grid(Job::class, function (Grid $grid) {
            $grid->id('ID')->sortable();
            $grid->title('Title')->sortable();
            $grid->location('Location')->sortable();
            $grid->time('Time')->sortable();
            $grid->salary('Salary')->sortable();
            $grid->created_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Job::class, function (Form $form) {
            $form->display('id', 'ID');
            $form->text('title', 'Title')->placeholder('Job title')->rules('max:100');
            $form->text('location', 'Location')->placeholder('Job location')->rules('max:100');
            $form->text('time', 'Time')->placeholder('Full time/Part time')->rules('max:100');
            $form->textarea('benefits', 'Benefits')->placeholder('Benefits')->rules('max:100');
            $form->text('salary', 'Salary')->placeholder('Salary')->rules('max:100');
            $form->textarea('description', 'Description')->placeholder('Description');
            $form->text('apply_link', 'Apply link')->placeholder('Apply link')->rules('regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/', [
                'regex' => 'Invalid Url'
            ]);
            $form->display('created_at', 'Created at');
            $form->display('updated_at', 'Updated at');
        });
    }
}

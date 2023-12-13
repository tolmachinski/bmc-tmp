<?php

namespace App\Admin\Controllers;

use App\LoanProgram;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Support\Str;

class LoanProgramController extends Controller
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

            $content->header('LoanProgram');


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


            $content->header('LoanProgram');

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


            $content->header('LoanProgram');

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
        return Admin::grid(LoanProgram::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->title('Title')->sortable();
            $grid->content('Description')->sortable()->display(function($text) {
                return Str::limit(strip_tags($text), 100, '...');
            });
            $grid->created_at()->sortable();
            $grid->updated_at()->sortable();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(LoanProgram::class, function (Form $form) {
            $form->display('id', 'ID');
            $form->text('title', 'Title')->rules('required|string|min:3|max:200');
            $form->ceditor('content', 'Description')->rules('nullable|string|max:63000');
            $form->image('img', 'Image')->rules('required|image|mimes:png,jpg,jpeg')->removable();
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}

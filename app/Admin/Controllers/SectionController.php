<?php

namespace App\Admin\Controllers;

use App\Section;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Support\Facades\Config;

class SectionController extends Controller
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

            $content->header('Sections');

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

            $content->header('Sections');

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

            $content->header('Sections');

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
        return Admin::grid(Section::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->page('Page')->sortable();
            $grid->heading('Heading')->sortable();
            //$grid->line_1('Line 1')->sortable();
            //$grid->line_2('Line 2')->sortable();
           //$grid->content('Content')->sortable();
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
        return Admin::form(Section::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->select('page', 'Page')->options(Config::get('pages'))->rules('required|string|max:100');
            $form->text('heading', 'Heading')->rules('required|string|min:3|max:200');
            $form->text('line_1', 'Line 1')->rules('nullable|string|max:500');
            $form->text('line_2', 'Line 2')->rules('nullable|string|max:500');
            $form->ceditor('content', 'Content')->rules('nullable|string|max:63000');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}

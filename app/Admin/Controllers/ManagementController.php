<?php

namespace App\Admin\Controllers;

use App\Management;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Support\Str;

class ManagementController extends Controller
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

            $content->header('Management');

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

            $content->header('Management');

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

            $content->header('Management');

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
        return Admin::grid(Management::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->title('Title')->sortable();
            $grid->position('Position')->sortable();
            $grid->description('Description')->sortable()->display(function($text) {
                return Str::limit(strip_tags($text), 100, '...');
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
        return Admin::form(Management::class, function (Form $form) {
            $form->display('id', 'ID');
            $form->image('image', 'Image')->rules('image|mimes:png,jpg,jpeg')->removable();
            $form->text('title', 'Title')->rules('required|string|min:3|max:200');
            $form->text('position', 'Position')->rules('required|string|min:3|max:200');
            $form->ceditor('description', 'Description')->rules('required|min:3|max:63000');
            $form->select('type', 'Type')->options([0 => 'Type 1', 1 => 'Type 2'])->rules('required|min:0|max:1');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}

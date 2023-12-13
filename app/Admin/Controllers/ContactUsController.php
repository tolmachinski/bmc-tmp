<?php

namespace App\Admin\Controllers;

use App\ContactUs;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Support\Str;

class ContactUsController extends Controller
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

            $content->header('Contact Us');


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
            $content->header('Contact Us');

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

            $content->header('Contact Us');

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
        return Admin::grid(ContactUs::class, function (Grid $grid) {
            $grid->title_1('First title of Office')->sortable();
            $grid->title_2('Second title of Office')->sortable();
            $grid->address_1('First address')->display(function($text) {
                return Str::limit(strip_tags($text), 100, '...');
            });
            $grid->address_2('Second address')->display(function($text) {
                return Str::limit(strip_tags($text), 100, '...');
            });
            $grid->facebook('Facebook link');
            $grid->twitter('Twitter link');
            $grid->in('IN link');
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
        return Admin::form(ContactUs::class, function (Form $form) {
            $form->text('title_1', 'First title of Office')->rules('required|string|min:5|max:200');
            $form->text('title_2', 'Second title of Office')->rules('required|string|min:5|max:200');
            $form->ceditor('address_1', 'First address')->rules('required|string|min:5|max:5000');
            $form->ceditor('address_2', 'Second address')->rules('required|string|min:5|max:5000');
            $form->text('facebook', 'Facebook')->rules('required|string|max:200');
            $form->text('twitter', 'Twitter')->rules('required|string|max:200');
            $form->text('in', 'In')->rules('required|string|max:200');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}

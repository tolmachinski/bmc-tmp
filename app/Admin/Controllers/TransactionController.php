<?php

namespace App\Admin\Controllers;

use App\Transaction;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Support\Str;

class TransactionController extends Controller
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

            $content->header('Transactions');


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

            $content->header('Transactions');
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
            $content->header('Transactions');
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
        return Admin::grid(Transaction::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->title('Title')->sortable();
            $grid->short('Short')->sortable()->display(function($text) {
                return Str::limit(strip_tags($text), 200, '...');
            });
            // $grid->content('Content')->sortable()->display(function($text) {
            //     return Str::limit(strip_tags($text), 100, '...');
            // });
            $grid->price('Price')->sortable();
            $grid->is_featured('Featured')->sortable()->display(function($value) {
                return $value == 1 ? 'Yes' : 'No';
            });
            // $grid->date('Date')->sortable();
            // $grid->size('Size')->sortable();
            // $grid->show_in_background('Background')->sortable();
            // $grid->home_page('Home page')->sortable();
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
        return Admin::form(Transaction::class, function (Form $form) {
            $form->display('id', 'ID');
            $form->text('title', 'Title')->rules('required|string|min:3|max:200');
            $form->ceditor('short', 'Short')->rules('required|string|min:3|max:200');
            $form->number('price', 'Price')->rules('required|numeric|min:0|max:999999999999');
            // $form->ceditor('content', 'Content')->rules('string|nullable|max:63000');
            // $form->select('size', 'Tile size')->options(['small' => 'Small', 'medium' => 'Medium', 'large' => 'Large'])->rules('required|in:small,medium,large');
            // $form->image('img', 'Image')->rules('required|image|mimes:png,jpg,jpeg')->removable();
            // $form->switch('show_in_background', 'Show the image in background (this works only for small Tiles)')->states([
            //     'on'  => ['value' => '1', 'text' => 'ON'],
            //     'off' => ['value' => '0', 'text' => 'OFF'],
            // ])->default('0');
            // $form->switch('home_page', 'Display on the home page?')->states([
            //     'on'  => ['value' => '1', 'text' => 'ON'],
            //     'off' => ['value' => '0', 'text' => 'OFF'],
            // ])->default('0');
             $form->switch('is_featured', 'Make this transaction featured?')->states([
                 'on'  => ['value' => '1', 'text' => 'YES'],
                 'off' => ['value' => '0', 'text' => 'NO'],
             ])->default('0');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}

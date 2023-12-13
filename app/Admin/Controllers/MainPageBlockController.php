<?php

namespace App\Admin\Controllers;

use App\MainPageBlock;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Form\Builder;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
// use Symfony\Component\HttpFoundation\Request;
use App\Admin\Extensions\Grid\Tools\CreateDropdown;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;

class MainPageBlockController extends Controller
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
            $content->header('Main page blocks');
            $content->description('Page where you can manage main page blocks');
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
        $block = MainPageBlock::findOrFail($id);

        return Admin::content(function (Content $content) use ($id, $block) {
            $content->header('Edit block');
            $content->description('Edit main page block');
            $content->body($this->form($block->type)->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create(Request $request)
    {
        return Admin::content(function (Content $content) use ($request) {
            $type = $request->query('type');
            $content->header('Add block');
            $content->description('Add main page block');
            $form = $this->form($type);
            $form->setAction(route('main-page.store') . "?type={$type}");

            $content->body($form->render());
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->form($request->query('type'))->store();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $block = MainPageBlock::findOrFail($id);

        return $this->form($block->type)->update($id);
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(MainPageBlock::class, function (Grid $grid) {
            $grid->id('ID')->sortable();
            $grid->type()->sortable();
            $grid->disableCreateButton();
            $grid->tools(function ($tools) use ($grid) {
                $dropdown = new CreateDropdown($grid);
                $tools->append($dropdown->render());
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
    protected function form($type = null)
    {
        return Admin::form(MainPageBlock::class, function (Form $form) use ($type) {           
            $form->display('id', 'ID');
            $form->hidden('type', 'type')->value($type);

            switch ($type) {
                case 'banner':
                    $form->ceditor('content', 'Content')->rules('required|string|max:1000');
                    $form->text('button_title', 'Button title')->rules('required|string|min:3|max:250');
                    $form->url('button_url', 'Button URL')->rules('required|string|url|max:250');
                    break;
                    
                case 'top-left':
                    $form->image('image', 'Image')->rules('required|image|mimes:png,jpg,jpeg')->removable();
                    $form->text('title', 'Title')->rules('required|string|min:3|max:250');
                    $form->text('address', 'Address')->rules('required|string|min:3|max:250');
                    $form->ceditor('content', 'Content')->rules('required|string|max:1000');
                    $form->number('price', 'Price')->rules('required|numeric|min:0|max:999999999999');
                    break;

                case 'featured-transactions':
                    $form->text('title', 'Title')->rules('required|string|min:3|max:250');
                    break;

                case 'top-right':
                    $form->ceditor('content', 'Content')->rules('required|string|max:1000');
                    $form->text('button_title', 'Button title')->rules('required|string|min:3|max:250');
                    $form->url('button_url', 'Button URL')->rules('required|string|url|max:250');
                    break;

                case 'center-left':
                    $form->ceditor('content', 'Content')->rules('required|string|max:1000');
                    $form->text('button_title', 'Button title')->rules('required|string|min:3|max:250');
                    $form->url('button_url', 'Button URL')->rules('required|string|url|max:250');
                    break;

                case 'center-right':
                    $form->image('image', 'Image')->rules('required|image|mimes:png,jpg,jpeg')->removable();
                    $form->text('title', 'Title')->rules('required|string|min:3|max:250');
                    $form->ceditor('content', 'Content')->rules('required|string|max:63000');
                    $form->text('button_title', 'Button title')->rules('required|string|min:3|max:250');
                    $form->url('button_url', 'Button URL')->rules('required|string|url|max:250');
                    break;

                case 'bottom-left':
                    $form->embeds('content', 'Testimonials', function($form) use ($type) {
                        $form->ceditor('first::text', 'Content')->rules('required|string|max:5000');
                        $form->text('first::author', 'Author')->rules('required|string|max:250');
                        $form->text('first::address', 'Address')->rules('string|nullable|max:250');
                        $form->text('first::position', 'Position')->rules('string|nullable|max:250');
                        
                        $form->divide();
                        
                        $form->ceditor('second::text', 'Content')->rules('string|nullable|max:5000');
                        $form->text('second::author', 'Author')->rules('required|string|max:250');
                        $form->text('second::address', 'Address')->rules('string|nullable|max:250');
                        $form->text('second::position', 'Position')->rules('string|nullable|max:250');

                        $form->divide();

                        $form->ceditor('third::text', 'Content')->rules('string|nullable|max:5000');
                        $form->text('third::author', 'Author')->rules('required|string|max:250');
                        $form->text('third::address', 'Address')->rules('string|nullable|max:250');
                        $form->text('third::position', 'Position')->rules('string|nullable|max:250');

                        $form->divide();

                        $form->ceditor('forth::text', 'Content')->rules('string|nullable|max:5000');
                        $form->text('forth::author', 'Author')->rules('required|string|max:250');
                        $form->text('forth::address', 'Address')->rules('string|nullable|max:250');
                        $form->text('forth::position', 'Position')->rules('string|nullable|max:250');

                        $form->divide();

                        $form->ceditor('fifth::text', 'Content')->rules('string|nullable|max:5000');
                        $form->text('fifth::author', 'Author')->rules('required|string|max:250');
                        $form->text('fifth::address', 'Address')->rules('string|nullable|max:250');
                        $form->text('fifth::position', 'Position')->rules('string|nullable|max:250');
                    });

                    break;

                case 'bottom-right':
                    $form->text('title', 'Title')->rules('required|string|min:3|max:250');
                    $form->ceditor('content', 'Content')->rules('required|string|max:1000');
                    $form->text('button_title', 'Button title')->rules('required|string|min:3|max:250');
                    $form->url('button_url', 'Button URL')->rules('required|string|url|max:250');
                    break;
                
                default:
                    break;
            }
            
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
            $form->saving(function (Form $form) use($type) {
                $content = $form->input('content');
                if(null !== $content && is_string($content)) {
                    $form->input('content', preg_replace('/&nbsp;\s/i', ' ', $content));
                }
            });
        });
    }
}

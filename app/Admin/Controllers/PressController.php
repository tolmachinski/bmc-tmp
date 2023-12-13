<?php

namespace App\Admin\Controllers;

use App\Press;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Request;
use App\Helpers\Html;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;

class PressController extends Controller
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

            $content->header('Press');

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
        return Admin::grid(Press::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->title('Title')->sortable();
            $grid->date('Date')->sortable();
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
        return Admin::form(Press::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('title', 'Title')->rules('required|string|min:3|max:200');
            $form->date('date', 'Date')->rules('required|date');
            $form->image('img', 'Photo')->rules('required|image|mimes:png,jpg,jpeg')->removable();
            $form->ceditor('description', 'Description')->rules('required|string|min:3|max:63000');
            $form->radio('format', 'Select Source')->options(['pdf' => 'PDF', 'link'=> 'Link'])->default('link');

            $form->text('url', 'Url')->rules('max:2000|required_if:format,link');
            $form->file('pdf', 'PDF document')->move('documents')->rules('mimes:pdf|required_if:format,pdf')->removable();

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
            $form->saved(function($from) {
                $model = $from->model();
                if(null === $model->img) {
                    return;
                }

                $disk = Storage::disk('admin');
                $width = config('press.image.width', 325);
                $height = config('press.image.height', 250);
                if ($disk->exists($model->img)) {
                    $image = ImageManagerStatic::make(public_path("uploads/{$model->img}"));
                    if($width !== $image->getWidth() || $height !== $image->getHeight()) {
                        $image->fit($width, $height);
                        $image->save();
                    }
                }

                if (null === $model->pdf) {
                    return;
                }

                if (!$disk->exists($model->pdf)) {
                    return;
                }


                $file = new File($disk->path($model->pdf));
                $name = str_slug(str_replace(".{$file->getExtension()}", '', $file->getFileName()));
                $directory = dirname($model->pdf);
                $oldPath = $model->pdf;
                $model->pdf ="{$directory}/{$name}.{$file->getExtension()}";
                if (!$disk->exists($model->pdf)) {
                    $disk->rename($oldPath, $model->pdf);
                    $model->save();
                }
                
            });
            //$form->radio('format');
            // $form->saving(function($form) {
            //     $form->model()->setAttribute('description', trim(Html::sanitize(Request::input('description'))));
            // });
            
        });
    }
}

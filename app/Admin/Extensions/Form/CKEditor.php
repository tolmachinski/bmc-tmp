<?php

namespace App\Admin\Extensions\Form;

use Encore\Admin\Form\Field;

class CKEditor extends Field
{
    public static $js = [
        '/packages/ckeditor/ckeditor.js',
        '/packages/ckeditor/adapters/jquery.js',
    ];

    protected $view = 'admin.ckeditor';

    public function render()
    {
        // $this->script = "$('textarea.{$this->getElementClassString()}').ckeditor({enterMode : CKEDITOR.ENTER_BR});";
        $this->script = "CKEDITOR.replace('{$this->column}');";

        return parent::render();
    }
}
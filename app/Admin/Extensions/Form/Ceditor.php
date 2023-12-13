<?php

namespace App\Admin\Extensions\Form;

use Encore\Admin\Form\Field\Editor;

class Ceditor extends Editor
{
    protected static $js = [
        '/packages/ckeditor/ckeditor.js',
    ];



    protected $view = 'admin.editor';

    public function render()
    {
        $this->script = "
            //CKEDITOR.config.fillEmptyBlocks = false; 
            CKEDITOR.replace('{$this->column}');
        ";

        return parent::render();
    }
}

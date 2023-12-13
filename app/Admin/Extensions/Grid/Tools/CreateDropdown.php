<?php

namespace App\Admin\Extensions\Grid\Tools;

use Encore\Admin\Grid;
use Encore\Admin\Grid\Tools\AbstractTool;

class CreateDropdown extends AbstractTool
{
    /**
     * Create a new CreateDropdown instance.
     *
     * @param Grid $grid
     */
    public function __construct(Grid $grid)
    {
        $this->grid = $grid;
    }

    /**
     * Render CreateDropdown.
     *
     * @return string
     */
    public function render()
    {
        $new = trans('admin.new');
        $baseUrl = url($this->grid->resource());

        return <<<EOT
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-sm btn-success">{$new}</button>
            <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="$baseUrl/create?type=banner">Banner block</a></li>
                <li><a href="$baseUrl/create?type=top-left">Top left block</a></li>
                <li><a href="$baseUrl/create?type=featured-transactions">Featured transactions block</a></li>
                <li><a href="$baseUrl/create?type=top-right">Top right block</a></li>
                <li><a href="$baseUrl/create?type=center-left">Center left block</a></li>
                <li><a href="$baseUrl/create?type=center-right">Center right block</a></li>
                <!-- <li><a href="$baseUrl/create?type=bottom-left">Bottom left block</a></li> -->
                <li><a href="$baseUrl/create?type=bottom-right">Bottom right block</a></li>
            </ul>
        </div>
EOT;
    }
}

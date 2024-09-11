<?php

namespace App\Helpers;

class Menu
{
    public $html = '';
    public $role = '';

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function init()
    {
        $this->html = '<div class="collapse navbar-collapse" id="sidenav-collapse-main">';
        return $this;
    }

    public function item($title, $icon, $url, $isActive, $assign)
    {
        if (in_array($this->role, $assign)) {
            $this->html .= '<li class="nav-item">
                <a class="nav-link ' . ($isActive ? 'active' : '') . '" href="' . url($url) . '">
                    <i class="' . $icon . '"></i>
                    <span class="nav-link-text">' . $title . '</span>
                </a>
            </li>';
        }

        return $this;
    }

    public function customIconItem($title, $icon, $url, $isActive, $assign)
    {
        if (in_array($this->role, $assign)) {
            $this->html .= '<li class="nav-item">
                <a class="nav-link ' . ($isActive ? 'active' : '') . '" href="' . url($url) . '">
                    <object type="image/svg+xml" data="' . $icon . '" class="custom-icon custom-icon-large custom-icon-secondary"></object>
                    <span class="nav-link-text">' . $title . '</span>
                </a>
            </li>';
        }

        return $this;
    }

    public function divinder()
    {
        $this->html .= '<hr class="my-3">';
        return $this;
    }

    public function start_accordion()
    {
        $this->html .= '<div class="accordion" id="accordionExample">';

        return $this;
    }

    public function sub_item_accordion($title, $module, $assign, $icon)
    {
        if (in_array($this->role, $assign)) {
            $this->html .= '<li class="nav-item ml-1">
            <a class="btn btn-link btn-block text-left" href="#" data-toggle="collapse" data-target="#collapse-' . $module . '" aria-expanded="true" aria-controls="collapse-' . $module . '">
                <i class="' . $icon . '"></i>
                <span class="nav-link-text">' . $title . '</span>
            </a>
        </li>';
        }
        return $this;
    }

    public function start_item_accordion($module, $isActive)
    {
        $this->html .= '<div id="collapse-' . $module . '" class="ml-3' . ($isActive ? ' show' : '') . ' collapse" data-parent="#accordionExample">';

        return $this;
    }

    public function end_item_accordion()
    {
        $this->html .= '</div>';

        return $this;
    }

    public function end_accordion()
    {
        $this->html .= '</div>';
        return $this;
    }

    public function start_group()
    {
        $this->html .= '<ul class="navbar-nav">';
        return $this;
    }

    public function end_group()
    {
        $this->html .= '</ul>';
        return $this;
    }

    public function to_html()
    {
        $this->html .= '</div>';
        return $this->html;
    }
}

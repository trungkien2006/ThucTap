<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function isMobile()
    {
        if (isset($_COOKIE['device_view'])) {
            return $_COOKIE['device_view'] === 'mobile';
        }
        $userAgent = request()->header('User-Agent', '');
        return (bool) preg_match('/Mobile|Android|BlackBerry|iPhone|iPad|iPod|Opera Mini|IEMobile/i', $userAgent);
    }

    protected function renderView($view, $data = [])
    {
        if ($this->isMobile()) {
            $mobileView = $view . '-mobile';
            if (view()->exists($mobileView)) {
                return view($mobileView, $data);
            }
        }
        return view($view, $data);
    }
}

<?php

namespace App\Lbc;

use App\Lbc\Data\Navbar;

class ComponentsController
{
    public function display($slug) {
        $data = [
            'meta' => [
                'title' => ucfirst($slug)
            ],
        ];

        return view('Lbc/pages/components/' . $slug, compact('data'));
    }
}

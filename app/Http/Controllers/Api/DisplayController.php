<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Display;
use Illuminate\Http\Request;

class DisplayController extends Controller
{
    public function index(Request $request)
    {
        $displays = Display::get();

        $arDisplays = [];
        foreach ($displays as $display) {
            $arDisplays[] = [
                'name' => $display->name,
                'longitude' => $display->longitude,
                'latitude' => $display->latitude,
                'approved' => $display->approved,
                'verified' => $display->verified,
                'images' => $display->images,
            ];
        }

        return json_encode($arDisplays);
    }
}

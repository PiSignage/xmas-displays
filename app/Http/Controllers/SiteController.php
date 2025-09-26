<?php

namespace App\Http\Controllers;

use App\Models\Display;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function lookup(Request $request)
    {
        $url = 'https://nominatim.openstreetmap.org/search?' . http_build_query(['q' => $request->location_search, 'limit' => "1", 'format' => 'json']);
        $options = array(
            "http" => array(
                "header" => "User-Agent: Mozilla/5.0 (iPad; U; CPU OS 3_2 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Version/4.0.4 Mobile/7B334b Safari/531.21.102011-10-16 20:23:10\r\n" // i.e. An iPad
            )
        );
        $context = stream_context_create($options);
        $result = json_decode(file_get_contents($url, false, $context), true)[0];

        $lat = $result['lat'];
        $lon = $result['lon'];

        $displays = Display::simale();

        return response()->json([
            'append' => false,
            'current_page' => 1,
            'found_listings' => $displays->count() > 1,
            'has_more_pages' => false,
            'html' => 'test',
            'max_num_pages' => 0,
            'next_page_count' => 0,
            'pagination' => '',
            'total_found' => $displays->count(),
            'user_location' => [
                'address' => $request->location_search,
                'lat' => floatval($result['lat']),
                'lng' => floatval($result['lon']),
                'radius' => $request->search_radius,
                'unit' => 'km',
            ]
        ]);
    }

    public function viewDisplay(Display $display)
    {
        return view('display.view', [
            'display' => $display,
        ]);
    }
}

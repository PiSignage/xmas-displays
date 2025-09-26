<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Display;
use Illuminate\Http\Request;

class DisplayController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('location_search')) {
            $url = 'https://nominatim.openstreetmap.org/search?' . http_build_query(['q' => $request->location_search, 'limit' => "1", 'format' => 'json']);
            $options = array(
                "http" => array(
                    "header" => "User-Agent: Mozilla/5.0 (iPad; U; CPU OS 3_2 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Version/4.0.4 Mobile/7B334b Safari/531.21.102011-10-16 20:23:10\r\n" // i.e. An iPad
                )
            );
            $context = stream_context_create($options);
            $result = json_decode(file_get_contents($url, false, $context), true)[0];

            $lat = $result['lat'];
            $lng = $result['lon'];

            $displays = Display::distance($lat, $lng, $request->search_radius, 'miles')->get();
        }

        $html = '';
        foreach ($displays as $display) {
            $html = $html . view('display', ['display' => $display])->render();
        }

        $output = [
            'append' => false,
            'current_page' => 1,
            'found_listings' => $displays->count() > 1,
            'has_more_pages' => false,
            'html' => $html,
            'max_num_pages' => 1,
            'next_page_count' => 1,
            'pagination' => '',
            'total_found' => $displays->count(),
        ];

        // Check for location_search, if would add user_location to output array
        if ($request->has('location_search')) {
            $output['user_location'] = [
                'address' => $request->location_search,
                'lat' => floatval($result['lat']),
                'lng' => floatval($result['lon']),
                'radius' => $request->search_radius,
                'unit' => 'km',
            ];
        }

        return json_encode($output);
    }

    public function app(Request $request)
    {
        $request->validate([
            'type' => 'required',
        ]);

        $lat = $request->latitude;
        $lng = $request->longitude;
        $radius = $request->has('radius') ? $request->radius : 400000;

        if ($request->type == 'map') {
            $displays = Display::distance($lat, $lng, $radius, 'mile')->get();
        }

        if ($request->type == 'list') {
            $displays = Display::distance($lat, $lng, $radius, 'mile')
                ->where(function ($query) use ($request) {
                    if ($request->has('q')) {
                        $query->where('name', 'LIKE', '%' . $request->q . '%');
                    }
                })
                ->simplePaginate(perPage: $request->limit, page: $request->page)
                ->items();
        }

        $displayArray = [];
        foreach ($displays as $display) {
            $image = $display->image != 'placeholder.jpg' ? asset('show_images/' . $display->image) : 'https://placehold.co/600x400/png';
            // Empty images array
            $images = [];
            // Add base image to images array
            if (count($display->images) > 0) {
                // Loop over images and add them to images array
                foreach ($display->images as $image) {
                    $images[] = asset('show_images/' . $image);
                }
            } else {
                $images[] = asset('assets/images/placeholder.jpg');
            }

            $displayArray[] = [
                'id' => $display->id,
                'name' => $display->name,
                'description' => $display->description,
                'address' => 'address',
                'latitude' => $display->latitude,
                'longitude' => $display->longitude,
                'image' => $image,
                'distance' => $request->has('latitude') ? $display->workoutDistance(
                    $request->latitude,
                    $request->longitude,
                    $display->latitude,
                    $display->longitude,
                    'M'
                ) : null,
                'images' => $images,
                'approved' => $display->approved,
                'verified' => $display->verified,
                'tags' => [],
                'links' => [],
            ];
        }

        return response()->json($displayArray);
    }
}

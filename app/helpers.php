<?php
if (!function_exists('link_helper')) {
    function link_helper($icon)
    {
        switch ($icon) {
            case 'facebook':
                $details = [
                    'class' => 'fb',
                    'view_icon' => 'facebook-square',
                    'text' => 'Facebook',
                ];
                break;

            case 'instagram':
                $details = [
                    'class' => 'ig',
                    'view_icon' => 'instagram',
                    'text' => 'Instagram',
                ];
                break;

            case 'twitter':
                $details = [
                    'class' => 'tt',
                    'view_icon' => 'twitter',
                    'text' => 'Twitter',
                ];
                break;

            case 'youtube':
                $details = [
                    'class' => 'yt',
                    'view_icon' => 'youtube-play',
                    'text' => 'YouTube',
                ];
                break;
        }

        return $details;
    }
}

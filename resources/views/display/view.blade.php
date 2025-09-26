@extends('layouts.site')

@section('content')
    <div class="listing-slider mfp-gallery-container margin-bottom-0">
        @foreach ($display->images as $image)
            <a href="{{ asset('display_images/' . $image) }}" data-background-image="{{ asset('display_images/' . $image) }}"
                class="item mfp-gallery" title="{{ $display->name }}"></a>
        @endforeach
    </div>

    <div class="container">
        <div class="row sticky-wrapper">
            <div class="col-lg-8 col-md-8 padding-right-30">

                <!-- Titlebar -->
                <div id="titlebar" class="listing-titlebar">
                    <div class="listing-titlebar-title">
                        <h2>{{ $display->name }} <span class="listing-tag">Eat & Drink</span></h2>
                        <span>
                            <a href="#listing-location" class="listing-address">
                                <i class="fa fa-map-marker"></i>
                                2726 Shinn Street, New York
                            </a>
                        </span>
                        <div class="star-rating" data-rating="5">
                            <div class="rating-counter"><a href="#listing-reviews">(31 reviews)</a></div>
                        </div>
                    </div>
                </div>

                @if (count($display->links) > 0)
                    <div class="listing-links-container">
                        @if (!is_null($display->public_email) || !is_null($display->website_uri))
                            <ul class="listing-links contact-links">
                                @if (!is_null($display->public_email))
                                    <li><a href="mailto:{{ $display->public_email }}" class="listing-links"><i
                                                class="fa fa-envelope-o"></i>
                                            {{ $display->public_email }}</a>
                                    </li>
                                @endif
                                @if (!is_null($display->website_uri))
                                    <li><a href="{{ $display->website_uri }}" target="_blank" class="listing-links"><i
                                                class="fa fa-link"></i>
                                            {{ $display->website_uri }}</a></li>
                                @endif
                            </ul>
                            <div class="clearfix"></div>
                        @endif
                        <ul class="listing-links">
                            @foreach ($display->links as $link)
                                @if ($link['icon'] != 'website')
                                    <li>
                                        <a href="{{ $link['url'] }}" target="_blank"
                                            class="listing-links-{{ link_helper($link['icon'])['class'] }}">
                                            <i class="fa fa-{{ link_helper($link['icon'])['view_icon'] }}"></i>
                                            {{ link_helper($link['icon'])['text'] }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                @endif

                <h3 class="listing-desc-headline">Tags</h3>
                <ul class="listing-features checkboxes margin-top-0">
                    <li>Tag</li>
                    <li>Tag</li>
                    <li>Tag</li>
                    <li>Tag</li>
                    <li>Tag</li>
                    <li>Tag</li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-4 margin-top-75 sticky">
                @if ($display->verified)
                    <!-- Verified Badge -->
                    <div class="verified-badge with-tip"
                        data-tip-content="Listing has been verified and belongs the business owner or manager.">
                        <i class="sl sl-icon-check"></i> Verified Display
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

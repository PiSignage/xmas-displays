@extends('layouts.site')

@section('content')
<div class="fs-container">

    <div class="fs-inner-container content">
        <div class="fs-content">

            <!-- Search -->
            <section class="search">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" id="listeo_core-search-form" class="listeo-form-search_on_half_map dynamic    ajax-search" method="GET">
                            <!-- Row With Forms -->
                            <div class="row with-forms">

                                <!-- Main Search Input -->
                                <div class="col-fs-6">
                                    <div class="input-with-icon">
                                        <i class="sl sl-icon-magnifier"></i>
                                        <input type="text" placeholder="What are you looking for?" value="" />
                                    </div>
                                </div>

                                <!-- Main Search Input -->
                                <div class="col-fs-6">
                                    <div class="input-with-icon location">
                                        <div id="autocomplete-container">
                                            <input autocomplete="off" name="location_search" id="location_search" type="text" placeholder="Location" value="" />
                                        </div>
                                        <a href="#"><i title="Find My Location" class="tooltip left fa fa-map-marker"></i></a>
                                    </div>
                                </div>


                                <!-- Filters -->
                                <div class="col-fs-12">

                                    <!-- Panel Dropdown / End -->
                                    <div class="panel-dropdown">
                                        <a href="#">Categories</a>
                                        <div class="panel-dropdown-content checkboxes categories">

                                            <!-- Checkboxes -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input id="check-1" type="checkbox" name="check" checked class="all">
                                                    <label for="check-1">All Categories</label>

                                                    <input id="check-2" type="checkbox" name="check">
                                                    <label for="check-2">Shops</label>

                                                    <input id="check-3" type="checkbox" name="check">
                                                    <label for="check-3">Hotels</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <input id="check-4" type="checkbox" name="check">
                                                    <label for="check-4">Eat & Drink</label>

                                                    <input id="check-5" type="checkbox" name="check">
                                                    <label for="check-5">Fitness</label>

                                                    <input id="check-6" type="checkbox" name="check">
                                                    <label for="check-6">Events</label>
                                                </div>
                                            </div>

                                            <!-- Buttons -->
                                            <div class="panel-buttons">
                                                <button class="panel-cancel">Cancel</button>
                                                <button class="panel-apply">Apply</button>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- Panel Dropdown / End -->

                                    <!-- Panel Dropdown -->
                                    <div class="panel-dropdown wide">
                                        <a href="#">More Filters</a>
                                        <div class="panel-dropdown-content checkboxes">

                                            <!-- Checkboxes -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input id="check-a" type="checkbox" name="check">
                                                    <label for="check-a">Elevator in building</label>

                                                    <input id="check-b" type="checkbox" name="check">
                                                    <label for="check-b">Friendly workspace</label>

                                                    <input id="check-c" type="checkbox" name="check">
                                                    <label for="check-c">Instant Book</label>

                                                    <input id="check-d" type="checkbox" name="check">
                                                    <label for="check-d">Wireless Internet</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <input id="check-e" type="checkbox" name="check">
                                                    <label for="check-e">Free parking on premises</label>

                                                    <input id="check-f" type="checkbox" name="check">
                                                    <label for="check-f">Free parking on street</label>

                                                    <input id="check-g" type="checkbox" name="check">
                                                    <label for="check-g">Smoking allowed</label>

                                                    <input id="check-h" type="checkbox" name="check">
                                                    <label for="check-h">Events</label>
                                                </div>
                                            </div>

                                            <!-- Buttons -->
                                            <div class="panel-buttons">
                                                <button class="panel-cancel">Cancel</button>
                                                <button class="panel-apply">Apply</button>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- Panel Dropdown / End -->

                                    <!-- Panel Dropdown -->
                                    <div class="panel-dropdown radius-dropdown" id="search_radius-panel">
                                        <a href="#">Distance Radius</a>
                                        <div class="panel-dropdown-content">
                                            <input name="search_radius" class="distance-radius" type="range" min="1" max="100" step="1" value="15" data-title="Distance Radius">
                                            <div class=" panel-buttons">
                                                <span class="panel-disable" data-disable="Disable" data-enable="Enable">Disable</span>
                                                <button class="panel-apply">Apply</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Panel Dropdown / End -->

                                </div>
                                <!-- Filters / End -->

                            </div>
                            <!-- Row With Forms / End -->
                        </form>
                    </div>
                </div>

            </section>
            <!-- Search / End -->


            <section class="listings-container margin-top-30">
                <!-- Listings -->
                <div id="listeo-listings-container" class=" row fs-listings">
                    @foreach ($displays as $display)
                    <div class="col-lg-12 col-md-12">
                        <div class="listing-item-container list-layout listing-geo-data"
                            data-title="{{ $display->name }}"
                            data-image="{{ $display->image }}"
                            data-longitude="{{ $display->longitude }}"
                            data-latitude="{{ $display->latitude }}"
                            data-icon='<i class="im im-icon-Chef-Hat"></i>'>
                            <a href=" listings-single-page.html" class="listing-item">

                                <!-- Image -->
                                <div class="listing-item-image">
                                    <img src="{{ $display->image }}" alt="">
                                    <span class="tag">Eat &amp; Drink</span>
                                </div>

                                <!-- Content -->
                                <div class="listing-item-content">
                                    <div class="listing-badge now-open">Now Open</div>

                                    <div class="listing-item-inner">
                                        <h3>{{ $display->name }} {!! $display->verified ? '<i class="verified-icon"></i>' : 'NO' !!}</h3>
                                        <span>964 School Street, New York</span>
                                        <div class="star-rating" data-rating="3.5">
                                            <div class="rating-counter">(12 reviews)</div>
                                            <span class="star"></span>
                                            <span class="star"></span>
                                            <span class="star"></span>
                                            <span class="star half"></span>
                                            <span class="star empty"></span>
                                        </div>
                                    </div>

                                    <span class="like-icon"></span>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- Listings Container / End -->


                <!-- Pagination Container -->
                <div class="row fs-listings">
                    <div class="col-md-12">

                        <!-- Pagination -->
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Pagination -->
                                <div class="pagination-container margin-top-20 margin-bottom-20 ajax-search">
                                    <nav class="pagination margin-top-30">
                                        <ul class="pagination">
                                            <li><a href="#" class="current-page" data-paged="1">1</a></li>
                                            <li><a href="#" data-paged="2">2</a></li>
                                            <li><a href="#" data-paged="3">3</a></li>
                                            <li><a href="#"><i class="sl sl-icon-arrow-right"></i></a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <!-- Pagination / End -->

                        <!-- Copyrights -->
                        <div class="copyrights margin-top-0">© 2021 Listeo. All Rights Reserved.</div>

                    </div>
                </div>
                <!-- Pagination Container / End -->
            </section>

        </div>
    </div>
    <div class="fs-inner-container map-fixed">

        <!-- Map -->
        <div id="map-container">
            <div id="map" class="split-map" data-map-zoom=" 16" data-map-scroll="true">
                <!-- map goes here -->
            </div>
        </div>

    </div>
</div>
@endsection

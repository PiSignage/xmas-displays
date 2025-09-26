<div class="col-lg-12 col-md-12">
    <div class="listing-item-container list-layout listing-geo-data" data-title="{{ $display->name }}"
        data-image="{{ $display->image }}" data-longitude="{{ $display->longitude }}"
        data-latitude="{{ $display->latitude }}" data-icon='<i class="im im-icon-Chef-Hat"></i>'>
        <a href="#" class="listing-item">

            <!-- Image -->
            <div class="listing-item-image">
                <img src="{{ $display->image }}" alt="">
                <span class="tag">Eat &amp; Drink</span>
            </div>

            <!-- Content -->
            <div class="listing-item-content">
                {{-- <div class="listing-badge now-open">Now Open</div> --}}

                <div class="listing-item-inner">
                    <h3>{{ $display->name }} {!! $display->verified ? '<i class="verified-icon"></i>' : '' !!}</h3>
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

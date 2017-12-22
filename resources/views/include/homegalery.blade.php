<!--KODE GALLERY WRAP START-->
<div class="kode_gallery_wrap">
    <!--CONTAINER START-->
    <div class="container">
        <!--SECTION HDG START-->

        <div class="section_hdg hdg_2 hdg_3">
            <a href="#"><img src="images/hdg-img.png" alt=""></a>
            <h3>Our Gallery</h3>
            <span><i class="fa icon-building"></i></span>
        </div>

        <!--SECTION HDG END-->
        <div class="kode_gallery_detail">

            <div class="kode_gallery_list list_2">
                @foreach($home_gallery2 as $h)
                <div class="kode_gallery_fig">
                    <figure class="them_overlay">
                        <img src="{{asset('gallery/'.$h->image)}}" alt="" >
                        <a class="hvr-ripple-out" data-rel="prettyPhoto" href="{{asset('gallery/'.$h->image)}}"><i class="fa fa-expand"></i></a>
                    </figure>
                </div>
                @endforeach
            </div>

            <div class="kode_gallery_list">
                @foreach($home_gallery as $ho)
                <div class="kode_gallery_fig fig_2">
                    <figure class="them_overlay">
                        <img src="{{asset('gallery/'.$ho->image)}}" alt="">
                        <a class="hvr-ripple-out" data-rel="prettyPhoto" href="{{asset('gallery/'.$ho->image)}}"><i class="fa fa-expand"></i></a>
                    </figure>
                </div>
                @endforeach

            </div>
        </div>
        <div class="service_btn">
            <a class="medium_btn background-bg-dark btn_hover" href="#">View All Images</a>
        </div>
    </div>
    <!--CONTAINER END-->
</div>
<!--KODE GALLERY WRAP END-->
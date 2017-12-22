
<style>

    @media (max-width: 480px) {

        #sld{

            height:400px;
        }

    }

    @media (min-width: 760px) {

        #sld{

            height:450px;
        }

        .kode_banner_wrap.banner2 .slick-prev, .kode_banner_wrap.banner2 .slick-next{

            margin-top:-100px;
        }
    }
    .slick-arrow {

        display:none;
    }
</style>


<div class="kode_banner_wrap banner2">
    <!--KODE BANNER2 SLID START-->
    <div class="kode-banner2-slid">

        @foreach($new_post as $p)
        <div>
            <div class="kode_banner2_des">
                <figure class="them_overlay" id="sld">
                    <img src="{{asset('css/themes/images/banner4.png')}}" alt="">

                    <div class="kode_banner_text">
                        <div class="large_text wow">ISLAMIC eDUCATION</div>
                        <div class="mediume_text wow">Keep Praying ALLAH is Everything</div>
                        <div class="small_text wow">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words...</div>
                        <div class="koed_banner_btn wow">
                            <a class="medium_btn border margin-right-1 btn_hover" href="#">Read More</a>
                            <a class="medium_btn border btn_hover" href="#">Contact Us</a>
                        </div>
                    </div>
                    <div class="kode_banner2_fig wow">
                        <figure class="f">

                            <img src="{{asset('css/themes/images/banner4.png')}}" alt="">
                        </figure>
                    </div>
                </figure>
            </div>
        </div>
        @endforeach

    </div>
    <!--KODE BANNER2 SLID END-->
</div>
 <!-- Slider Section -->
 <section id="slider" class="slider section dark-background">

     <div class="container" data-aos="fade-up" data-aos-delay="100">

         <div class="swiper init-swiper">

             <script type="application/json" class="swiper-config">
          {
            "loop": true,
            "speed": 600,
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": "auto",
            "centeredSlides": true,
            "pagination": {
              "el": ".swiper-pagination",
              "type": "bullets",
              "clickable": true
            },
            "navigation": {
              "nextEl": ".swiper-button-next",
              "prevEl": ".swiper-button-prev"
            }
          }
        </script>

             <div class="swiper-wrapper">
                 @foreach ($sliderposts as $sliderpost)
                     <div class="swiper-slide" style="background-image: url('{{ asset('uploads/' . $sliderpost->thumbnail) }}');">
                         <div class="content">
                             <h2><a href="{{ route('blog-details', $sliderpost->slug) }}">{{$sliderpost->title}}</a>
                             </h2>
                             <p>{{ Str::limit(strip_tags($sliderpost->editor), 120) }}</p>
                         </div>
                     </div>
                 @endforeach

             </div>

             <div class="swiper-button-next"></div>
             <div class="swiper-button-prev"></div>

             <div class="swiper-pagination"></div>
         </div>

     </div>

 </section><!-- /Slider Section -->

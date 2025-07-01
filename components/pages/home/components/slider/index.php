<div class="swiper home-slider mx-auto overflow-hidden">
  <div class="swiper-wrapper">

    <div class="swiper-slide relative">
      <div class="h-full max-h-[600px] ">
        <img class="w-full" src="https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?auto=format&fit=crop&w=1470&q=80" alt="Slide 1" />
        <div class="absolute bottom-0 left-0 w-full bg-[#14A083]">
          <div class="container py-[48px]">
            <div class=" text-white max-w-lg">
              <h2 class="text-3xl font-bold mb-2">Lorem ipsum dolor sit amet</h2>
              <p class="text-sm max-w-md leading-relaxed">
                Aliquam ornare scelerisque turpis eget posuere. Mauris mi metus, mattis non euismod eget, tristique et metus. Ut eu vestibulum elit. Proin sodales, arcu vitae faucibus faucibus, arcu mauris pellentesque
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="swiper-slide relative">
      <div class="h-full max-h-[600px] ">
        <img class="w-full" src="https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?auto=format&fit=crop&w=1470&q=80" alt="Slide 1" />
        <div class="absolute bottom-0 left-0 w-full bg-[#14A083]">
          <div class="container py-[48px]">
            <div class=" text-white max-w-lg">
              <h2 class="text-3xl font-bold mb-2">Lorem ipsum dolor sit amet</h2>
              <p class="text-sm max-w-md leading-relaxed">
                Aliquam ornare scelerisque turpis eget posuere. Mauris mi metus, mattis non euismod eget, tristique et metus. Ut eu vestibulum elit. Proin sodales, arcu vitae faucibus faucibus, arcu mauris pellentesque
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <div class="swiper-pagination home-slider-pagination bottom-5"></div>

</div>

<?php RenderJS::start() ?>
<script>
  new Swiper('.home-slider', {
    loop: true,
    pagination: {
      el: '.home-slider-pagination',
      clickable: true,
    },
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
  });
</script>
<?php RenderJS::end() ?>

<?php RenderStyle::start() ?>
<style>
  .home-slider-pagination .swiper-pagination-bullet-active {
    background: white;
  }
</style>
<?php RenderStyle::end() ?>
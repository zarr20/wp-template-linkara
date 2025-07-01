<div class="container py-[40px]">
  <h1 class=" font-bold text-[36px] text-[#8C288C] uppercase">
    Library
  </h1>
  <p>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vitae nibh enim. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas
  </p>
</div>

<div class="container py-[20px]">
  <div class="flex">
    <div class="flex-1">
      <?php
      include __DIR__ . "/components/card/index.php";

      $cards = [
        ['image' => 'https://images.unsplash.com/photo-1749741326969-e1676b3bce43?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDF8MHxmZWF0dXJlZC1waG90b3MtZmVlZHwxfHx8ZW58MHx8fHx8', 'date' => '18', 'month' => 'MAR', 'title1' => 'Lorem Ipsum', 'title2' => 'Lorem Ipsum Dolor Sit', 'desc' => 'Lorem ipsum'],
        ['image' => 'https://images.unsplash.com/photo-1743656619958-68d85790bdb4?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHw1fHx8ZW58MHx8fHx8', 'date' => '25', 'month' => 'APR', 'title1' => 'Lorem Ipsum', 'title2' => 'Lorem Ipsum Dolor Sit', 'desc' => 'Lorem ipsum'],
        ['image' => 'https://plus.unsplash.com/premium_photo-1749814603352-f47a596edd52?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHwxMHx8fGVufDB8fHx8fA%3D%3D', 'date' => '10', 'month' => 'MAY', 'title1' => 'Lorem Ipsum', 'title2' => 'Lorem Ipsum Dolor Sit', 'desc' => 'Lorem ipsum'],
        ['image' => 'https://via.placeholder.com/300x150', 'date' => '5', 'month' => 'JUN', 'title1' => 'Lorem Ipsum', 'title2' => 'Lorem Ipsum Dolor Sit', 'desc' => 'Lorem ipsum'],
        ['image' => 'https://via.placeholder.com/300x150', 'date' => '11', 'month' => 'JUL', 'title1' => 'Lorem Ipsum', 'title2' => 'Lorem Ipsum Dolor Sit', 'desc' => 'Lorem ipsum'],
        ['image' => 'https://via.placeholder.com/300x150', 'date' => '19', 'month' => 'AUG', 'title1' => 'Lorem Ipsum', 'title2' => 'Lorem Ipsum Dolor Sit', 'desc' => 'Lorem ipsum'],
        ['image' => 'https://via.placeholder.com/300x150', 'date' => '3', 'month' => 'SEP', 'title1' => 'Lorem Ipsum', 'title2' => 'Lorem Ipsum Dolor Sit', 'desc' => 'Lorem ipsum'],
        ['image' => 'https://via.placeholder.com/300x150', 'date' => '7', 'month' => 'OCT', 'title1' => 'Lorem Ipsum', 'title2' => 'Lorem Ipsum Dolor Sit', 'desc' => 'Lorem ipsum'],
      ];

      $colors = ['yellow', 'purple', 'blue', 'red'];
      $itemsPerRow = 4;

      ?>
      <div class="grid grid-cols-4 gap-4">
        <?php foreach ($cards as $index => $card) : ?>
          <?php
          // Tentukan baris ke berapa (mulai dari 0)
          $row = floor($index / $itemsPerRow);

          // Geser warna berdasarkan baris
          $shiftedColors = $colors;

          // Lakukan pergeseran array
          for ($i = 0; $i < $row; $i++) {
            array_unshift($shiftedColors, array_pop($shiftedColors));
          }

          // Ambil warna berdasarkan posisi dalam baris
          $positionInRow = $index % $itemsPerRow;
          $color = $shiftedColors[$positionInRow];

          renderCard($card, $color);
          ?>
        <?php endforeach; ?>
      </div>

    </div>
    <div class="min-w-[300px]">
      <?php
      include __DIR__ . "/components/sidebar/popular.php";
      include __DIR__ . "/components/sidebar/categories.php";
      ?>
    </div>
  </div>

  <!-- Container Pagination -->
  <div class="flex justify-between items-center py-4">

    <!-- Previous Button -->
    <button class="flex items-center px-4 py-2 bg-purple-700 text-white rounded-full">
      <i class="bi bi-arrow-left mr-2"></i>
      Previous
    </button>

    <!-- Page Numbers -->
    <div class="flex items-center space-x-4">
      <a href="#" class="text-black">1</a>
      <a href="#" class="text-black font-bold border-b-2 border-gray-300">2</a>
      <a href="#" class="text-black">3</a>
      <span>...</span>
      <a href="#" class="text-black">59</a>
      <a href="#" class="text-black">50</a>
      <a href="#" class="text-black">51</a>
    </div>

    <!-- Next Button -->
    <button class="flex items-center px-4 py-2 bg-purple-700 text-white rounded-full">
      Next
      <i class="bi bi-arrow-right ml-2"></i>
    </button>

  </div>

</div>

<?php RenderStyle::start() ?>
<style>
  body {
    background: yellow;
  }
</style>
<?php RenderStyle::end() ?>

<?php RenderJS::start() ?>

<?php RenderJS::end() ?>

<?php
// include __DIR__ . "/components/header/index.php";
// include __DIR__ . "/components/our-mission/index.php";
// include __DIR__ . "/components/our-vision/index.php";
// include __DIR__ . "/components/faq/index.php";

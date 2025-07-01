<?php
function renderCard($card, $color = null)
{
  // Daftar warna Tailwind yang diizinkan
  $colors = [
    'purple' => 'bg-purple-700',
    'yellow' => 'bg-yellow-500',
    'blue' => 'bg-blue-500',
    'red' => 'bg-red-500',
    'green' => 'bg-green-500',
  ];

  $bgColor = isset($colors[$color]) ? $colors[$color] : 'bg-gray-500';
?>
  <div class="max-w-xs rounded-lg overflow-hidden bg-gray-100">
    <div class="relative">
      <img src="<?= $card['image'] ?>" alt="Event Image" class="w-full h-40 object-cover">
      <div class="absolute top-2 left-2 bg-white text-center rounded p-1 w-10">
        <span class="block text-[10px] font-bold text-gray-500"><?= $card['month'] ?></span>
        <span class="block text-lg font-bold text-black leading-none"><?= $card['date'] ?></span>
      </div>
    </div>

    <div class="<?= $bgColor ?> text-white p-4 space-y-1">
      <p class="text-sm"><?= $card['title1'] ?></p>
      <p class="text-sm font-bold"><?= $card['title2'] ?></p>
      <p class="text-sm"><?= $card['desc'] ?></p>

      <div class="flex space-x-2 mt-2">
        <a href="#" class="text-white text-xl">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="#" class="text-white text-xl">
          <i class="fab fa-x-twitter"></i>
        </a>
      </div>
    </div>
  </div>
<?php
}
?>
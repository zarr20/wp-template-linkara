<?php
$faqs = [
  [
    'question' => 'Apa itu Linkara?',
    'answer' => 'Linkara adalah ruang khusus untuk para pemimpin Organisasi Masyarakat Sipil (OMS) di Indonesia untuk berdialog, refleksi, dan mengeksplorasi strategi baru.'
  ],
  [
    'question' => 'Siapa saja yang bisa bergabung dalam Linkara?',
    'answer' => 'Program ini ditujukan untuk para pemimpin dan aktivis organisasi masyarakat sipil yang ingin mengembangkan kepemimpinan transformatif.'
  ],
  [
    'question' => 'Apakah ini program pelatihan atau workshop?',
    'answer' => 'Linkara lebih dari sekadar workshop, ini adalah ruang eksperimen hidup untuk dialog partisipatif dan refleksi mendalam.'
  ],
  [
    'question' => 'Apakah program dari Linkara gratis?',
    'answer' => 'Detail biaya dan pendaftaran dapat dikonfirmasi langsung melalui kontak resmi Linkara.'
  ],
  [
    'question' => 'Di mana kegiatan Linkara berlangsung?',
    'answer' => 'Kegiatan Linkara dapat berlangsung secara offline maupun online, tergantung program spesifik yang sedang dijalankan.'
  ],
  [
    'question' => 'Apa manfaat yang bisa saya dapatkan dari mengikuti Linkara?',
    'answer' => 'Anda akan mendapatkan ruang refleksi, pengembangan kepemimpinan, jaringan kolaborasi, dan strategi menghadapi tantangan sosial.'
  ]
];
?>

<div
  x-data="{ openIndex: null }"
  class="bg-white">
  <div class="bg-yellow-500 py-8 px-4 md:px-12 relative">
    <div class="container mx-auto flex justify-between items-center">
      <h1 class="text-4xl font-bold text-black">FAQ</h1>
      <div class="absolute top-4 right-4 md:right-12">
        <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="25" cy="25" r="25" fill="white" fill-opacity="0.2" />
          <path d="M24.9999 15L32.3205 22.3205L24.9999 29.641L17.6794 22.3205L24.9999 15Z" fill="white" />
          <path d="M24.9999 35L32.3205 27.6795L24.9999 20.359L17.6794 27.6795L24.9999 35Z" fill="white" />
        </svg>
      </div>
    </div>
  </div>

  <div class="container mx-auto px-4 md:px-12 py-8">
    <div class="space-y-4">
      <?php foreach ($faqs as $index => $faq): ?>
        <div class="border-b border-gray-200 pb-4">
          <div
            @click="openIndex = (openIndex === <?= $index ?> ? null : <?= $index ?>)"
            class="flex justify-between items-center cursor-pointer">
            <h3 class="text-lg font-semibold"><?= htmlspecialchars($faq['question']) ?></h3>
            <svg
              x-show="openIndex === <?= $index ?>"
              class="transition-transform duration-300"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path d="M7 10L12 15L17 10" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <svg
              x-show="openIndex !== <?= $index ?>"
              class="transition-transform duration-300"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path d="M7 14L12 9L17 14" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </div>
          <div
            x-show="openIndex === <?= $index ?>"
            x-collapse
            class="mt-4 text-gray-600">
            <?= htmlspecialchars($faq['answer']) ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
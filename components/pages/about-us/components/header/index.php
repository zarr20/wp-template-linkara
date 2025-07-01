<div
  x-data="{ isOpen: false }"
  class="min-h-[500px] h-[100vh] relative bg-black">
  <img src="<?php echo get_template_directory_uri() ?>/assets/imgs/about-us-bg.png"
    class="absolute inset-0 w-full h-full object-cover object-center"
    alt="Header Background" />
  <div
    class="rounded-t-[80px] bg-[#F5F5FA] absolute bottom-0 w-full max-h-[80%] transition-all duration-300"
    :class="{ 'h-[200px]': !isOpen }">
    <div class="relative h-full">
      <div
        @click="isOpen = !isOpen"
        class="absolute right-[10%] -top-[35px] w-[60px] p-6 aspect-square bg-[#8C288C] rounded-full flex justify-center items-center cursor-pointer transition-transform z-10"
        :class="{ 'rotate-180': isOpen }">

        <div class="absolute p-6">
          <svg class="w-[20px] h-[20px]" width="23" height="13" viewBox="0 0 33 23" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M27.2248 22.222L32.5862 16.8606L16.4982 0.776367L0.410156 16.8606L5.77536 22.2258L16.4982 11.4992L27.2248 22.222Z" fill="#FDBF06" />
          </svg>

        </div>

      </div>

      <div class="container py-[49px] relative overflow-hidden h-full">
        <div class="overflow-hidden h-full"
          :class="{ 'overflow-auto': isOpen }">
          <h1 class=" text-3xl font-bold mb-4 text-[#8C288C]">Tentang Linkara</h1>
          <p>
            Di tengah tantangan yang makin kompleks, dari menyempitnya ruang gerak sipil, krisis lingkungan, hingga tekanan internal organisasi, Linkara hadir sebagai ruang yang dirancang khusus untuk para pemimpin Organisasi Masyarakat Sipil (OMS) di Indonesia. Terinspirasi dari bentuk lingkaran, simbol ruang tanpa ujung, tempat semua titik terhubung. Linkara menjadi tempat bagi para pemimpin untuk bisa berhenti sejenak dari rutinitas, saling melihat, mendengarkan, dan saling menguatkan.
          </p>
          <p>
            Linkara bukan sekadar forum diskusi. Linkara adalah eksperimen hidup yang membuka ruang untuk dialog partisipatif, refleksi mendalam, dan eksplorasi strategi baru dalam menjawab tantangan sosial, lingkungan, dan kebijakan yang kian mendesak. Di sini, setiap suara dihargai, setiap pengalaman menjadi bahan belajar, dan setiap pertemuan adalah peluang untuk merancang ulang praktik kepemimpinan yang lebih adaptif, inklusif, dan inovatif.
          </p>
          <p>
            Dengan semangat kolektif dan berbasis kepercayaan, Linkara mendorong para pemimpin untuk keluar dari isolasi, memperkuat ketahanan pribadi dan organisasi, serta membangun jaringan yang saling mendukung. Dari ruang ini, tumbuh komunitas pemimpin yang siap menghadapi masa depan penuh ketidakpastian dengan keberanian, kejernihan, dan kebersamaan yang kokoh.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
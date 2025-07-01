<div x-data="headerComponent()" class="bg-[#14A083] shadow">
  <div class="container mx-auto">
    <div class="flex justify-between items-center">
      <div class="flex justify-between items-center w-full">
        <div class="flex-shrink-0">
          <a href="#" class="text-xl font-bold text-white">Linkara</a>
        </div>
        <div class="hidden md:ml-6 md:flex space-x-4">
          <a href="<?php echo map_url("/home") ?>" class="text-white hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Home</a>
          <a href="<?php echo map_url("/about-us") ?>" class="text-white hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">About Us</a>
          <a href="<?php echo map_url("/contact-us") ?>" class="text-white hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Contact Us</a>
          <a href="<?php echo map_url("/library") ?>" class="text-white hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Library</a>
          <a href="<?php echo map_url("/program") ?>" class="text-white hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Program</a>
        </div>
      </div>

      <div class="flex items-center md:hidden z-20">
        <button @click="toggleMobileMenu" class="bg-gray-100 p-2 rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-gray-500">
          <span class="sr-only">Open menu</span>
          <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false"
    class="fixed bottom-0 left-0 right-0  z-30 transition-transform transform max-h-[50%] h-fit z-10"
    :class="mobileMenuOpen ? 'translate-y-0' : 'translate-y-full'">
    <div class="p-4 space-y-2 overflow-auto bg-[#14A083] shadow-lg rounded-t-[20px] h-full">
      <div class="h-full overflow-auto">
        <a href="<?php echo map_url("/home") ?>" class="text-white hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium">Home</a>
        <a href="<?php echo map_url("/about-us") ?>" class="text-white hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium">About Us</a>
        <a href="<?php echo map_url("/contact-us") ?>" class="text-white hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium">Contact Us</a>
      </div>
    </div>
  </div>

  <div x-show="mobileMenuOpen"
    class="fixed bottom-0 left-0 right-0 bg-[#000000b3] w-full h-full z-10">
  </div>
</div>

<script>
  function headerComponent() {
    return {
      mobileMenuOpen: false,
      dropdownOpen: false,
      toggleMobileMenu() {
        console.log("Toggling mobile menu");
        this.mobileMenuOpen = !this.mobileMenuOpen;
      }
    }
  }
</script>
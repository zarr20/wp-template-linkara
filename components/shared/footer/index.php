<footer class="bg-gray-100">
  <div class="container py-[48px]">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-gray-700">
      <!-- Column 1 -->
      <div>
        <div class="flex items-center mb-4">
          <div class="bg-gray-900 rounded-full w-6 h-6 mr-3"></div>
          <span class="font-semibold">Linkara</span>
        </div>
        <p class="text-sm leading-relaxed max-w-xs">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus quis nunc imperdiet, tempor velit non, sagittis neque. In dignissim convallis urna, at placerat orci maximus ut. Integer sit amet justo vel augue ultrices semper et vitae metus
        </p>
      </div>

      <!-- Column 2: Contact -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div>
          <h3 class="text-yellow-400 font-semibold mb-4">Contact</h3>
          <ul class="space-y-2 text-sm">
            <li class="flex items-center space-x-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 12H8m8 4H8m8-8H8m-2 4h.01M12 20H6a2 2 0 01-2-2v-6h12v6a2 2 0 01-2 2z" />
              </svg>
              <span>Email@gmail.com</span>
            </li>
            <li class="flex items-center space-x-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="currentColor" viewBox="0 0 24 24" stroke="none">
                <path d="M20.487 17.14a16.04 16.04 0 01-12.3-12.3l-2.785 2.784A1.983 1.983 0 005.517 10L6.92 11.403a1.97 1.97 0 001.878.525l2.388-.597a1.94 1.94 0 011.359.45l2.35 2.35a1.917 1.917 0 01.45 1.352l-.607 2.354a1.967 1.967 0 00.526 1.874l1.417 1.42a1.98 1.98 0 002.66 0l2.784-2.785z" />
              </svg>
              <span>01234567890</span>
            </li>
            <li class="flex items-center space-x-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5h2l3.6 7.59a1 1 0 01-.12 1.07l-1.38 1.38a11.037 11.037 0 005.56 5.56l1.38-1.38a1 1 0 011.07-.12L19 19v2a2 2 0 01-2 2h-2a16 16 0 01-12-12V7a2 2 0 012-2z" />
              </svg>
              <span>01234567890</span>
            </li>
          </ul>
        </div>

        <!-- Column 3: Social -->
        <div>
          <h3 class="text-yellow-400 font-semibold mb-4">Social</h3>
          <ul class="space-y-2 text-sm">
            <li><a href="#" class="hover:underline">Twitter</a></li>
            <li><a href="#" class="hover:underline">LinkedIn</a></li>
            <li><a href="#" class="hover:underline">Facebook</a></li>
          </ul>
        </div>

        <!-- Column 4: Legal -->
        <div>
          <h3 class="text-yellow-400 font-semibold mb-4">Legal</h3>
          <ul class="space-y-2 text-sm">
            <li><a href="#" class="hover:underline">Terms</a></li>
            <li><a href="#" class="hover:underline">Privacy</a></li>
            <li><a href="#" class="hover:underline">Cookies</a></li>
            <li><a href="#" class="hover:underline">Licenses</a></li>
            <li><a href="#" class="hover:underline">Settings</a></li>
            <li><a href="#" class="hover:underline">Contact</a></li>
          </ul>
        </div>
      </div>
    </div>

  </div>
  <div class="bg-[#14A083] text-white text-xs py-[28px]">
    <div class="container">
      <p>© <?php echo date('Y') == "2025" ? date('Y') : "2025 - " . date('Y'); ?> Linkara All rights reserved.</p>
    </div>
  </div>

</footer>
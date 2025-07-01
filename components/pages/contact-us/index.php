<div class="bg-gray-50 flex items-center justify-center py-5">
  <div class="container flex flex-col md:grid grid-cols-1 md:grid-cols-3 gap-10">

    <div class="bg-purple-700 text-white rounded-xl p-8 shadow-lg w-full">
      <h2 class="text-lg font-semibold mb-2 text-center">Leave a Message</h2>
      <p class="text-sm mb-6 text-center">lorem ipsum dolor sit amet, consectetur adipisicing elit.<br> Sed ultricies ac ex et tincidunt</p>

      <form class="space-y-4" action="#" method="post">
        <div>
          <label for="name" class="block mb-1 text-sm font-medium">Nama*</label>
          <input type="text" id="name" name="name" required
            class="w-full rounded-md border border-purple-500 bg-purple-600 px-3 py-2 placeholder-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-300" />
        </div>
        <div>
          <label for="email" class="block mb-1 text-sm font-medium">Email*</label>
          <input type="email" id="email" name="email" required
            class="w-full rounded-md border border-purple-500 bg-purple-600 px-3 py-2 placeholder-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-300" />
        </div>
        <div>
          <label for="tel" class="block mb-1 text-sm font-medium">Telephone Number*</label>
          <input type="tel" id="tel" name="telephone" required
            class="w-full rounded-md border border-purple-500 bg-purple-600 px-3 py-2 placeholder-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-300" />
        </div>
        <div>
          <label for="message" class="block mb-1 text-sm font-medium">Message</label>
          <textarea id="message" name="message" rows="4"
            class="w-full rounded-md border border-purple-500 bg-purple-600 px-3 py-2 placeholder-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-300"></textarea>
        </div>

        <button type="submit" class="w-full bg-white text-purple-700 font-bold py-2 rounded-md hover:bg-gray-100 transition">
          Submit
        </button>
      </form>
    </div>

    <div
      class="rounded-xl shadow-lg overflow-hidden col-span-2 relative "
      style="min-height: 400px;"
      x-data="{ loading: true }">
      <div x-show="loading">
        <div
          class="absolute h-full w-full flex items-center justify-center z-20 bg-white">
          <svg class="animate-spin h-10 w-10 text-purple-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
          </svg>
        </div>
      </div>
      <div x-show="!loading">
        <iframe
          class="absolute w-full h-full"
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.4601761794136!2d115.24676471468291!3d-8.72714049491253!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd231da5a7ee3c1%3A0x32c290ef1b4f5ffa!2sRumah%20Makan%20Babi%20Guling%20Karya%20Rebo!5e0!3m2!1sid!2sid!4v1686497396649!5m2!1sid!2sid"
          style="border:0;"
          allowfullscreen=""
          referrerpolicy="no-referrer-when-downgrade"
          @load="setTimeout(() => loading = false, 5000)">
        </iframe>
      </div>
    </div>


  </div>
</div>
<div class="bg-[#000000b3] backdrop-blur-sm h-screen w-full fixed flex justify-center items-center z-[100] top-0 left-0">
    <div class="container max-w-[500px] p-4">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4">${data.status}</h2>
            <p class="text-gray-700 mb-4">${data.message}</p>
            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600" onclick="this.parentElement.parentElement.parentElement.remove()">Got It</button>
        </div>
    </div>
</div>


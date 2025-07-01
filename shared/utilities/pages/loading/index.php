<div class="loading-overlay" id="loading-overlay">
    <div>
        <svg class="animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle style="opacity: 25%;" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path style="opacity: 75%;" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
        </svg>
    </div>
</div>


<?php RenderStyle::start() ?>
<style>
    /* Loading overlay penuh halaman */
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        font-family: Arial, sans-serif;
        color: white;
    }

    /* Animasi spin */
    .animate-spin {
        animation: spin 1s linear infinite;
        transition: width 0.5s ease-in-out, height 0.5s ease-in-out;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* Spinner svg size & color */
    svg {
        height: 40px;
        width: 40px;
        color: #7c3aed;
        /* warna ungu medium */
    }

    .loading-message {
        position: absolute;
        bottom: 20px;
        text-align: center;
        font-size: 18px;
        padding: 10px;
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 5px;
        color: black;
    }
</style>

<?php RenderStyle::end() ?>
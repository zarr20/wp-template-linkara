<?php MinifyHtml::startMinifyHTML(); ?>
<?php
run_render_lazy_load_image();
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index, follow">

    <title>
        <?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?>
    </title>

    <link rel="preconnect" href="https://www.google.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>

    <!-- <script src="https://cdn.jsdelivr.net/npm/alpinejs"></script> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> -->

    <?php wp_head(); ?>

    <style>
        #wpadminbar {
            display: none;
        }
    </style>
</head>

<body>
    <div id="root" style="display: none;">
        <?php include base_path("components/shared/header/index.php"); ?>
        <?= $child_content; ?>
        <?php include base_path("components/shared/footer/index.php"); ?>
    </div>
    <?php include get_template_directory() . "/shared/utilities/pages/loading/index.php"; ?>
    <?php include get_template_directory() . "/shared/utilities/alert/index.php"; ?>

    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
        integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous" defer></script>


    <?php RenderStyle::start(); ?>
    <style>
        .lazy-load {
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .lazy-load.loading {
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .lazy-load.loaded {
            opacity: 1;
            transition: opacity 1s ease-in-out;
        }

        .g-recaptcha {
            visibility: hidden;
            position: absolute;
            width: 0;
            height: 0;
        }

        .cursor-fill-button {
            position: relative;
            padding: 15px 30px;
            font-size: 1.2rem;
            font-weight: bold;
            color: #20252F;
            background-color: #ffffff;
            border-radius: 8px;
            cursor: pointer;
            overflow: hidden;
            transition: color 0.3s ease;
        }

        .cursor-fill-button:hover {
            color: #ffffff;
        }

        .cursor-fill {
            content: "";
            position: absolute;
            left: var(--cursorX, 50%);
            top: var(--cursorY, 50%);
            width: 300px;
            height: 300px;
            background: black;
            border-radius: 50%;
            transform: translate(-50%, -50%) scale(0);
            transition: transform 0.2s ease;
            z-index: 1;

        }

        .cursor-fill-button:hover .cursor-fill {
            transform: translate(-50%, -50%) scale(2);
        }

        .button-label {
            position: relative;
            z-index: 2;
        }
    </style>
    <?php RenderStyle::end(); ?>

    <style>
        <?php RenderStyle::PrintStyles(); ?>
    </style>

    <?php include get_template_directory() . "/shared/layout/main-layout/script-handler/index.php"; ?>

    <?php wp_footer(); ?>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>

</html>

<?php MinifyHtml::endMinifyHTML(); ?>

<!-- 
Website Developed by Hijrstudio.com
Developer: Dzarr al ghifari 
Instagram: https://www.instagram.com/zarr20
LinkedIn: https://www.linkedin.com/in/dzarr-al-ghifari-371a491a8/
GitHub: https://github.com/zarr20 
-->
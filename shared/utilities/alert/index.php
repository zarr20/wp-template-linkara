<?php

$escapedContent = getAndEscapeIncludedContent(__DIR__ . '/element.php');

?>

<?php RenderJS::start() ?>
<script>
    var ZarrAlert = (function() {
        function showAlert(data) {
            var alertElement = <?php echo json_encode($escapedContent); ?>;
            alertElement = alertElement
                .replace(/\$\{data\.status\}/g, data.status)
                .replace(/\$\{data\.message\}/g, data.message);

            document.body.insertAdjacentHTML('beforeend', alertElement);
        }

        return {
            show: showAlert
        };
    })();


</script>
<?php RenderJS::end() ?>
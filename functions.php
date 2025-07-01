<?php
require_once 'api/routes.php';
require_once 'lib/init.php';
require_once 'helper/index.php';
require_once 'shared/utilities/section-wrapper/index.php';


if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'menu_title' => 'Site Settings',
        'menu_slug' => 'site-settings',
        'capability' => 'edit_posts',
        'redirect' => true
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Site Settings',
        'menu_title' => 'Site Setting',
        'menu_slug' => 'header-settings',
        'parent_slug' => 'site-settings',
        'show_in_graphql' => true,
    ));
}

function map_url($slug)
{
    if (function_exists('pll_current_language')) {
        return get_the_permalink(pll_get_post(get_page_by_path($slug)->ID));
    }
    return get_page_by_path($slug) ? get_the_permalink(get_page_by_path($slug)->ID) : "#";
}

add_theme_support('post-thumbnails');


function custom_rewrite_rules()
{
    add_rewrite_rule(
        '^([^/]+)/?$',
        'index.php?pagename=$matches[1]',
        'top'
    );
    add_rewrite_rule(
        '^portfolios/([^/]+)/?$',
        'index.php?post_type=portfolio&name=$matches[1]',
        'top'
    );
    add_rewrite_rule(
        '^blog/([^/]+)/?$',
        'index.php?post_type=blog&name=$matches[1]',
        'top'
    );
}
add_action('init', 'custom_rewrite_rules');

function custom_plugin_activation()
{
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'custom_plugin_activation');


function getAndEscapeIncludedContent(string $filePath): string
{
    if (!ob_start()) {
        throw new RuntimeException("Failed to start output buffer");
    }

    try {
        include $filePath;
    } finally {
        $content = ob_get_clean();
    }

    return ($content);
}


remove_action('wp_ajax_some_action', 'some_callback_function');
remove_action('wp_ajax_nopriv_some_action', 'some_callback_function');

if (!class_exists('ACF_Bootstrap_Icon_Field')) :

    class ACF_Bootstrap_Icon_Field extends acf_field
    {

        // Constructor  
        public function __construct()
        {
            $this->name = 'bootstrap_icon_picker';
            $this->label = __('Bootstrap Icon Picker', 'acf');
            $this->category = 'choice';
            parent::__construct();
        }

        // Render field input (tampilan di admin)  
        public function render_field($field)
        {
            // Daftar icon Bootstrap (bisa kamu perluas)  
            $icons = array(
                'bi-facebook' => 'Facebook',
                'bi-twitter' => 'Twitter',
                'bi-instagram' => 'Instagram',
                'bi-linkedin' => 'LinkedIn',
                'bi-youtube' => 'YouTube',
                'bi-pinterest' => 'Pinterest',
                'bi-twitch' => 'Twitch',
                'bi-telegram' => 'Telegram',
                'bi-whatsapp' => 'WhatsApp',
                'bi-reddit' => 'Reddit',
                'bi-discord' => 'Discord',
                'bi-tiktok' => 'TikTok',
                'bi-snapchat' => 'Snapchat',
            );

            // Nilai tersimpan  
            $value = $field['value'];

            // Container untuk icon picker dan hidden input  
?>
            <style>
                .acf-bootstrap-icon-picker {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 8px;
                }

                .acf-bootstrap-icon-picker .icon-item {
                    width: 40px;
                    height: 40px;
                    border: 2px solid transparent;
                    border-radius: 6px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    cursor: pointer;
                    font-size: 24px;
                    color: #666;
                    transition: border-color 0.3s, color 0.3s;
                }

                .acf-bootstrap-icon-picker .icon-item.selected {
                    border-color: #0073aa;
                    color: #0073aa;
                }

                .acf-bootstrap-icon-picker .icon-item:hover {
                    border-color: #00a0d2;
                    color: #00a0d2;
                }
            </style>

            <input type="hidden" name="<?php echo esc_attr($field['name']); ?>" value="<?php echo esc_attr($value); ?>" />
            <div class="acf-bootstrap-icon-picker" id="<?php echo esc_attr($field['id']); ?>">
                <?php foreach ($icons as $class => $label) :
                    $selected_class = ($class === $value) ? 'selected' : '';
                ?>
                    <div class="icon-item <?php echo esc_attr($selected_class); ?>" data-icon="<?php echo esc_attr($class); ?>" title="<?php echo esc_attr($label); ?>">
                        <i class="<?php echo esc_attr($class); ?>"></i>
                    </div>
                <?php endforeach; ?>
            </div>

            <script>
                (function() {
                    const container = document.getElementById('<?php echo esc_js($field['id']); ?>');
                    const hiddenInput = container.previousElementSibling;
                    const icons = container.querySelectorAll('.icon-item');

                    icons.forEach(icon => {
                        icon.addEventListener('click', () => {
                            // hapus kelas selected dari semua  
                            icons.forEach(i => i.classList.remove('selected'));
                            // tambah kelas selected ke yang diklik  
                            icon.classList.add('selected');
                            // update value input hidden  
                            hiddenInput.value = icon.getAttribute('data-icon');
                            // trigger event change supaya ACF tahu ada perubahan  
                            hiddenInput.dispatchEvent(new Event('change'));
                        });
                    });
                })();
            </script>
<?php
        }

        // Enqueue Bootstrap Icons CSS hanya di halaman admin field ini tampil  
        public function input_admin_enqueue_scripts()
        {
            wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css');
        }
    }

    // Daftarkan field custom ke ACF  
    add_action('acf/include_field_types', function () {
        new ACF_Bootstrap_Icon_Field();
    });

endif;

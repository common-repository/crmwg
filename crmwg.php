<?php
/*
  Plugin Name: CRM.WG
  Plugin URI:
  Description: Вставляет код сервиса CRM.WG  на ваш сайт
  Version: 1.0
  Author: WidgetGen
  Author URI:https://widgetgen.com/crm-dlya-landing-page/
  License: GPLv2 or later

 */

// Add settings page and register settings with WordPress
add_action('admin_menu', 'crmwg_setup');

function crmwg_setup()
{
    add_submenu_page('options-general.php', 'Страница вставки кода CRM.WG', 'CRM.WG Plugin', 'manage_options', 'options-crmwg', 'crmwg_settings');

    register_setting('crmwg', 'crmwg-code');
}



// Add settings link
function plugin_settings_link($links) { 
	$settings_link = '<a href="options-general.php?page=options-crmwg">Настройки</a>'; 
	array_unshift( $links, $settings_link ); 
	return $links; 
}

$plugin_file = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin_file", 'plugin_settings_link' );





// Display settings page
function crmwg_settings()
{
    ?>
    <div id="fb-root"></div>
    <div class="wrap">
        <h2>Страница вставки кода CRM.WG</h2>

        <div class="shfs-wrap" style="width: auto; float: left; margin-right: 2rem;">
            <?php
            echo "<form action=\"options.php\" method=\"POST\">";
            settings_fields('crmwg');
            do_settings_sections('crmwg');
            echo "<textarea cols=\"80\" rows=\"15\" name=\"crmwg-code\">" . esc_attr(get_option('crmwg-code')) . "</textarea>";
            submit_button();
            echo "</form>";
            ?>
        </div>
        <div class="shfs-sidebar" style="max-width: 270px;float: left;text-align:center;">
            <div>
                <img src="<?php echo plugin_dir_url(__FILE__); ?>images/wg_logo.png" alt="WidgetGEN logo"  style="width: 160px;" />
            </div>
            <div class="shfs-improve-site" style="padding: 1rem;">
                <h2>Улучшите свой сайт!</h2>
                <p>Хотите автоматизировать управление работы с клиентами?</p>
                <p><a href="https://widgetgen.com/crm-dlya-landing-page/" target="_blank">О сервисе</a> |
                    <a href="https://widgetgen.com/crm-dlya-landing-page/modules/" target="_blank">Модули</a></p>
                <p><a href="http://account.widgetgen.com/ru/register" class="button" target="_blank">Бесплатная регистрация</a></p>
            </div>
            <div class="shfs-follow">
                <div class="fb-like" data-href="https://www.facebook.com/widgetgen" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
            </div>
            <div class="shfs-support" style="padding: 1rem;">
                <h2>Нужна помощь?</h2>
                <p><strong><a href="https://widgetgen.com/kontakty/" target="_blank">Напишите нам</a></p>
            </div>
        </div>

        <script>(function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=1765709683672685";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>


    </div>


    <?php
}

// Add the code to footer
add_action('wp_footer', 'add_crmwg_code');

function add_crmwg_code()
{
    echo get_option('crmwg-code');
}

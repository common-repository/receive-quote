<?php
/*
  Plugin Name: Receive quote by Kedar Jangir
  Plugin URI: http://kjcreativeeye.com/wordpressplugins
  Description: Calculate cost as per your request
  Version: 1.0.0
  Author: Kedar Jangir
  Author URI: http://kjcreativeeye.com/about-me/
  License: GPLv2 or later
 */



add_filter('post_row_actions', 'kjeye_remove_row_actions', 10, 2);

function kjeye_remove_row_actions($actions, $post) {
    global $current_screen;
    if ($current_screen->post_type == 'quotes') {
        unset($actions['edit']);
        unset($actions['view']);
        unset($actions['trash']);
        unset($actions['inline hide-if-no-js']);        
    }
    return $actions;
}

add_action('views_edit-quotes', 'kjeye_remove_views');

add_action('wp_trash_post', 'kjeye_disable_trash');
add_action('before_delete_post', 'kjeye_disable_trash');

function kjeye_disable_trash($post_id) {
    global $post_type;

    if (in_array($post_type, array('quotes'))) {
        wp_die(__('You are not allowed to trash payments or transactions.', 'xxx'));
    }
}

add_action('wp_ajax_quote_action', 'kjeye_quote_action_func');
add_action('wp_ajax_nopriv_quote_action', 'kjeye_quote_action_func');

function kjeye_quote_action_func() {
    global $wpdb; // this is how you get access to the database
    $custom_handle = intval($_POST['custom_handle']);
    $custom_handle2 = intval($_POST['custom_handle']);
    $human_test1 = sanitize_text_field($_POST['human_test1']);
    $human_test2 = sanitize_text_field($_POST['human_test2']);
    $human_test3 = sanitize_text_field($_POST['human_test3']);
    $dog_test1 = sanitize_text_field($_POST['dog_test1']);
    $dog_test2 = sanitize_text_field($_POST['dog_test2']);
    $Cow = sanitize_text_field($_POST['Cow']);
    $Bird = sanitize_text_field($_POST['Bird']);
    $Ruminant = sanitize_text_field($_POST['Ruminant']);
    $general_bacteroids = sanitize_text_field($_POST['general_bacteroids']);
    $goose_test1 = sanitize_text_field($_POST['goose_test1']);
    $goose_test2 = sanitize_text_field($_POST['goose_test2']);
    $Gull = sanitize_text_field($_POST['Gull']);
    $Hourse = sanitize_text_field($_POST['Hourse']);
    $Pig = sanitize_text_field($_POST['Pig']);
    $Chicken = sanitize_text_field($_POST['Chicken']);
    $Elk = sanitize_text_field($_POST['Elk']);
    $contact_name = sanitize_text_field($_POST['contact_name']);
    $email = sanitize_email($_POST['email']);
    $timeline = sanitize_text_field($_POST['timeline']);
    $number = sanitize_text_field($_POST['number']);

    $third_option = '';
    $third_count = 0;

    if ($human_test1 == 'true') {
        $third_option .= 'Human Test 1,';
        $third_count += 1;
    }
    if ($human_test2 == 'true') {
        $third_option .= ' Human Test 2,';
        $third_count += 1;
    }
    if ($human_test3 == 'true') {
        $third_option .= ' Human Test 3,';
        $third_count += 1;
    }
    if ($dog_test1 == 'true') {
        $third_option .= ' DOG Test 1,';
        $third_count += 1;
    }
    if ($dog_test2 == 'true') {
        $third_option .= ' DOG Test 2,';
        $third_count += 1;
    }
    if ($Cow == 'true') {
        $third_option .= ' Cow,';
        $third_count += 1;
    }
    if ($Bird == 'true') {
        $third_option .= ' Bird,';
        $third_count += 1;
    }
    if ($Ruminant == 'true') {
        $third_option .= ' Ruminant,';
        $third_count += 1;
    }
    if ($general_bacteroids == 'true') {
        $third_option .= ' General Bacteroids,';
        $third_count += 1;
    }
    if ($goose_test1 == 'true') {
        $third_option .= ' Goose Test1,';
        $third_count += 1;
    }
    if ($goose_test2 == 'true') {
        $third_option .= ' Goose Test2,';
        $third_count += 1;
    }
    if ($Hourse == 'true') {
        $third_option .= ' Hourse,';
        $third_count += 1;
    }
    if ($Pig == 'true') {
        $third_option .= ' Pig,';
        $third_count += 1;
    }
    if ($Chicken == 'true') {
        $third_option .= ' Chicken,';
        $third_count += 1;
    }
    if ($Elk == 'true') {
        $third_option .= '  Elk,';
        $third_count += 1;
    }

    $html = '<table>';
    $html .= '<tr>';
    $html .= '<td>';
    $html .= 'How many sites will you sample from?';
    $html .= '</td>';
    $html .= '<td>';
    $html .= $custom_handle;
    $html .= '</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td>';
    $html .= 'How many times will you collect samples?';
    $html .= '</td>';
    $html .= '<td>';
    $html .= $custom_handle2;
    $html .= '</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td>';
    $html .= 'What sources do you want to focus on?';
    $html .= '</td>';
    $html .= '<td>';
    $html .= $third_option;
    $html .= '</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td>';
    $html .= 'contact_name';
    $html .= '</td>';
    $html .= '<td>';
    $html .= $contact_name;
    $html .= '</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td>';
    $html .= 'Email address';
    $html .= '</td>';
    $html .= '<td>';
    $html .= $email;
    $html .= '</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td>';
    $html .= 'Timeline';
    $html .= '</td>';
    $html .= '<td>';
    $html .= $timeline;
    $html .= '</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td>';
    $html .= 'Phone Number';
    $html .= '</td>';
    $html .= '<td>';
    $html .= $number;
    $html .= '</td>';
    $html .= '</tr>';
    $html .= '</table>';

    $test_id = wp_insert_post(
            array(
                'post_title' => "Quote Received: " . $contact_name,
                'post_type' => 'quotes',
                'post_content' => $html,
                'post_status' => 'publish',
                'comment_status' => 'closed', // if you prefer
                'ping_status' => 'closed',
            )
    );

    $to = 'info@sourcemolecular.com';
    $subject = 'Quote Received '.$contact_name;
    $body = $html;
    $headers = array('Content-Type: text/html; charset=UTF-8');

    wp_mail($to, $subject, $body, $headers);

    $total_number_of_tests = $custom_handle * $custom_handle2 * $third_count;

    $price_per_test = 0;
    if ($total_number_of_tests == 1) {
        $price_per_test = '415';
    } else if ($total_number_of_tests == 2) {
        $price_per_test = '315';
    } else if ($total_number_of_tests == 3) {
        $price_per_test = '265';
    } else if ($total_number_of_tests > 3) {
        $price_per_test = '215';
    }

    $total_cost = $total_number_of_tests * $price_per_test;

    $discounted_price = 0;

    if ($total_cost <= 10000) {
        $discounted_price = $total_cost;
    } else if ($total_cost > 10000) {
        $discounted_price = $total_cost - ($total_cost * 0.85);
    } else if ($total_cost > 20000) {
        $discounted_price = $total_cost - ($total_cost * 0.80);
    } else if ($total_cost > 30000) {
        $discounted_price = $total_cost - ($total_cost * 0.75);
    } else if ($total_cost > 40000) {
        $discounted_price = $total_cost - ($total_cost * 0.70);
    } else if ($total_cost > 50000) {
        $discounted_price = $total_cost - ($total_cost * 0.65);
    }

    $price = [
        'total_number_of_tests' => $total_number_of_tests,
        'price_per_test' => $price_per_test,
        'total_cost' => $total_cost,
        'discounted_price' => $discounted_price,
    ];

    $return_html = '';
    $return_html .= '<h1>Quote</h1>';
    $return_html .= '<table>';
    $return_html .= '<tr>';
    $return_html .= '<td>Total number of tests</td>';
    $return_html .= '<td>' . $total_number_of_tests . '</td>';
    $return_html .= '</tr>';
    $return_html .= '<tr>';
    $return_html .= '<td>Price Per Test </td>';
    $return_html .= '<td>' . $price_per_test . '</td>';
    $return_html .= '</tr>';
    $return_html .= '<tr>';
    $return_html .= '<td>Total Cost </td>';
    $return_html .= '<td>' . $total_cost . '</td>';
    $return_html .= '</tr>';
    $return_html .= '<tr>';
    $return_html .= '<td>Discounted Price</td>';
    $return_html .= '<td>' . $discounted_price . '</td>';
    $return_html .= '</tr>';
    $return_html .= '</table>';

    echo $return_html;

    wp_die(); // this is required to terminate immediately and return a proper response
}

function kjeye_create_post_type() {
    register_post_type('quotes', array(
        'labels' => array(
            'name' => __('Quotes'),
            'singular_name' => __('Quote')
        ),
        'public' => true,
        'has_archive' => true,
        'capabilities' => array(
            'create_posts' => false, // Removes support for the "Add New" function ( use 'do_not_allow' instead of false for multisite set ups )          
        ),
        "map_meta_cap" => true,
            )
    );
}

add_action('init', 'kjeye_create_post_type');


add_shortcode('receive_quote', 'kjeye_receive_quote_func');

function kjeye_receive_quote_func() {
    ob_start();
    ?>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">      
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style>
        #custom-handle {
            width: 3em;
            height: 1.6em;
            top: 50%;
            margin-top: -.8em;
            text-align: center;
            line-height: 1.6em;
        }
        #custom-handle2 {
            width: 3em;
            height: 1.6em;
            top: 50%;
            margin-top: -.8em;
            text-align: center;
            line-height: 1.6em;
        }
        .quote_wrapper {
            width: 100%;
            padding: 20px;
            border: 1px solid #ececec;
        }
        .quote_wrapper p{
            font-size: 15px;
            font-style: italic;
        }
        .input_wrapper {
            padding: 15px;
        }
        .quote_result{
            padding: 10px;
            border: 1px solid #ececec;
        }
    </style>
    <script>

        var custom_handle;
        var custom_handle2;

        jQuery(function ($) {
            var handle = $("#custom-handle");
            $("#slider").slider({
                create: function () {
                    handle.text($(this).slider("value"));
                },
                slide: function (event, ui) {
                    handle.text(ui.value);
                    custom_handle = ui.value;
                }
            });
        });
        jQuery(function ($) {
            var handle = $("#custom-handle2");
            $("#slider2").slider({
                create: function () {
                    handle.text($(this).slider("value"));
                    custom_handle2 = $(this).slider("value")
                },
                slide: function (event, ui) {
                    handle.text(ui.value);
                    custom_handle2 = ui.value;
                }
            });
        });
    </script>
    <div class="quote_wrapper">
        <form action="" name="quote_form" method="post">
            <div class="input_wrapper">
                <label for="custom-handle">How many sites will you sample from?</label>
                <p>Thoughtful sample site selection can enhance the project outcome.</p>
                <div id="slider">
                    <div id="custom-handle" class="ui-slider-handle"></div>
                </div>
            </div>
            <div class="input_wrapper">
                <label for="custom-handle2">How many times will you collect samples?</label>
                <p>Increased sampling events is a powerful process that can increase project accuracy greatly!</p>
                <div id="slider2">
                    <div id="custom-handle2" class="ui-slider-handle"></div>
                </div>
            </div>
            <div class="input_wrapper">
                <label for="sites_sample">What sources do you want to focus on?</label>
                <p>Clients benefit from selecting high priority and most likely sources first.Samples are archived for 90 days and Selecting 2 tests per host increases confidence in the result.</p>
                <table>
                    <tr>
                        <td colspan="3">
                            <strong>Human</strong>
                        </td>
                        <td colspan="2"> 
                            <strong>Dog</strong>
                        </td>
                        <td>
                            <strong>Cow</strong>
                        </td>
                        <td>
                            <strong>Bird</strong>
                        </td>
                        <td>
                            <strong>Ruminant</strong>
                        </td>
                        <td>
                            <strong>General Bacteroides</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>Test 1</td>
                        <td>Test 2</td>
                        <td>Test 3</td>
                        <td>Test 1</td>
                        <td>Test 2</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="test1" value="human_test1" id="human_test1" class="quote_form"></td>
                        <td><input type="checkbox" name="test1" value="human_test2" id="human_test2" class="quote_form"></td>
                        <td><input type="checkbox" name="test1" value="human_test3" id="human_test3" class="quote_form"></td>
                        <td><input type="checkbox" name="test1" value="dog_test1" id="dog_test1" class="quote_form"></td>
                        <td><input type="checkbox" name="test1" value="dog_test2" id="dog_test2" class="quote_form"></td>
                        <td><input type="checkbox" name="test1" value="Cow" id="Cow" class="quote_form"></td>
                        <td><input type="checkbox" name="test1" value="Bird" id="Bird" class="quote_form"></td>
                        <td><input type="checkbox" name="test1" value="Ruminant" id="Ruminant" class="quote_form"></td>
                        <td><input type="checkbox" name="test1" value="general_bacteroids" id="general_bacteroids" class="quote_form"></td>                        
                    </tr>
                </table>
                <table>
                    <tr>
                        <td colspan="2"><strong>Goose</strong></td>
                        <td><strong>Gull</strong></td>
                        <td><strong>Horse</strong></td>
                        <td><strong>Pig</strong></td>
                        <td><strong>Chicken</strong></td>
                        <td><strong>Elk</strong></td>
                    </tr>
                    <tr>
                        <td>Test 1</td>
                        <td>Test 2</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="test1" value="goose_test1" id="goose_test1" class="quote_form"></td>
                        <td><input type="checkbox" name="test1" value="goose_test2" id="goose_test2" class="quote_form"></td>
                        <td><input type="checkbox" name="test1" value="Gull" id="Gull" class="quote_form"></td>
                        <td><input type="checkbox" name="test1" value="Hourse" id="Hourse" class="quote_form"></td>
                        <td><input type="checkbox" name="test1" value="Pig" id="Pig" class="quote_form"></td>
                        <td><input type="checkbox" name="test1" value="Chicken" id="Chicken" class="quote_form"></td>
                        <td><input type="checkbox" name="test1" value="Elk" id="Elk" class="quote_form"></td>                        
                    </tr>
                </table>
    <!--                <strong>Human</strong>
                <input type="checkbox" name="test1" value="human_test1" id="human_test1" class="quote_form">Test 1
                <input type="checkbox" name="test1" value="human_test2" id="human_test2" class="quote_form">Test 2
                <input type="checkbox" name="test1" value="human_test3" id="human_test3" class="quote_form">Test 3
                <br>
                <strong>Dog</strong>
                <input type="checkbox" name="test1" value="dog_test1" id="dog_test1" class="quote_form">Test 1
                <input type="checkbox" name="test1" value="dog_test2" id="dog_test2" class="quote_form">Test 2
                <br>
                <strong>Cow</strong>
                <input type="checkbox" name="test1" value="Cow" id="Cow" class="quote_form">
                <strong>Bird</strong>
                <input type="checkbox" name="test1" value="Bird" id="Bird" class="quote_form">
                <strong>Ruminant</strong>
                <input type="checkbox" name="test1" value="Ruminant" id="Ruminant" class="quote_form">
                <strong>General Bacteroides</strong>
                <input type="checkbox" name="test1" value="general_bacteroids" id="general_bacteroids" class="quote_form">
                <br>
                <strong>Goose</strong>
                <input type="checkbox" name="test1" value="goose_test1" id="goose_test1" class="quote_form">Test 1
                <input type="checkbox" name="test1" value="goose_test2" id="goose_test2" class="quote_form">Test 2
                <br>
                <strong>Gull</strong>
                <input type="checkbox" name="test1" value="Gull" id="Gull" class="quote_form">
                <strong>Hourse</strong>
                <input type="checkbox" name="test1" value="Hourse" id="Hourse" class="quote_form">
                <strong>Pig</strong>
                <input type="checkbox" name="test1" value="Pig" id="Pig" class="quote_form">
                <strong>Chicken</strong>
                <input type="checkbox" name="test1" value="Chicken" id="Chicken" class="quote_form">
                <strong>Elk</strong>
                <input type="checkbox" name="test1" value="Elk" id="Elk" class="quote_form">                -->
            </div>
            <h2>Contact Information</h2>
            <div class="input_wrapper">
                <label for="contact_name">Name</label>
                <input type="text" name="contact_name" id="contact_name">
            </div>
            <div class="input_wrapper">
                <label for="email">Email address</label>
                <input type="email" name="email" id="email">
            </div>
            <div class="input_wrapper">
                <label for="number">Phone number</label>
                <input type="text" name="number" id="number">
            </div>
            <div class="input_wrapper">
                <label for="timeline">Project Timeline</label>
                <input type="text" name="timeline" id="timeline">
            </div>
            <div class="input_wrapper">
                <input type="submit" value="Receive Quote" name="quote">
            </div>
        </form>
        <script>
            jQuery(document).ready(function (event) {
                jQuery('form[name=quote_form]').submit(function (event) {

                    var is_checked_q = false
                    jQuery(".quote_form").each(function (i, o) {
                        var m = jQuery(o).prop('checked');
                        if (m == true) {
                            is_checked_q = true;
                        }
                    })

                    if (is_checked_q == true) {
                        console.log(custom_handle);
                        console.log(custom_handle2);
                        var human_test1 = jQuery("#human_test1").is(':checked');
                        var human_test2 = jQuery("#human_test2").is(':checked');
                        var human_test3 = jQuery("#human_test3").is(':checked');
                        var dog_test1 = jQuery("#dog_test1").is(':checked');
                        var dog_test2 = jQuery("#dog_test2").is(':checked');
                        var Cow = jQuery("#Cow").is(':checked');
                        var Bird = jQuery("#Bird").is(':checked');
                        var Ruminant = jQuery("#Ruminant").is(':checked');
                        var general_bacteroids = jQuery("#general_bacteroids").is(':checked');
                        var goose_test1 = jQuery("#goose_test1").is(':checked');
                        var goose_test2 = jQuery("#goose_test2").is(':checked');
                        var Gull = jQuery("#Gull").is(':checked');
                        var Hourse = jQuery("#Hourse").is(':checked');
                        var Pig = jQuery("#Pig").is(':checked');
                        var Chicken = jQuery("#Chicken").is(':checked');
                        var Elk = jQuery("#Elk").is(':checked');
                        var contact_name = jQuery("#contact_name").val();
                        var email = jQuery("#email").val();
                        var timeline = jQuery("#timeline").val();
                        var number = jQuery("#number").val();

                        var data = {
                            'action': 'quote_action',
                            custom_handle: custom_handle,
                            custom_handle2: custom_handle,
                            human_test1: human_test1,
                            human_test2: human_test2,
                            human_test3: human_test3,
                            dog_test1: dog_test1,
                            dog_test2: dog_test2,
                            Cow: Cow,
                            Bird: Bird,
                            Ruminant: Ruminant,
                            general_bacteroids: general_bacteroids,
                            goose_test1: goose_test1,
                            goose_test2: goose_test2,
                            Gull: Gull,
                            Hourse: Hourse,
                            Pig: Pig,
                            Chicken: Chicken,
                            Elk: Elk,
                            contact_name: contact_name,
                            email: email,
                            timeline: timeline,
                            number: number,
                        };

                        var site_url = '<?php echo site_url(); ?>';

                        jQuery.post(site_url + "/wp-admin/admin-ajax.php", data, function (response) {
                            jQuery(".quote_result").html(response);
                        });

                    } else {
                        alert('select atleast one');
                    }

                    event.preventDefault();
                    return false;
                });
            });
        </script>
    </div>
    <div class="quote_result"></div>
    <?php
    return ob_get_clean();
}

<?php
/*
Plugin Name: WooCommerce to LearnPress Sync
Description: Syncs WooCommerce orders with LearnPress orders.
Version: 1.2
Author: riadzoabi
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Hook into WooCommerce order completion.
add_action('woocommerce_order_status_completed', 'sync_wc_to_lp', 10, 1);

function sync_wc_to_lp($order_id) {
    // Check if LearnPress is active.
    if (!function_exists('learn_press_add_order') || !class_exists('LP_Order')) {
        return;
    }

    // Get the WooCommerce order.
    $order = wc_get_order($order_id);

    // Get user ID from WooCommerce order.
    $user_id = $order->get_user_id();

    // Initialize order items array.
    $lp_order_items = array();

    // Iterate through each item in the WooCommerce order.
    foreach ($order->get_items() as $item_id => $item) {
        $product_id = $item->get_product_id();

        // Check if the product is a LearnPress course.
        if (get_post_type($product_id) == 'lp_course') {
            // Add course to LearnPress order items array.
            $lp_order_items[] = array(
                'item_id' => $product_id,
                'item_name' => get_the_title($product_id),
                'quantity' => 1,
                'subtotal' => $item->get_total(),
                'total' => $item->get_total(),
            );

            // Enroll user in the course manually (if needed).
            learn_press_enroll_course($user_id, $product_id);
        }
    }

    // Create a LearnPress order if there are any courses.
    if (!empty($lp_order_items)) {
        $lp_order_data = array(
            'user_id' => $user_id,
            'status' => 'completed',
        );

        $lp_order_id = learn_press_add_order($lp_order_data);

        if ($lp_order_id) {
            // Update LearnPress order items.
            learn_press_update_order_items($lp_order_id, $lp_order_items);
        }
    }
}

// Function to manually enroll a user in a LearnPress course.
function learn_press_enroll_course($user_id, $course_id) {
    if (!function_exists('learn_press_user_begin_course')) {
        return;
    }

    $course = learn_press_get_course($course_id);
    if ($course) {
        $user = learn_press_get_user($user_id);
        if ($user) {
            $user->enroll($course_id);
        }
    }
}
?>

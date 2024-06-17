# WooCommerce to LearnPress Sync

**Description:** Syncs WooCommerce orders with LearnPress orders.

**Version:** 1.2

**Author:** riadzoabi

## Description

This WordPress plugin syncs WooCommerce orders with LearnPress orders. When a WooCommerce order is completed, the plugin checks if the order contains any LearnPress courses. If it does, it creates a corresponding LearnPress order and enrolls the user in the courses.

## Installation

1. Upload the `woocommerce-to-learnpress-sync` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.

## Changelog

### 1.2
* Initial release

## Usage

1. Install and activate the plugin.
2. Ensure WooCommerce and LearnPress are installed and activated.
3. When a WooCommerce order containing LearnPress courses is completed, the user will be automatically enrolled in the corresponding courses.

## Frequently Asked Questions

**Q:** Does this plugin require both WooCommerce and LearnPress to work?
**A:** Yes, both WooCommerce and LearnPress must be installed and active.

**Q:** What happens if a WooCommerce order does not contain any LearnPress courses?
**A:** The plugin will not create a LearnPress order if there are no LearnPress courses in the WooCommerce order.

## License

This plugin is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

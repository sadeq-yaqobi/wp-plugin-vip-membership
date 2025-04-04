# WordPress Plugin: VIP Membership

**Version:** 1.0.0  
**Author:** Sadeq Yaqobi  
**License:** GPL-2.0-or-later

## Description

The **VIP Membership** plugin is a custom WordPress plugin designed to manage VIP memberships on your WordPress site. It allows site administrators to restrict content access to VIP members, providing exclusive content to subscribed users.

## Features

- **VIP Content Restriction:** Restrict access to specific posts or pages to VIP members only.
- **Shortcode Support:** Use shortcodes to control content visibility within posts or pages.
- **Customizable Membership Levels:** Define different levels of VIP memberships with varying access permissions.
- **User-Friendly Interface:** Manage memberships and restricted content easily through the WordPress admin panel.

## Installation

1. **Download the Plugin:**
   - Clone the repository:
     ```bash
     git clone https://github.com/sadeq-yaqobi/wp-plugin-vip-membership.git
     ```
   - Or [download the ZIP file](https://github.com/sadeq-yaqobi/wp-plugin-vip-membership/archive/refs/heads/main.zip) and extract it.

2. **Upload to WordPress:**
   - Upload the extracted plugin folder to the `/wp-content/plugins/` directory of your WordPress installation.

3. **Activate the Plugin:**
   - Log in to your WordPress admin dashboard.
   - Navigate to **Plugins** > **Installed Plugins**.
   - Locate **VIP Membership** and click **Activate**.

## Usage

- **Restricting Content:**
  - Edit the post or page you want to restrict.
  - Use the `[vip_only]` shortcode to wrap the content that should be visible to VIP members only:
    ```bash
    [vip_only]This content is for VIP members only.[/vip_only]
    ```
  - Alternatively, set the visibility of the entire post or page to VIP members through the post's visibility settings.

- **Managing Memberships:**
  - Navigate to the **VIP Membership** section in the WordPress admin panel to manage membership levels and assign users to VIP roles.

## File Structure

- **`_inc/`**: Contains PHP files for handling form processing and validation.
- **`_lib/`**: Includes libraries and helper functions used by the plugin.
- **`assets/`**: Contains CSS and JavaScript files for styling and client-side functionality.
- **`class/`**: Holds PHP classes that manage the core functionalities of the plugin.
- **`view/`**: Contains template files for the plugin's admin interface and front-end display.
- **`Core.php`**: Core plugin functionalities and shortcode definitions.
- **`index.php`**: Initializes the plugin.

# Optimally Organic Theme Installation Guide

This guide will walk you through setting up your Optimally Organic WordPress website clone.

## Prerequisites

- WordPress installed and running
- WooCommerce plugin installed and activated
- PHP 7.4 or higher
- MySQL/MariaDB database

## Step 1: Activate the Theme

1. Log in to your WordPress admin panel: `http://localhost:8888/wordpress-ecom/wp-admin`
2. Navigate to **Appearance > Themes**
3. Find **Optimally Organic** theme
4. Click **Activate**

## Step 2: Run the Setup Script

1. After activating the theme, go to **Appearance > Setup Site Data**
2. Click the **Run Setup** button
3. Wait for the setup to complete (this may take a minute)
4. You should see a success message when done

This setup will create:
- ✅ 8 Product Categories
- ✅ 40+ Products
- ✅ 5 Pages (About, Contact, Testimonials, Fulvic Acid Benefits, Total Wellness Protocol)

## Step 3: Create Navigation Menus

1. Go to **Appearance > Menus**
2. Click **Create a new menu**
3. Name it **Primary Menu**
4. Add the following items:
   - Shop (WooCommerce shop page)
   - Collections
   - Package Deals
   - Info (with submenu: Fulvic Acid Benefits, Total Wellness Protocol)
   - Contact
   - About
   - Testimonials
5. Check **Primary Menu** location in "Display location"
6. Click **Save Menu**

## Step 4: Set Homepage

1. Go to **Settings > Reading**
2. Under "Your homepage displays", select **A static page**
3. For "Homepage", you can create a new page or use an existing one
   - The theme will automatically use `front-page.php` template if no homepage is set
4. Click **Save Changes**

## Step 5: Configure WooCommerce

1. Go to **WooCommerce > Settings**
2. Complete the setup wizard if it appears
3. Configure:
   - **General**: Set your store address and currency
   - **Products**: Configure product pages and catalog
   - **Shipping**: Set up shipping zones and rates
   - **Payments**: Configure payment gateways
   - **Tax**: Set up tax rates if needed

## Step 6: Set Site Title and Logo

1. Go to **Appearance > Customize**
2. Click **Site Identity**
3. Set your site title to **Optimally Organic**
4. Upload a logo if you have one
5. Click **Publish**

## Step 7: Test Your Site

1. Visit your homepage: `http://localhost:8888/wordpress-ecom/`
2. Check that:
   - Homepage displays correctly
   - Products are showing
   - Navigation menu works
   - Cart functionality works
   - Product pages load correctly

## Troubleshooting

### Products not showing?
- Make sure WooCommerce is activated
- Check that products were created: **Products > All Products**
- Verify product categories: **Products > Categories**

### Menu not showing?
- Make sure you created the menu and assigned it to "Primary Menu" location
- Clear any caching plugins

### Styling looks off?
- Make sure the theme is activated
- Check that CSS files are loading (view page source)
- Try clearing browser cache

### Setup script fails?
- Make sure WooCommerce is installed and activated
- Check PHP error logs
- Try deactivating other plugins temporarily

## Next Steps

- Add product images to make products look better
- Customize colors in `style.css` if needed
- Add testimonials to the Testimonials page
- Set up payment gateways in WooCommerce
- Configure shipping options
- Add more products if needed

## Support

For issues or questions:
- Check the README.md file
- Review WordPress and WooCommerce documentation
- Check theme files for customization options


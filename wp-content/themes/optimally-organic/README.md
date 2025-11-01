# Optimally Organic WordPress Theme

A custom WordPress theme that clones the Optimally Organic e-commerce website (https://www.optimallyorganic.com/).

## Installation

1. Upload the theme folder to `/wp-content/themes/`
2. Activate the theme through the WordPress admin panel (Appearance > Themes)
3. Make sure WooCommerce plugin is installed and activated
4. Go to Appearance > Setup Site Data to run the initial setup
   - This will create all product categories, products, and pages

## Features

- Fully responsive design matching the original Optimally Organic website
- WooCommerce integration for e-commerce functionality
- Custom homepage with all product sections
- Product categories including:
  - Fulvic Ionic Minerals
  - Red Pine Needle Oil
  - Probiotics & Enzymes
  - Organic Supergreen Powders
  - Super-Fruit Powders
  - Optimally Organic Extracts
  - Essiac Tea
  - Chaga Mushroom
- Custom pages (About, Contact, Testimonials, Info pages)
- Newsletter signup functionality
- Shopping cart integration

## Setup Instructions

1. **Activate the theme**
   - Go to WordPress Admin > Appearance > Themes
   - Activate "Optimally Organic" theme

2. **Run the setup**
   - Go to Appearance > Setup Site Data
   - Click "Run Setup" button
   - This will create:
     - All product categories
     - All products (40+ products)
     - All pages (About, Contact, Testimonials, etc.)

3. **Create navigation menus**
   - Go to Appearance > Menus
   - Create a new menu called "Primary Menu"
   - Add links to:
     - Shop (WooCommerce shop page)
     - Collections
     - Package Deals
     - Info pages (Fulvic Acid Benefits, Total Wellness Protocol)
     - Contact
     - About
     - Testimonials
   - Assign to "Primary Menu" location

4. **Configure WooCommerce**
   - Go to WooCommerce > Settings
   - Complete the setup wizard if needed
   - Set up payment gateways
   - Configure shipping zones

5. **Set homepage**
   - Go to Settings > Reading
   - Set "Your homepage displays" to "A static page"
   - Select a page or create a new page called "Home"
   - The theme's `front-page.php` will automatically be used

## Theme Structure

```
optimally-organic/
├── assets/
│   ├── css/
│   │   └── custom.css
│   └── js/
│       └── main.js
├── woocommerce/
│   └── content-product.php
├── functions.php
├── header.php
├── footer.php
├── index.php
├── front-page.php
├── page.php
├── single.php
├── style.css
├── setup-data.php
└── README.md
```

## Customization

### Colors
Edit CSS variables in `style.css`:
- `--primary-color`: #2d5016
- `--secondary-color`: #4a7c2a
- `--accent-color`: #6b9e3f

### Products
All products are created through the setup script. You can manage them through:
- WordPress Admin > Products

### Pages
All pages are created through the setup script. You can edit them through:
- WordPress Admin > Pages

## Support

For issues or questions, please refer to the WordPress and WooCommerce documentation.


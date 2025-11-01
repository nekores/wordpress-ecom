/**
 * Add to Cart Success Alert
 * Shows alert in top right corner with View Cart button
 */

(function($) {
    'use strict';
    
    // Debug: Log when script loads
    if (typeof console !== 'undefined') {
        console.log('Add to cart alert script loaded');
        console.log('WooCommerce params:', typeof wc_add_to_cart_params !== 'undefined' ? wc_add_to_cart_params : 'Not defined');
    }

    // Create alert HTML structure
    function createAlertHTML(productName, cartUrl) {
        return `
            <div class="woocommerce-add-to-cart-alert fixed top-4 right-4 z-50 bg-white rounded-lg shadow-2xl border border-gray-200 p-4 md:p-6 max-w-sm animate-slide-in-right" style="animation-duration: 0.3s;">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-sm md:text-base font-semibold text-gray-900 mb-1">Added to Cart!</h3>
                        <p class="text-xs md:text-sm text-gray-600 mb-3 line-clamp-2">${productName}</p>
                        <a href="${cartUrl}" class="inline-flex items-center px-4 py-2 bg-primary text-white text-xs md:text-sm font-semibold rounded-lg hover:bg-primary-light transition-colors">
                            View Cart
                        </a>
                    </div>
                    <button class="woocommerce-alert-close flex-shrink-0 text-gray-400 hover:text-gray-600 transition-colors" aria-label="Close">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        `;
    }

    // Show alert
    function showAddToCartAlert(productName, cartUrl) {
        // Remove existing alerts
        $('.woocommerce-add-to-cart-alert').remove();

        // Create and append alert
        const alertHTML = createAlertHTML(productName, cartUrl);
        $('body').append(alertHTML);

        // Auto-hide after 5 seconds
        const alert = $('.woocommerce-add-to-cart-alert');
        const timer = setTimeout(function() {
            hideAlert(alert);
        }, 5000);

        // Close button handler
        alert.find('.woocommerce-alert-close').on('click', function() {
            clearTimeout(timer);
            hideAlert(alert);
        });

        // Click outside to close
        alert.on('click', function(e) {
            if (e.target === this) {
                clearTimeout(timer);
                hideAlert(alert);
            }
        });
    }

    // Hide alert with animation
    function hideAlert(alert) {
        alert.css('animation', 'fadeOutRight 0.3s ease-out');
        setTimeout(function() {
            alert.remove();
        }, 300);
    }

    // Handle WooCommerce add to cart from product loop (shop page)
    $(document.body).on('added_to_cart', function(event, fragments, cart_hash, $button) {
        // Remove loading state from button
        if ($button && $button.length) {
            $button.removeClass('loading').removeAttr('aria-disabled');
            $button.find('.fa-spinner, .spinner, .loader').remove();
            
            // Remove "added" class to prevent checkmark icon
            setTimeout(function() {
                $button.removeClass('added');
            }, 100);
        }
        
        // Remove "View cart" links that WooCommerce adds
        $('.added_to_cart, a.added_to_cart, .wc-forward').remove();

        // Get product name from button context
        let productName = 'Product';
        let cartUrl = '/cart/';

        // Try to get product name from different contexts
        if ($button && $button.length) {
            productName = $button.closest('.product, li.product').find('.woocommerce-loop-product__title, .product_title, h1, h2').first().text() || 
                         $button.closest('form.cart').find('.product_title, h1').first().text() ||
                         $button.attr('data-product_name') ||
                         $button.data('product_name') ||
                         'Product';
        }

        // Get cart URL from fragments or params
        if (fragments && fragments.cart_url) {
            cartUrl = fragments.cart_url;
        } else if (typeof wc_add_to_cart_params !== 'undefined' && wc_add_to_cart_params.cart_url) {
            cartUrl = wc_add_to_cart_params.cart_url;
        } else if (typeof optimally_organic_cart_params !== 'undefined' && optimally_organic_cart_params.cart_url) {
            cartUrl = optimally_organic_cart_params.cart_url;
        } else {
            // Fallback to WooCommerce default
            cartUrl = window.location.origin + '/cart/';
        }

        // Clean up product name
        productName = productName.trim().replace(/\s+/g, ' ');

        // Show alert
        showAddToCartAlert(productName, cartUrl);

        // Update cart count in header if fragment exists
        if (fragments && typeof fragments === 'object') {
            // Update cart count badge
            const cartCount = $('.header-actions .cart-count, .cart-count');
            if (cartCount.length) {
                // Try to extract count from fragments
                Object.keys(fragments).forEach(function(key) {
                    if (typeof fragments[key] === 'string') {
                        const match = fragments[key].match(/cart-count[^>]*>(\d+)/i);
                        if (match) {
                            cartCount.text(match[1]);
                        }
                    }
                });
            }
        }
    });

    // Handle AJAX errors - remove loading state if request fails
    $(document.body).on('wc_fragments_refreshed wc_fragments_loaded', function() {
        $('.product .button.loading, .add_to_cart_button.loading').each(function() {
            $(this).removeClass('loading').removeAttr('aria-disabled');
            $(this).find('.fa-spinner, .spinner, .loader').remove();
        });
    });

    // Handle AJAX errors - remove loading state on error
    $(document.body).on('wc_error', function(event, error_message, $target) {
        if ($target && $target.length) {
            $target.removeClass('loading').removeAttr('aria-disabled');
            $target.find('.fa-spinner, .spinner, .loader').remove();
        }
        
        // Also remove from any button with loading class
        $('.product .button.loading, .add_to_cart_button.loading').each(function() {
            $(this).removeClass('loading').removeAttr('aria-disabled');
            $(this).find('.fa-spinner, .spinner, .loader').remove();
        });
    });

    // Fallback: Remove loading state after timeout (8 seconds)
    $(document).on('click', '.add_to_cart_button, .product .button, a.add_to_cart_button', function(e) {
        const $button = $(this);
        
        // Wait a moment for WooCommerce to add loading class
        setTimeout(function() {
            if ($button.hasClass('loading')) {
                // Set timeout to remove loading state if request hangs
                setTimeout(function() {
                    if ($button.hasClass('loading')) {
                        $button.removeClass('loading').removeAttr('aria-disabled');
                        $button.find('.fa-spinner, .spinner, .loader').remove();
                        console.warn('Add to cart request timed out - loading state removed');
                        
                        // Show error message to user
                        if ($('.woocommerce-error').length === 0) {
                            $('body').append('<div class="woocommerce-error woocommerce-message" style="position: fixed; top: 20px; right: 20px; z-index: 9999; padding: 15px; background: #f44336; color: white; border-radius: 5px;">Add to cart request timed out. Please try again.</div>');
                            setTimeout(function() {
                                $('.woocommerce-error').fadeOut(function() {
                                    $(this).remove();
                                });
                            }, 3000);
                        }
                    }
                }, 8000);
            }
        }, 100);
    });

    // Continuously remove "View cart" links and checkmark icons
    setInterval(function() {
        // Remove "View cart" links
        $('.added_to_cart, a.added_to_cart, .wc-forward').remove();
        
        // Remove "added" class from buttons to prevent checkmark
        $('.button.added, .add_to_cart_button.added').removeClass('added');
    }, 500);

    // Add CSS animations
    if (!$('#woocommerce-alert-styles').length) {
        $('<style id="woocommerce-alert-styles">')
            .text(`
                @keyframes slideInRight {
                    from {
                        transform: translateX(100%);
                        opacity: 0;
                    }
                    to {
                        transform: translateX(0);
                        opacity: 1;
                    }
                }
                @keyframes fadeOutRight {
                    from {
                        transform: translateX(0);
                        opacity: 1;
                    }
                    to {
                        transform: translateX(100%);
                        opacity: 0;
                    }
                }
                .animate-slide-in-right {
                    animation: slideInRight 0.3s ease-out;
                }
            `)
            .appendTo('head');
    }

})(jQuery);


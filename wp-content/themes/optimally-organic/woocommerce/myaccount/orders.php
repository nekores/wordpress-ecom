<?php
/**
 * Orders Template
 * Modern Orders Page with Tailwind CSS
 *
 * @package Optimally_Organic
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_account_orders', $has_orders );
?>

<?php if ( $has_orders ) : ?>

	<table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
		<thead>
			<tr>
				<?php foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) : ?>
					<th scope="col" class="woocommerce-orders-table__header woocommerce-orders-table__header-<?php echo esc_attr( $column_id ); ?>"><span class="nobr"><?php echo esc_html( $column_name ); ?></span></th>
				<?php endforeach; ?>
			</tr>
		</thead>

		<tbody>
			<?php
			foreach ( $customer_orders->orders as $customer_order ) {
				$order      = wc_get_order( $customer_order ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				$item_count = $order->get_item_count() - $order->get_item_count_refunded();
				?>
				<tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-<?php echo esc_attr( $order->get_status() ); ?> order">
					<?php foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) :
						$is_order_number = 'order-number' === $column_id;
					?>
						<?php if ( $is_order_number ) : ?>
							<th class="woocommerce-orders-table__cell woocommerce-orders-table__cell-<?php echo esc_attr( $column_id ); ?>" data-title="<?php echo esc_attr( $column_name ); ?>" scope="row">
						<?php else : ?>
							<td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-<?php echo esc_attr( $column_id ); ?>" data-title="<?php echo esc_attr( $column_name ); ?>">
						<?php endif; ?>

							<?php if ( has_action( 'woocommerce_my_account_my_orders_column_' . $column_id ) ) : ?>
								<?php do_action( 'woocommerce_my_account_my_orders_column_' . $column_id, $order ); ?>

							<?php elseif ( $is_order_number ) : ?>
								<?php /* translators: %s: the order number, usually accompanied by a leading # */ ?>
								<a href="<?php echo esc_url( $order->get_view_order_url() ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'View order number %s', 'woocommerce' ), $order->get_order_number() ) ); ?>">
									<?php echo esc_html( _x( '#', 'hash before order number', 'woocommerce' ) . $order->get_order_number() ); ?>
								</a>

							<?php elseif ( 'order-date' === $column_id ) : ?>
								<time datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></time>

							<?php elseif ( 'order-status' === $column_id ) : ?>
								<span class="order-status status-<?php echo esc_attr( $order->get_status() ); ?>">
									<?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?>
								</span>

							<?php elseif ( 'order-total' === $column_id ) : ?>
								<?php
								/* translators: 1: formatted order total 2: total order items */
								echo wp_kses_post( sprintf( _n( '%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'woocommerce' ), $order->get_formatted_order_total(), $item_count ) );
								?>

							<?php elseif ( 'order-actions' === $column_id ) : ?>
								<div class="order-actions">
									<?php
									$actions = wc_get_account_orders_actions( $order );

									if ( ! empty( $actions ) ) {
										foreach ( $actions as $key => $action ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
											if ( empty( $action['aria-label'] ) ) {
												/* translators: %1$s Action name, %2$s Order number. */
												$action_aria_label = sprintf( __( '%1$s order number %2$s', 'woocommerce' ), $action['name'], $order->get_order_number() );
											} else {
												$action_aria_label = $action['aria-label'];
											}
											echo '<a href="' . esc_url( $action['url'] ) . '" class="woocommerce-button button ' . sanitize_html_class( $key ) . '" aria-label="' . esc_attr( $action_aria_label ) . '">' . esc_html( $action['name'] ) . '</a>';
											unset( $action_aria_label );
										}
									}
									?>
								</div>
							<?php endif; ?>

						<?php if ( $is_order_number ) : ?>
							</th>
						<?php else : ?>
							</td>
						<?php endif; ?>
					<?php endforeach; ?>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>

	<?php do_action( 'woocommerce_before_account_orders_pagination' ); ?>

	<?php if ( 1 < $customer_orders->max_num_pages ) : ?>
		<div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
			<?php if ( 1 !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page - 1 ) ); ?>"><?php esc_html_e( 'Previous', 'woocommerce' ); ?></a>
			<?php endif; ?>

			<?php if ( intval( $customer_orders->max_num_pages ) !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page + 1 ) ); ?>"><?php esc_html_e( 'Next', 'woocommerce' ); ?></a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

<?php else : ?>

	<?php wc_print_notice( esc_html__( 'No order has been made yet.', 'woocommerce' ) . ' <a class="woocommerce-Button wc-forward button" href="' . esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ) . '">' . esc_html__( 'Browse products', 'woocommerce' ) . '</a>', 'notice' ); ?>

<?php endif; ?>

<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>

<style>
/* Orders Table Styles */
.woocommerce-MyAccount-content .woocommerce-orders-table {
	width: 100% !important;
	border-collapse: collapse !important;
	margin-top: 2rem !important;
	border-radius: 0.5rem !important;
	overflow: hidden !important;
	box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1) !important;
}

.woocommerce-MyAccount-content .woocommerce-orders-table thead {
	background: linear-gradient(135deg, #2d5016 0%, #4a7c2a 100%) !important;
}

.woocommerce-MyAccount-content .woocommerce-orders-table th {
	padding: 1rem 1.5rem !important;
	text-align: left !important;
	color: white !important;
	font-weight: 600 !important;
	font-size: 0.875rem !important;
	text-transform: uppercase !important;
	letter-spacing: 0.05em !important;
}

.woocommerce-MyAccount-content .woocommerce-orders-table td {
	padding: 1rem 1.5rem !important;
	border-bottom: 1px solid #e5e7eb !important;
	color: #4b5563 !important;
	background: white !important;
}

.woocommerce-MyAccount-content .woocommerce-orders-table tbody tr {
	transition: background-color 0.2s ease !important;
}

.woocommerce-MyAccount-content .woocommerce-orders-table tbody tr:hover {
	background: #f9fafb !important;
}

.woocommerce-MyAccount-content .woocommerce-orders-table tbody tr:last-child td {
	border-bottom: none !important;
}

/* Order Status Badges */
.woocommerce-MyAccount-content .woocommerce-orders-table .order-status {
	display: inline-flex !important;
	align-items: center !important;
	padding: 0.25rem 0.75rem !important;
	border-radius: 9999px !important;
	font-size: 0.75rem !important;
	font-weight: 600 !important;
	text-transform: uppercase !important;
	letter-spacing: 0.05em !important;
}

.woocommerce-MyAccount-content .woocommerce-orders-table .order-status.status-completed {
	background: #10b981 !important;
	color: white !important;
}

.woocommerce-MyAccount-content .woocommerce-orders-table .order-status.status-processing {
	background: #3b82f6 !important;
	color: white !important;
}

.woocommerce-MyAccount-content .woocommerce-orders-table .order-status.status-on-hold {
	background: #f59e0b !important;
	color: white !important;
}

.woocommerce-MyAccount-content .woocommerce-orders-table .order-status.status-cancelled {
	background: #ef4444 !important;
	color: white !important;
}

.woocommerce-MyAccount-content .woocommerce-orders-table .order-status.status-pending {
	background: #6b7280 !important;
	color: white !important;
}

/* Order Actions */
.woocommerce-MyAccount-content .woocommerce-orders-table .order-actions {
	white-space: nowrap !important;
}

.woocommerce-MyAccount-content .woocommerce-orders-table .order-actions a {
	display: inline-block !important;
	padding: 0.5rem 1rem !important;
	margin-right: 0.5rem !important;
	background: #2d5016 !important;
	color: white !important;
	border-radius: 0.375rem !important;
	font-size: 0.875rem !important;
	font-weight: 600 !important;
	text-decoration: none !important;
	transition: all 0.3s ease !important;
}

.woocommerce-MyAccount-content .woocommerce-orders-table .order-actions a:hover {
	background: #4a7c2a !important;
	transform: translateY(-1px) !important;
	box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
}

/* Pagination */
.woocommerce-MyAccount-content .woocommerce-pagination {
	margin-top: 2rem !important;
	display: flex !important;
	justify-content: center !important;
	gap: 0.5rem !important;
}

.woocommerce-MyAccount-content .woocommerce-pagination a,
.woocommerce-MyAccount-content .woocommerce-pagination span {
	display: inline-flex !important;
	align-items: center !important;
	justify-content: center !important;
	min-width: 2.5rem !important;
	height: 2.5rem !important;
	padding: 0.5rem 1rem !important;
	border: 1px solid #e5e7eb !important;
	border-radius: 0.5rem !important;
	color: #4b5563 !important;
	text-decoration: none !important;
	font-weight: 500 !important;
	transition: all 0.3s ease !important;
}

.woocommerce-MyAccount-content .woocommerce-pagination a:hover {
	background: #2d5016 !important;
	color: white !important;
	border-color: #2d5016 !important;
}

.woocommerce-MyAccount-content .woocommerce-pagination span.current {
	background: #2d5016 !important;
	color: white !important;
	border-color: #2d5016 !important;
}

/* Responsive Orders Table */
@media (max-width: 768px) {
	.woocommerce-MyAccount-content .woocommerce-orders-table {
		display: block !important;
		overflow-x: auto !important;
		-webkit-overflow-scrolling: touch !important;
	}
	
	.woocommerce-MyAccount-content .woocommerce-orders-table th,
	.woocommerce-MyAccount-content .woocommerce-orders-table td {
		min-width: 120px !important;
		font-size: 0.875rem !important;
		padding: 0.75rem 1rem !important;
	}
}
</style>

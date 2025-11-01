import {
	labelPurchaseStore,
	registerLabelPurchaseStore,
} from '../../data/label-purchase';
import { addressStore, registerAddressStore } from '../../data/address';
import {
	carrierStrategyStore,
	registerCarrierStrategyStore,
} from '../../data/carrier-strategy';
import { getConfig } from './../../utils';
import { memo, useRef } from 'react';
import { LabelPurchaseContextProvider } from '../../context/label-purchase';
import { LabelPurchaseEffects } from '../../effects/label-purchase';
import { LabelPurchaseTabs } from '../../components/label-purchase/label-purchase-tabs';
import { dispatch } from '@wordpress/data';

const PurchaseShippingLabelPluginExport = memo(
	( { orderId }: { orderId: number } ) => {
		const noop = () => {
			/* no operation */
		};
		const ref = useRef( null );

		// We need to reset the state when the order ID changes to avoid
		// showing data from a previous order.
		dispatch( addressStore ).stateReset();
		dispatch( labelPurchaseStore ).stateReset();
		dispatch( carrierStrategyStore ).stateReset();

		return (
			<LabelPurchaseContextProvider orderId={ orderId } nextDesign>
				<LabelPurchaseEffects />
				<LabelPurchaseTabs ref={ ref } setStartSplitShipment={ noop } />
			</LabelPurchaseContextProvider>
		);
	},
	( prevProps, nextProps ) => prevProps.orderId === nextProps.orderId
);

const PurchaseShippingLabelPlugin = () => {
	if ( ! addressStore ) {
		try {
			registerAddressStore( true );
		} catch {
			// Store is already registered
		}
	}
	if ( ! labelPurchaseStore ) {
		try {
			registerLabelPurchaseStore();
		} catch {
			// Store is already registered
		}
	}
	if ( ! carrierStrategyStore ) {
		try {
			registerCarrierStrategyStore();
		} catch {
			// Store is already registered
		}
	}

	const orderId = getConfig().order.id;

	return <PurchaseShippingLabelPluginExport orderId={ orderId } />;
};

window.WCShipping_Plugin = PurchaseShippingLabelPlugin;

export default PurchaseShippingLabelPlugin;

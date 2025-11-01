import { useCallback, useEffect, useState, useMemo } from '@wordpress/element';
import {
	__experimentalSpacer as Spacer,
	__experimentalText as Text,
	__experimentalInputControl as InputControl,
	Button,
	Flex,
	SelectControl,
	CheckboxControl,
} from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import {
	DataForm,
	DataFormControlProps,
	DeepPartial,
	Field,
	Form,
	FormField,
} from '@wordpress/dataviews/wp';
import Notification from 'components/notification';
import { AddressContextProvider } from './context';
import { getCountryNames, getStateNames, isMailAndPhoneRequired } from 'utils';
import { ADDRESS_TYPES } from 'data/constants';
import {
	CamelCaseType,
	Destination,
	LocationResponse,
	AddressTypes,
} from 'types';
import _ from 'lodash';

interface AddressDataFormProps< T = Destination > {
	type: AddressTypes;
	initialValue: T;
	onSubmit: ( formData: T ) => Promise< void >;
	onCancel?: () => void;
	isUpdating: boolean;
	isVerified: boolean;
	validationErrors: Record< string, string >;
	showUPSDAPTOSWarning: boolean;
	validateAddressSection: ( values: T ) => Record< string, string >;
	isSubmitButtonDisabled: ( {
		isDirty,
		isValidForm,
	}: {
		isDirty: boolean;
		isValidForm: boolean;
	} ) => boolean;
	originCountry?: string;
}

function FieldInput< T = Destination >( {
	data,
	field,
	onChange,
	hideLabelFromVision,
}: DataFormControlProps< T > ): React.ReactNode {
	// Map address to address1 for backwards compatibility
	const fieldValue =
		field.id === 'address'
			? data[ 'address1' as keyof T ] || data[ 'address' as keyof T ]
			: data[ field.id as keyof T ];

	const handleChange = ( value: string | undefined ) => {
		onChange( { [ field.id ]: value } as DeepPartial< T > );
	};

	return (
		<InputControl
			value={ fieldValue as string }
			label={ field.label }
			onChange={ handleChange }
			placeholder={ field.placeholder }
			hideLabelFromVision={ hideLabelFromVision }
			__next40pxDefaultSize
		/>
	);
}

function FieldSelect< T = Destination >( {
	data,
	field,
	onChange,
	options,
	hideLabelFromVision,
}: DataFormControlProps< T > & {
	options: { label: string; value: string }[];
} ): React.ReactNode {
	const fieldValue = data[ field.id as keyof T ];
	const handleChange = ( value: string | undefined ) => {
		onChange( { [ field.id ]: value } as DeepPartial< T > );
	};
	return (
		<SelectControl
			value={ fieldValue as string }
			options={ options }
			label={ field.label }
			hideLabelFromVision={ hideLabelFromVision }
			onChange={ handleChange }
			__next40pxDefaultSize
			__nextHasNoMarginBottom
		/>
	);
}

function FieldCheckbox< T = Destination >( {
	data,
	field,
	onChange,
}: DataFormControlProps< T > & {
	validationErrors?: Record< string, string >;
} ): React.ReactNode {
	const fieldValue = data[ field.id as keyof T ];
	const handleChange = ( value: boolean ) => {
		onChange( { [ field.id ]: value } as DeepPartial< T > );
	};
	return (
		<CheckboxControl
			label={ field.label }
			checked={ fieldValue as boolean }
			onChange={ handleChange }
		/>
	);
}

export function AddressDataForm<
	T extends CamelCaseType< LocationResponse >
>( {
	type,
	initialValue,
	onSubmit,
	onCancel,
	isUpdating,
	isVerified,
	validationErrors,
	showUPSDAPTOSWarning,
	validateAddressSection,
	isSubmitButtonDisabled,
	originCountry,
}: AddressDataFormProps< T > ) {
	// State for DataForm
	const [ formData, setFormData ] = useState< T >( initialValue );
	const [ dataFormIsDirty, setDataFormIsDirty ] = useState( false );
	const [ formValidationErrors, setFormValidationErrors ] = useState<
		Record< string, string >
	>( {} );

	// Handle form submission for DataForm
	const handleDataFormSubmit = async () => {
		await onSubmit( formData );
	};

	// Check if form is valid for DataForm - combine both local and store validation errors
	const allValidationErrors = {
		...validationErrors,
		...formValidationErrors,
	};
	const dataFormIsValid = Object.keys( allValidationErrors ).length === 0;

	// Get country and state options
	const countryNames = getCountryNames( type, formData.country );
	const stateNames = formData.country
		? getStateNames( formData.country )
		: [];

	// Check if phone and email are required
	const isPhoneAndEmailRequired = isMailAndPhoneRequired( {
		type,
		originCountry,
		destinationCountry: formData.country,
	} );

	const fields: Field< T >[] = useMemo(
		() => [
			{
				id: 'name',
				type: 'text',
				label: __( 'Recipient Name', 'woocommerce-shipping' ),
			},
			{
				id: 'address',
				type: 'text',
				label: __( 'Shipping Address', 'woocommerce-shipping' ),
			},
			{
				id: 'address2',
				type: 'text',
				placeholder: __(
					'Apartment, suite, etc.',
					'woocommerce-shipping'
				),
				Edit: ( props ) => (
					<FieldInput< T > { ...props } hideLabelFromVision />
				),
			},
			{
				id: 'city',
				type: 'text',
				placeholder: __( 'City', 'woocommerce-shipping' ),
				Edit: ( props ) => (
					<FieldInput< T > { ...props } hideLabelFromVision />
				),
			},
			{
				id: 'state',
				type: 'text',
				label: __( 'State', 'woocommerce-shipping' ),
				Edit: ( props ) =>
					stateNames.length > 0 ? (
						<FieldSelect< T >
							{ ...props }
							options={ stateNames }
							hideLabelFromVision
						/>
					) : (
						<FieldInput< T > { ...props } hideLabelFromVision />
					),
			},
			{
				id: 'postcode',
				type: 'text',
				placeholder: __( 'Postal Code', 'woocommerce-shipping' ),
				Edit: ( props ) => (
					<FieldInput< T > { ...props } hideLabelFromVision />
				),
			},
			{
				id: 'country',
				type: 'text',
				label: __( 'Country', 'woocommerce-shipping' ),
				Edit: ( props ) => (
					<FieldSelect< T >
						{ ...props }
						options={ countryNames }
						hideLabelFromVision
					/>
				),
			},
			{
				id: 'email',
				type: 'text',
				label: isPhoneAndEmailRequired
					? __( 'Email (required)', 'woocommerce-shipping' )
					: __( 'Email (optional)', 'woocommerce-shipping' ),
				Edit: ( props ) => <FieldInput< T > { ...props } />,
			},
			{
				id: 'phone',
				type: 'text',
				label: isPhoneAndEmailRequired
					? __( 'Phone Number (required)', 'woocommerce-shipping' )
					: __( 'Phone Number', 'woocommerce-shipping' ),
				Edit: ( props ) => <FieldInput< T > { ...props } />,
			},
			// Add Save as default checkbox only for origin addresses
			{
				id: 'defaultAddress',
				type: 'boolean',
				label: __(
					'Save as default origin address',
					'woocommerce-shipping'
				),
				isVisible: () => type === ADDRESS_TYPES.ORIGIN,
				Edit: ( props ) => <FieldCheckbox< T > { ...props } />,
			},
		],
		[]
	);

	const form: Form = {
		fields: [
			'name',
			'address',
			'address2',
			{
				layout: {
					type: 'row',
					alignment: 'start',
				},
				children: [ 'city', 'state' ],
			} as FormField,
			{
				layout: {
					type: 'row',
					alignment: 'start',
				},
				children: [ 'postcode', 'country' ],
			} as FormField,
			'phone',
			'email',
			'defaultAddress',
		].filter( Boolean ) as FormField[],
		layout: {
			type: 'regular',
			labelPosition: 'top',
		},
	};

	const handleChange = useCallback(( value: Record< string, any > ) => { // eslint-disable-line
			setFormData( ( prev ) => ( {
				...prev,
				...value,
			} ) );
		},
		[ initialValue, validateAddressSection ]
	);

	// Check if form is dirty or has validation errors on formData change
	useEffect( () => {
		setDataFormIsDirty( ! _.isEqual( initialValue, formData ) );

		// Validate the form
		const errors = validateAddressSection( formData );
		setFormValidationErrors( errors );
	}, [ formData ] );

	return (
		<>
			{ showUPSDAPTOSWarning && (
				<>
					<Notification type="warning">
						<Text>
							{ __(
								'You have accepted the UPS® Terms of Service for this address. If you update the address, the acceptance will be revoked, and you will need to accept the Terms of Service again before purchasing additional UPS® labels.',
								'woocommerce-shipping'
							) }
						</Text>
					</Notification>
					<Spacer marginBottom={ 3 } />
				</>
			) }
			{ ! isVerified && (
				<Spacer marginBottom={ 3 }>
					<Notification type="warning">
						{ __(
							"This address hasn't been validated. We recommend validating to help ensure successful delivery.",
							'woocommerce-shipping'
						) }
					</Notification>
				</Spacer>
			) }
			{ Object.keys( allValidationErrors ).length > 0 && (
				<Spacer marginBottom={ 3 }>
					<Notification type="error">
						<Text>
							{ __(
								'Please fix the errors below to continue.',
								'woocommerce-shipping'
							) }
						</Text>
						<ul
							style={ {
								margin: 0,
								paddingInlineStart: 0,
								listStylePosition: 'inside',
							} }
						>
							{ Object.keys( allValidationErrors ).map(
								( key ) => (
									<li key={ key }>
										{ allValidationErrors[ key ] }
									</li>
								)
							) }
						</ul>
					</Notification>
				</Spacer>
			) }
			<AddressContextProvider
				initialValue={ {
					isUpdating,
					validationErrors,
				} }
			>
				<Spacer marginBottom={ 6 }>
					<DataForm< T >
						data={ formData }
						fields={ fields }
						onChange={ handleChange }
						form={ form }
					></DataForm>
				</Spacer>
			</AddressContextProvider>
			<Flex justify="flex-end" align={ 'center' } as="footer">
				<Button
					onClick={ onCancel }
					isBusy={ isUpdating }
					variant="tertiary"
				>
					{ __( 'Cancel', 'woocommerce-shipping' ) }
				</Button>
				<Button
					onClick={ handleDataFormSubmit }
					variant="primary"
					disabled={ isSubmitButtonDisabled( {
						isDirty: dataFormIsDirty,
						isValidForm: dataFormIsValid,
					} ) }
					isBusy={ isUpdating }
				>
					{ __( 'Validate and save', 'woocommerce-shipping' ) }
				</Button>
			</Flex>
		</>
	);
}

import * as areoi from '../_components/Core.js';
import meta from './block.json';

const ALLOWED_BLOCKS = [];
const BLOCKS_TEMPLATE = null;

areoi.blocks.registerBlockType( meta, {
    icon: areoi.blockIcon,
    edit: props => {
        const {
            attributes,
            setAttributes,
            clientId
        } = props;

        const { block_id } = attributes;
        if ( !block_id || ( block_id != clientId ) ) {
            setAttributes( { block_id: clientId } );
        }

        const classes = [
            attributes.style,
            attributes.color,
            attributes.size ? attributes.style + attributes.size : ''
        ];

        const blockProps = areoi.editor.useBlockProps( {
            style: { cssText: areoi.helper.GetStyles( attributes ) }
        } );

        function onChange( key, value ) {
            setAttributes( { [key]: value } );
        }

        const tabDevice = ( tab ) => {
            return (
                <div>
                    { areoi.DisplayVisibility( areoi, attributes, onChange, tab ) }
                </div>
            );
        };
 
        return (
            <>
                { areoi.DisplayPreview( areoi, attributes, onChange, 'spinner' ) }

                { !attributes.preview &&
                    <div { ...blockProps }>
                        <areoi.editor.InspectorControls key="setting">

                            <areoi.components.PanelBody title={ 'Settings' } initialOpen={ false }>

                                <areoi.components.PanelRow className="areoi-panel-row">
                                    <areoi.components.SelectControl
                                        label="Style"
                                        labelPosition="top"
                                        help="The border spinner uses currentColor for its border-color, meaning you can customize the color with text color utilities. You can use any of our text color utilities on the standard spinner."
                                        value={ attributes.style }
                                        options={ [
                                            { label: 'Default', value: 'spinner-border' },
                                            { label: 'Border', value: 'spinner-border' },
                                            { label: 'Grow', value: 'spinner-grow' },
                                        ] }
                                        onChange={ ( value ) => onChange( 'style', value ) }
                                    />
                                </areoi.components.PanelRow>

                                <areoi.components.PanelRow className="areoi-panel-row">
                                    <areoi.components.SelectControl
                                        label="Size"
                                        labelPosition="top"
                                        help="Add .spinner-border-sm and .spinner-grow-sm to make a smaller spinner that can quickly be used within other components."
                                        value={ attributes.size }
                                        options={ [
                                            { label: 'Default', value: null },
                                            { label: 'Small', value: '-sm' }
                                        ] }
                                        onChange={ ( value ) => onChange( 'size', value ) }
                                    />
                                </areoi.components.PanelRow>

                                <areoi.components.PanelRow>
                                    <areoi.components.SelectControl
                                        label="Color"
                                        labelPosition="top"
                                        help="The border spinner uses currentColor for its border-color, meaning you can customize the color with text color utilities. You can use any of our text color utilities on the standard spinner."
                                        value={ attributes.color }
                                        options={ [
                                            { label: 'Default', value: null },
                                            { label: 'Primary', value: 'text-primary' },
                                            { label: 'Secondary', value: 'text-secondary' },
                                            { label: 'Success', value: 'text-success' },
                                            { label: 'Danger', value: 'text-danger' },
                                            { label: 'Warning', value: 'text-warning' },
                                            { label: 'Info', value: 'text-info' },
                                            { label: 'Light', value: 'text-light' },
                                            { label: 'Dark', value: 'text-dark' },
                                        ] }
                                        onChange={ ( value ) => onChange( 'color', value ) }
                                    />
                                </areoi.components.PanelRow>

                            </areoi.components.PanelBody>

                            { areoi.ResponsiveTabPanel( tabDevice ) }
                                
                        </areoi.editor.InspectorControls>

                        <div className={ areoi.helper.GetClassNameStr( classes ) }></div>
                    </div>
                }
            </>
        );
    },
    save: () => { 
        return (
            <areoi.editor.InnerBlocks.Content/>
        );
    },
} );
import * as areoi from '../_components/Core.js';
import meta from './block.json';

const ALLOWED_BLOCKS = [ 'areoi/button' ];
const BLOCKS_TEMPLATE = [ 
    ['areoi/button', {} ],
    ['areoi/button', {} ]
];

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
            attributes.size,
            attributes.style
        ];

        const blockProps = areoi.editor.useBlockProps( {
            className: areoi.helper.GetClassName( classes ),
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
                { areoi.DisplayPreview( areoi, attributes, onChange, 'button-group' ) }

                { !attributes.preview &&
                    <div { ...blockProps }>
                        <areoi.editor.InspectorControls key="setting">

                            <areoi.components.PanelBody title={ 'Settings' } initialOpen={ false }>
                                <areoi.components.PanelRow className="areoi-panel-row">
                                    <areoi.components.SelectControl
                                        label="Style"
                                        labelPosition="top"
                                        help="Make a set of buttons appear vertically stacked rather than horizontally. Split button dropdowns are not supported here."
                                        value={ attributes.style }
                                        options={ [
                                            { label: 'Default', value: 'btn-group' },
                                            { label: 'Horizontal', value: 'btn-group' },
                                            { label: 'Vertical', value: 'btn-group-vertical' },
                                        ] }
                                        onChange={ ( value ) => onChange( 'style', value ) }
                                    />
                                </areoi.components.PanelRow>

                                <areoi.components.PanelRow>
                                    <areoi.components.SelectControl
                                        label="Size"
                                        help="Instead of applying button sizing classes to every button in a group, just add .btn-group-* to each .btn-group, including each one when nesting multiple groups."
                                        labelPosition="top"
                                        value={ attributes.size }
                                        options={ [
                                            { label: 'Default', value: null },
                                            { label: 'Small', value: 'btn-group-sm' },
                                            { label: 'Medium', value: null },
                                            { label: 'Large', value: 'btn-group-lg' },
                                        ] }
                                        onChange={ ( value ) => onChange( 'size', value ) }
                                    />
                                </areoi.components.PanelRow>

                            </areoi.components.PanelBody>

                            { areoi.ResponsiveTabPanel( tabDevice ) }
                                
                        </areoi.editor.InspectorControls>

                        <areoi.editor.InnerBlocks template={ BLOCKS_TEMPLATE } allowedBlocks={ ALLOWED_BLOCKS } />
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
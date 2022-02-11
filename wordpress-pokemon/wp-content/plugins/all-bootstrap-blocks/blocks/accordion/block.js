import * as areoi from '../_components/Core.js';
import meta from './block.json';

const ALLOWED_BLOCKS = [ 'areoi/accordion-item' ];
const BLOCKS_TEMPLATE = [
    [ 'areoi/accordion-item', {} ],
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
            'accordion',
            attributes.flush
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
                { areoi.DisplayPreview( areoi, attributes, onChange, 'accordion' ) }

                { !attributes.preview &&
                    <div { ...blockProps }>
                        <areoi.editor.InspectorControls key="setting">

                            <areoi.components.PanelBody title={ 'Settings' } initialOpen={ false }>
                                <areoi.components.PanelRow>
                                    <areoi.components.SelectControl
                                        label="Flush"
                                        labelPosition="top"
                                        help="Add .accordion-flush to remove the default background-color, some borders, and some rounded corners to render accordions edge-to-edge with their parent container."
                                        value={ attributes.flush }
                                        options={ [
                                            { label: 'Default', value: null },
                                            { label: 'Flush', value: 'accordion-flush' },
                                        ] }
                                        onChange={ ( value ) => onChange( 'flush', value ) }
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
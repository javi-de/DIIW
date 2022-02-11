import * as areoi from '../_components/Core.js';
import meta from './block.json';

const ALLOWED_BLOCKS = [ 'areoi/list-group-item' ];
const BLOCKS_TEMPLATE = [
    [ 'areoi/list-group-item', {} ],
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
            'list-group',
            attributes.flush,
            attributes.style,
            attributes.layout,
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
                { areoi.DisplayPreview( areoi, attributes, onChange, 'list-group' ) }

                { !attributes.preview &&
                    <div { ...blockProps }>
                        <areoi.editor.InspectorControls key="setting">

                            <areoi.components.PanelBody title={ 'Settings' } initialOpen={ false }>
                                <areoi.components.PanelRow className="areoi-panel-row">
                                    <areoi.components.SelectControl
                                        label="Flush"
                                        labelPosition="top"
                                        help="Add .list-group-flush to remove some borders and rounded corners to render list group items edge-to-edge in a parent container (e.g., cards)."
                                        value={ attributes.flush }
                                        options={ [
                                            { label: 'Default', value: null },
                                            { label: 'Flush', value: 'list-group-flush' },
                                        ] }
                                        onChange={ ( value ) => onChange( 'flush', value ) }
                                    />
                                </areoi.components.PanelRow>

                                <areoi.components.PanelRow>
                                    <areoi.components.SelectControl
                                        label="Layout"
                                        labelPosition="top"
                                        help="Add .list-group-horizontal to change the layout of list group items from vertical to horizontal across all breakpoints."
                                        value={ attributes.layout }
                                        options={ [
                                            { label: 'Default', value: null },
                                            { label: 'Horizontal', value: 'list-group-horizontal' },
                                        ] }
                                        onChange={ ( value ) => onChange( 'layout', value ) }
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
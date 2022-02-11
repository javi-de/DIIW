import * as areoi from '../_components/Core.js';
import meta from './block.json';

const ALLOWED_BLOCKS = [ 'areoi/card-header', 'areoi/card-body', 'areoi/card-footer', 'areoi/list-group', 'core/image', 'core/video' ];
const BLOCKS_TEMPLATE = [
    [ 'areoi/card-header', {} ],
    [ 'areoi/card-body', {} ],
    [ 'areoi/card-footer', {} ]
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
            'card',
            attributes.background,
            attributes.text_color,
            attributes.border_color
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
                { areoi.DisplayPreview( areoi, attributes, onChange, 'card' ) }

                { !attributes.preview &&
                    <div { ...blockProps }>
                        <areoi.editor.InspectorControls key="setting">

                            <areoi.components.PanelBody title={ 'Settings' } initialOpen={ false }>
                                { areoi.Colors( areoi, attributes, onChange ) }
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
});
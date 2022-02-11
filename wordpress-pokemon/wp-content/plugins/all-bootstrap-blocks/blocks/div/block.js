import * as areoi from '../_components/Core.js';
import meta from './block.json';

const ALLOWED_BLOCKS = null;
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
            'div'
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
                    { areoi.DeviceLayout( areoi, attributes, onChange, tab ) }

                    { areoi.DeviceBackground( areoi, attributes, onChange, tab ) }
                </div>
            );
        };

        return (
            <>
                { areoi.DisplayPreview( areoi, attributes, onChange, 'div' ) }
                {
                    !attributes.preview &&
                    <div { ...blockProps }>
                        <areoi.editor.InspectorControls key="setting">

                            { areoi.Background( areoi, attributes, onChange ) }

                            { areoi.ResponsiveTabPanel( tabDevice ) }
                                
                        </areoi.editor.InspectorControls>

                        { areoi.DisplayBackground( areoi, attributes ) }

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
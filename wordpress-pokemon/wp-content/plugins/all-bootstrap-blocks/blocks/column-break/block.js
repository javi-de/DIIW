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
            'w-100'
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
                <areoi.components.PanelBody title={ 'Display (' + tab.title + ')' } initialOpen={ false }>
                    <areoi.components.ToggleControl 
                        label={ 'Hide on ' + tab.title }
                        help={ 'Hide this block on ' + tab.title + ' devices. This will only hide the block from this specific device unless you alter the setting on each device.' }
                        checked={ attributes['hide_' + tab.name] }
                        onChange={ ( value ) => onChange( 'hide_' + tab.name, value ) }
                    />
                </areoi.components.PanelBody>
            );
        };
 
        return (
            <>
                { areoi.DisplayPreview( areoi, attributes, onChange, 'column-break' ) }

                {
                    !attributes.preview &&
                    <div { ...blockProps }>
                        <areoi.editor.InspectorControls key="setting">

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
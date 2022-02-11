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
            'breadcrumb',
        ];

        const blockProps = areoi.editor.useBlockProps( {
            className: areoi.helper.GetClassName( classes ),
            style: { cssText: areoi.helper.GetStyles( attributes ) + '--bs-breadcrumb-divider: \'' + attributes.divider + '\';' }
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
                { areoi.DisplayPreview( areoi, attributes, onChange, 'breadcrumb' ) }

                { !attributes.preview &&
                    <div { ...blockProps }>
                        <areoi.editor.InspectorControls key="setting">

                            <areoi.components.PanelBody title={ 'Settings' } initialOpen={ false }>
                                <areoi.components.PanelRow>
                                    <areoi.components.TextControl
                                        label="Divider"
                                        help="Dividers are automatically added in CSS through ::before and content. They can be changed by modifying a local CSS custom property --bs-breadcrumb-divider, or through the $breadcrumb-divider Sass variable — and $breadcrumb-divider-flipped for its RTL counterpart, if needed. We default to our Sass variable, which is set as a fallback to the custom property. This way, you get a global divider that you can override without recompiling CSS at any time."
                                        value={ attributes.divider }
                                        onChange={ ( value ) => onChange( 'divider', value ) }
                                    />
                                </areoi.components.PanelRow>

                            </areoi.components.PanelBody>

                            { areoi.ResponsiveTabPanel( tabDevice ) }
                                
                        </areoi.editor.InspectorControls>

                       
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">About</li>
                        </ol>
        
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
import * as areoi from '../_components/Core.js';
import meta from './block.json';

const ALLOWED_BLOCKS = [ 'areoi/toast-header', 'areoi/toast-body' ];
const BLOCKS_TEMPLATE = [
    [ 'areoi/toast-header', {} ],
    [ 'areoi/toast-body', {} ],
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
            'toast',
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

        return (
            <>
                { areoi.DisplayPreview( areoi, attributes, onChange, 'toast' ) }

                { !attributes.preview &&
                    <div { ...blockProps }>
                        <areoi.editor.InspectorControls key="setting">

                            <areoi.components.PanelBody title={ 'Settings' } initialOpen={ false }>

                                <areoi.components.PanelRow className="areoi-panel-row">
                                    <areoi.components.SelectControl
                                        label="Placement"
                                        labelPosition="top"
                                        help="Place toasts with custom CSS as you need them. The top right is often used for notifications, as is the top middle. If you’re only ever going to show one toast at a time, put the positioning styles right on the .toast."
                                        value={ attributes.placement }
                                        options={ [
                                            { label: 'Top Left', value: 'top-0 start-0' },
                                            { label: 'Top Right', value: 'top-0 end-0' },
                                            { label: 'Bottom Right', value: 'bottom-0 end-0' },
                                            { label: 'Bottom Left', value: 'bottom-0 start-0' },
                                        ] }
                                        onChange={ ( value ) => onChange( 'placement', value ) }
                                    />
                                </areoi.components.PanelRow>

                                { areoi.Colors( areoi, attributes, onChange ) }

                            </areoi.components.PanelBody>
                                
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
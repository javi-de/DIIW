import * as areoi from '../_components/Core.js';
import meta from './block.json';

const ALLOWED_BLOCKS = [ 'areoi/row' ];

const BLOCKS_TEMPLATE = [
    [ 'areoi/row', {}, [
        [ 'areoi/column', {} ]
    ] ],
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
            attributes.container
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
                { areoi.DisplayPreview( areoi, attributes, onChange, 'container' ) }
                {
                    !attributes.preview &&
                    <div { ...blockProps }>
                        <areoi.editor.InspectorControls key="setting">

                            <areoi.components.PanelBody title={ 'Settings' } initialOpen={ false }>
                                <areoi.components.PanelRow>
                                    <areoi.components.SelectControl
                                        label="Container"
                                        labelPosition="top"
                                        help="Bootstrap has 3 container types: .container, which sets a max-width at each responsive breakpoint; .container-fluid, which is width: 100% at all breakpoints; and .container-{breakpoint}, which is width: 100% until the specified breakpoint."
                                        value={ attributes.container }
                                        options={ [
                                            { label: '.container', value: 'container' },
                                            { label: '.container-sm', value: 'container-sm' },
                                            { label: '.container-md', value: 'container-md' },
                                            { label: '.container-lg', value: 'container-lg' },
                                            { label: '.container-xl', value: 'container-xl' },
                                            { label: '.container-xxl', value: 'container-xxl' },
                                            { label: '.container-fluid', value: 'container-fluid' },
                                        ] }
                                        onChange={ ( newContainer ) => onChange( 'container', newContainer ) }
                                    />
                                </areoi.components.PanelRow>
                            </areoi.components.PanelBody>

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
} );
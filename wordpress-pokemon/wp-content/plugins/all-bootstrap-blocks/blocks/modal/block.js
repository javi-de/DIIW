import * as areoi from '../_components/Core.js';
import meta from './block.json';

const ALLOWED_BLOCKS = [ 'areoi/modal-header', 'areoi/modal-body', 'areoi/modal-footer' ];
const BLOCKS_TEMPLATE = [
    [ 'areoi/modal-header', {} ],
    [ 'areoi/modal-body', {} ],
    [ 'areoi/modal-footer', {} ],
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
            'modal',
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
                { areoi.DisplayPreview( areoi, attributes, onChange, 'modal' ) }

                { !attributes.preview &&
                    <div { ...blockProps }>
                        <areoi.editor.InspectorControls key="setting">

                            <areoi.components.PanelBody title={ 'Settings' } initialOpen={ false }>

                                <areoi.components.PanelRow className="areoi-panel-row">
                                    <areoi.components.SelectControl
                                        label="Backdrop"
                                        labelPosition="top"
                                        help="When backdrop is set to static, the modal will not close when clicking outside it. Click the button below to try it."
                                        value={ attributes.backdrop }
                                        options={ [
                                            { label: 'Default', value: null },
                                            { label: 'Static', value: 'static' },
                                        ] }
                                        onChange={ ( value ) => onChange( 'backdrop', value ) }
                                    />
                                </areoi.components.PanelRow>

                                <areoi.components.PanelRow className="areoi-panel-row">
                                    <areoi.components.SelectControl
                                        label="Scrollable Dialog"
                                        labelPosition="top"
                                        help="You can also create a scrollable modal that allows scroll the modal body by adding .modal-dialog-scrollable to .modal-dialog."
                                        value={ attributes.scrollable }
                                        options={ [
                                            { label: 'Default', value: null },
                                            { label: 'Scrollable', value: 'modal-dialog-scrollable' },
                                        ] }
                                        onChange={ ( value ) => onChange( 'scrollable', value ) }
                                    />
                                </areoi.components.PanelRow>

                                <areoi.components.PanelRow>
                                    <areoi.components.SelectControl
                                        label="Vertically Centered Dialog"
                                        labelPosition="top"
                                        help="Add .modal-dialog-centered to .modal-dialog to vertically center the modal."
                                        value={ attributes.centered }
                                        options={ [
                                            { label: 'Default', value: null },
                                            { label: 'Centered', value: 'modal-dialog-centered' },
                                        ] }
                                        onChange={ ( value ) => onChange( 'centered', value ) }
                                    />
                                </areoi.components.PanelRow>

                            </areoi.components.PanelBody>
                                
                        </areoi.editor.InspectorControls>

                        <div class="modal-dialog">
                            <div class="modal-content">
                                <areoi.editor.InnerBlocks template={ BLOCKS_TEMPLATE } allowedBlocks={ ALLOWED_BLOCKS } />
                            </div>
                        </div>
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
import * as areoi from '../_components/Core.js';
import meta from './block.json';

const ALLOWED_BLOCKS = [ 
    'areoi/column', 
    'areoi/column-break' 
];

const BLOCKS_TEMPLATE = [
    [ 'areoi/column', {} ],
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
            'row',
            attributes.vertical_align_xs,
            attributes.vertical_align_sm,
            attributes.vertical_align_md,
            attributes.vertical_align_lg,
            attributes.vertical_align_xl,
            attributes.vertical_align_xxl,

            attributes.horizontal_align_xs,
            attributes.horizontal_align_sm,
            attributes.horizontal_align_md,
            attributes.horizontal_align_lg,
            attributes.horizontal_align_xl,
            attributes.horizontal_align_xxl,

            attributes.row_cols_xs,
            attributes.row_cols_sm,
            attributes.row_cols_md,
            attributes.row_cols_lg,
            attributes.row_cols_xl,
            attributes.row_cols_xxl
        ];

        const blockProps = areoi.editor.useBlockProps( {
            className: areoi.helper.GetClassName( classes ),
            style: { cssText: areoi.helper.GetStyles( attributes ) }
        } );

        function onChange( key, value ) {
            setAttributes( { [key]: value } );
        }

        const tabDevice = ( tab ) => {
            var append = ( tab.name == 'xs' ? '' : '-' + tab.name );

            return (
                <div>

                    { areoi.DeviceLayout( areoi, attributes, onChange, tab ) }
                    
                    { !attributes['hide_' + tab.name] &&
                        <areoi.components.PanelBody title={ 'Settings (' + tab.title + ')' } initialOpen={ false }>                        
                            
                            <areoi.components.PanelRow className="areoi-panel-row">
                                <areoi.components.SelectControl
                                    label="Vertical Align"
                                    labelPosition="top"
                                    help="Align content within row from top to bottom. This will be applied to all greater device sizes unless overridden."
                                    value={ attributes['vertical_align_' + tab.name] }
                                    options={ [
                                        { label: 'Default', value: null },
                                        { label: 'Start', value: 'align-items' + append + '-start' },
                                        { label: 'Center', value: 'align-items' + append + '-center' },
                                        { label: 'End', value: 'align-items' + append + '-end' },
                                    ] }
                                    onChange={ ( value ) => onChange( 'vertical_align_' + tab.name, value ) }
                                />
                            </areoi.components.PanelRow>

                            <areoi.components.PanelRow className="areoi-panel-row">
                                <areoi.components.SelectControl
                                    label="Horizontal Align"
                                    labelPosition="top"
                                    help="Align content within row from left to right. This will be applied to all greater device sizes unless overridden."
                                    value={ attributes['horizontal_align_' + tab.name] }
                                    options={ [
                                        { label: 'Default', value: null },
                                        { label: 'Start', value: 'justify-content' + append + '-start' },
                                        { label: 'Center', value: 'justify-content' + append + '-center' },
                                        { label: 'End', value: 'justify-content' + append + '-end' },
                                        { label: 'Around', value: 'justify-content' + append + '-around' },
                                        { label: 'Between', value: 'justify-content' + append + '-between' },
                                        { label: 'Evenly', value: 'justify-content' + append + '-evenly' },
                                    ] }
                                    onChange={ ( value ) => onChange( 'horizontal_align_' + tab.name, value ) }
                                />
                            </areoi.components.PanelRow>

                            <areoi.components.PanelRow>
                                <areoi.components.SelectControl
                                    label="Row Columns"
                                    labelPosition="top"
                                    help="Use the responsive .row-cols-* classes to quickly set the number of columns that best render your content and layout."
                                    value={ attributes['row_cols_' + tab.name] }
                                    options={ areoi.helper.GetCols( 'row-cols', tab.name ) }
                                    onChange={ ( value ) => onChange( 'row_cols_' + tab.name, value ) }
                                />
                            </areoi.components.PanelRow>
                        </areoi.components.PanelBody>
                    }                    

                </div>
            );
        };
 
        return (
            <>
                { areoi.DisplayPreview( areoi, attributes, onChange, 'row' ) }
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
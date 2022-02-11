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
            'progress'
        ];

        const bar_classes = [
            'progress-bar',
            attributes.background,
            attributes.striped ? 'progress-bar-striped' : '',
            attributes.animated ? 'progress-bar-animated' : ''
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
                </div>
            );
        };
 
        return (
            <>
                { areoi.DisplayPreview( areoi, attributes, onChange, 'progress' ) }

                { !attributes.preview &&
                    <div { ...blockProps }>
                        <areoi.editor.InspectorControls key="setting">

                            <areoi.components.PanelBody title={ 'Settings' } initialOpen={ false }>

                                <areoi.components.PanelRow className="areoi-panel-row">
                                    <label className="areoi-panel-row__label">Width</label>
                                    <table>
                                        <tr>
                                            <td>
                                                <areoi.components.TextControl
                                                    label="Dimensions"
                                                    value={ attributes['width'] }
                                                    onChange={ ( value ) => onChange( 'width', value ) }
                                                />
                                            </td>
                                            <td>
                                                %
                                            </td>
                                        </tr>
                                    </table>
                                    <p className="components-base-control__help css-1gbp77-StyledHelp">Specify the width of the inner progress bar.</p>
                                </areoi.components.PanelRow>

                                <areoi.components.PanelRow className="areoi-panel-row">
                                    <areoi.components.ToggleControl 
                                        label={ 'Include Label' }
                                        help="Add labels to your progress bars by placing text within the .progress-bar."
                                        checked={ attributes['label'] }
                                        onChange={ ( value ) => onChange( 'label', value ) }
                                    />
                                </areoi.components.PanelRow>

                                <areoi.components.PanelRow className="areoi-panel-row">
                                    <areoi.components.ToggleControl 
                                        label={ 'Include Stripes' }
                                        help="Add .progress-bar-striped to any .progress-bar to apply a stripe via CSS gradient over the progress bar’s background color."
                                        checked={ attributes['striped'] }
                                        onChange={ ( value ) => onChange( 'striped', value ) }
                                    />
                                </areoi.components.PanelRow>

                                <areoi.components.PanelRow className="areoi-panel-row">
                                    <areoi.components.ToggleControl 
                                        label={ 'Include Animation' }
                                        help="The striped gradient can also be animated. Add .progress-bar-animated to .progress-bar to animate the stripes right to left via CSS3 animations."
                                        checked={ attributes['animated'] }
                                        onChange={ ( value ) => onChange( 'animated', value ) }
                                    />
                                </areoi.components.PanelRow>

                                <areoi.components.PanelRow>
                                    <areoi.components.SelectControl
                                        label="Background"
                                        labelPosition="top"
                                        help="Use background utility classes to change the appearance of individual progress bars."
                                        value={ attributes.background }
                                        options={ [
                                            { label: 'Default', value: null },
                                            { label: 'Primary', value: 'bg-primary' },
                                            { label: 'Secondary', value: 'bg-secondary' },
                                            { label: 'Success', value: 'bg-success' },
                                            { label: 'Danger', value: 'bg-danger' },
                                            { label: 'Warning', value: 'bg-warning' },
                                            { label: 'Info', value: 'bg-info' },
                                            { label: 'Light', value: 'bg-light' },
                                            { label: 'Dark', value: 'bg-dark' },
                                        ] }
                                        onChange={ ( value ) => onChange( 'background', value ) }
                                    />
                                </areoi.components.PanelRow>

                            </areoi.components.PanelBody>

                            { areoi.ResponsiveTabPanel( tabDevice ) }
                                
                        </areoi.editor.InspectorControls>

                        <div style={{ width: attributes.width + '%' } } className={ areoi.helper.GetClassNameStr( bar_classes ) }>
                            { attributes.label ? attributes.width + '%' : '' }
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
} );
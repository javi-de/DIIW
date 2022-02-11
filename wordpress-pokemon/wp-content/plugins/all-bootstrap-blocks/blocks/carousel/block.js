import * as areoi from '../_components/Core.js';
import meta from './block.json';

const ALLOWED_BLOCKS = [ 'areoi/carousel-item' ];
const BLOCKS_TEMPLATE = [
    [ 'areoi/carousel-item', {} ],
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
            'carousel',
            attributes.style,
            attributes.transition
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
                { areoi.DisplayPreview( areoi, attributes, onChange, 'carousel' ) }

                { !attributes.preview &&
                    <div { ...blockProps }>
                        <areoi.editor.InspectorControls key="setting">

                            <areoi.components.PanelBody title={ 'Settings' } initialOpen={ false }>
                                
                                <areoi.components.PanelRow className="areoi-panel-row">
                                    <areoi.components.ToggleControl 
                                        label={ 'Display Controls' }
                                        help="Adding in the previous and next controls"
                                        checked={ attributes.controls }
                                        onChange={ ( value ) => onChange( 'controls', value ) }
                                    />
                                </areoi.components.PanelRow>

                                <areoi.components.PanelRow className="areoi-panel-row">
                                    <areoi.components.ToggleControl 
                                        label={ 'Display Indicators' }
                                        help="You can also add the indicators to the carousel, alongside the controls, too."
                                        checked={ attributes.indicators }
                                        onChange={ ( value ) => onChange( 'indicators', value ) }
                                    />
                                </areoi.components.PanelRow>

                                <areoi.components.PanelRow className="areoi-panel-row">
                                    <areoi.components.ToggleControl 
                                        label={ 'Touch Enabled' }
                                        help="Carousels support swiping left and right on touchscreen devices to move between slides. This can be disabled using the data-bs-touch attribute"
                                        checked={ attributes.touch }
                                        onChange={ ( value ) => onChange( 'touch', value ) }
                                    />
                                </areoi.components.PanelRow>

                                <areoi.components.PanelRow className="areoi-panel-row">
                                    <areoi.components.ToggleControl 
                                        label={ 'Auto Scroll' }
                                        help="Set to true if you want the carousel to automatically scroll between slides."
                                        checked={ attributes.interval }
                                        onChange={ ( value ) => onChange( 'interval', value ) }
                                    />
                                </areoi.components.PanelRow>

                                <areoi.components.PanelRow className="areoi-panel-row">
                                    <areoi.components.SelectControl
                                        label="Style"
                                        labelPosition="top"
                                        help="Add .carousel-dark to the .carousel for darker controls, indicators, and captions. Controls have been inverted from their default white fill with the filter CSS property. Captions and controls have additional Sass variables that customize the color and background-color."
                                        value={ attributes.style }
                                        options={ [
                                            { label: 'Default', value: null },
                                            { label: 'Dark', value: 'carousel-dark' },
                                        ] }
                                        onChange={ ( value ) => onChange( 'style', value ) }
                                    />
                                </areoi.components.PanelRow>

                                <areoi.components.PanelRow>
                                    <areoi.components.SelectControl
                                        label="Transition"
                                        labelPosition="top"
                                        help="Add .carousel-fade to your carousel to animate slides with a fade transition instead of a slide."
                                        value={ attributes.transition }
                                        options={ [
                                            { label: 'Default', value: null },
                                            { label: 'Crossfade', value: 'carousel-fade' },
                                        ] }
                                        onChange={ ( value ) => onChange( 'transition', value ) }
                                    />
                                </areoi.components.PanelRow>

                            </areoi.components.PanelBody>

                            { areoi.ResponsiveTabPanel( tabDevice ) }
                                
                        </areoi.editor.InspectorControls>

                        {
                            attributes.controls &&
                            <>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </>
                        }

                        {
                            attributes.indicators &&
                            <>
                                <div class="carousel-indicators">
                                    <button type="button" class="active" aria-current="true" aria-label="Slide 1" data-bs-target></button>
                                    <button type="button" aria-label="Slide 2" data-bs-target></button>
                                    <button type="button" aria-label="Slide 3" data-bs-target></button>
                                </div>
                            </>
                        }

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
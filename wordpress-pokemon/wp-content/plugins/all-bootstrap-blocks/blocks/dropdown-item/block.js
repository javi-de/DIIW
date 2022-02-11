import * as areoi from '../_components/Core.js';
import meta from './block.json';

const ALLOWED_BLOCKS = null;
const BLOCKS_TEMPLATE = null;
const NEW_TAB_REL = 'noreferrer noopener';

areoi.blocks.registerBlockType( meta, {
    icon: areoi.blockIcon,
    edit: props => {

        const {
            attributes,
            setAttributes,
            className,
            isSelected,
            onReplace,
            mergeBlocks,
            clientId
        } = props;

        const { block_id } = attributes;
        if ( !block_id || ( block_id != clientId ) ) {
            setAttributes( { block_id: clientId } );
        }

        const classes = [
            attributes.type,
            attributes.active ? 'active' : ''
        ];

        const {
            linkTarget,
            rel,
            text,
            url,
        } = attributes;
        const onSetLinkRel = areoi.element.useCallback(
            ( value ) => {
                setAttributes( { rel: value } );
            },
            [ setAttributes ]
        );

        const onToggleOpenInNewTab = areoi.element.useCallback(
            ( value ) => {
                const newLinkTarget = value ? '_blank' : undefined;

                let updatedRel = rel;
                if ( newLinkTarget && ! rel ) {
                    updatedRel = NEW_TAB_REL;
                } else if ( ! newLinkTarget && rel === NEW_TAB_REL ) {
                    updatedRel = undefined;
                }

                setAttributes( {
                    linkTarget: newLinkTarget,
                    rel: updatedRel,
                } );
            },
            [ rel, setAttributes ]
        );

        const setButtonText = ( newText ) => {
            // Remove anchor tags from button text content.
            setAttributes( { text: newText.replace( /<\/?a[^>]*>/g, '' ) } );
        };

        const ref = areoi.element.useRef();
        const richTextRef = areoi.element.useRef();
        const blockProps = areoi.editor.useBlockProps( {
            ref,
            className: classes
        } );
        const btnProps = {
            className: areoi.helper.GetClassNameStr( classes ),
            style: { cssText: areoi.helper.GetStyles( attributes ) }
        };

        function onChange( key, value ) {
            setAttributes( { [key]: value } );
        }
 
        return (
            <>
                { areoi.DisplayPreview( areoi, attributes, onChange, 'dropdown-item' ) }

                { !attributes.preview &&
                    <>
                        <div { ...blockProps }>
                            <areoi.editor.InspectorControls key="setting">

                                <areoi.components.PanelBody title={ 'Settings' } initialOpen={ false }>
                                    <areoi.components.PanelRow className="areoi-panel-row">
                                        <areoi.components.SelectControl
                                            label="Type"
                                            labelPosition="top"
                                            help="Choose how you would like the item to be displayed."
                                            value={ attributes.type }
                                            options={ [
                                                { label: 'Link', value: 'dropdown-item' },
                                                { label: 'Header', value: 'dropdown-header' },
                                                { label: 'Divider', value: 'dropdown-divider' },
                                                { label: 'Text', value: 'p-3' },
                                            ] }
                                            onChange={ ( value ) => onChange( 'type', value ) }
                                        />
                                    </areoi.components.PanelRow>

                                    <areoi.components.PanelRow className="areoi-panel-row">
                                        <areoi.components.ToggleControl 
                                            label={ 'Active' }
                                            help="Add .active to items in the dropdown to style them as active. "
                                            checked={ attributes['active'] }
                                            onChange={ ( value ) => onChange( 'active', value ) }
                                        />
                                    </areoi.components.PanelRow>

                                    <areoi.components.PanelRow>
                                        <areoi.components.ToggleControl 
                                            label={ 'Disabled' }
                                            help="Add .disabled to items in the dropdown to style them as disabled."
                                            checked={ attributes['disabled'] }
                                            onChange={ ( value ) => onChange( 'disabled', value ) }
                                        />
                                    </areoi.components.PanelRow>

                                </areoi.components.PanelBody>
                                    
                            </areoi.editor.InspectorControls>

                            {
                                attributes.type != 'dropdown-divider' &&
                                <areoi.editor.RichText
                                    ref={ richTextRef }
                                    aria-label={ areoi.__( 'Button text' ) }
                                    placeholder={ areoi.__( 'Add text…' ) }
                                    value={ text }
                                    onChange={ ( value ) => setButtonText( value ) }
                                    withoutInteractiveFormatting
                                    onSplit={ ( value ) =>
                                        createBlock( 'areoi/button', {
                                            ...attributes,
                                            text: value,
                                        } )
                                    }
                                    onReplace={ onReplace }
                                    onMerge={ mergeBlocks }
                                    identifier="text"
                                />
                            }
                                
                        </div>

                        <areoi.URLPicker
                            areoi={ areoi }
                            url={ url }
                            setAttributes={ setAttributes }
                            isSelected={ isSelected }
                            opensInNewTab={ linkTarget === '_blank' }
                            onToggleOpenInNewTab={ onToggleOpenInNewTab }
                            anchorRef={ ref }
                            richTextRef={ richTextRef }
                        />
                    </>
                }
            </>
        );
    },
    save: ({ attributes, className }) => { 
        return (
            <areoi.editor.InnerBlocks.Content/>
        );
    },
} );
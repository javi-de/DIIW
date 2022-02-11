import * as areoi from '../_components/Core.js';
import meta from './block.json';

const ALLOWED_BLOCKS = [ 'areoi/dropdown-item' ];
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
            'btn',
            attributes.style,
            attributes.size,
            attributes.dropdown ? 'dropdown-toggle' : ''
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
        } );
        const btnProps = {
            className: areoi.helper.GetClassNameStr( classes ),
            style: { cssText: areoi.helper.GetStyles( attributes ) }
        };

        function onChange( key, value ) {
            setAttributes( { [key]: value } );
        }

        const tabDevice = ( tab ) => {
            return (
                <div>
                    <areoi.components.PanelBody title={ 'Display (' + tab.title + ')' } initialOpen={ false }>
                        <areoi.components.PanelRow className="areoi-panel-row">
                            <areoi.components.ToggleControl 
                                label={ 'Hide on ' + tab.title }
                                help={ 'Hide this block on ' + tab.title + ' devices. This will only hide the block from this specific device unless you alter the setting on each device.' }
                                checked={ attributes['hide_' + tab.name] }
                                onChange={ ( value ) => onChange( 'hide_' + tab.name, value ) }
                            />
                        </areoi.components.PanelRow>

                        <areoi.components.PanelRow>
                            <areoi.components.ToggleControl 
                                label={ 'Display Block on ' + tab.title }
                                help="Make the button 100% width on this device. This will only display block the button from this specific device unless you alter the setting on each device."
                                checked={ attributes['block_' + tab.name] }
                                onChange={ ( value ) => onChange( 'block_' + tab.name, value ) }
                            />
                        </areoi.components.PanelRow>
                    </areoi.components.PanelBody>
                </div>
            );
        };
 
        return (
            <>
                { areoi.DisplayPreview( areoi, attributes, onChange, 'button' ) }

                { !attributes.preview &&
                    <>
                        <div { ...blockProps }>
                            <areoi.editor.InspectorControls key="setting">

                                <areoi.components.PanelBody title={ 'Settings' } initialOpen={ false }>
                                    <areoi.components.PanelRow className="areoi-panel-row">
                                        <areoi.components.SelectControl
                                            label="Type"
                                            labelPosition="top"
                                            help="Choose the type of button element you would like to use."
                                            value={ attributes.type }
                                            options={ [
                                                { label: '<a>', value: 'a' },
                                                { label: '<button>', value: 'button' },
                                            ] }
                                            onChange={ ( value ) => onChange( 'type', value ) }
                                        />
                                    </areoi.components.PanelRow>

                                    <areoi.components.PanelRow className="areoi-panel-row">
                                        <areoi.components.SelectControl
                                            label="Style"
                                            labelPosition="top"
                                            help="Bootstrap includes several predefined button styles, each serving its own semantic purpose, with a few extras thrown in for more control."
                                            value={ attributes.style }
                                            options={ [
                                                { label: 'Default', value: 'btn-primary' },
                                                { label: 'Primary', value: 'btn-primary' },
                                                { label: 'Primary (Outline)', value: 'btn-outline-primary' },
                                                { label: 'Secondary', value: 'btn-secondary' },
                                                { label: 'Secondary (Outline)', value: 'btn-outline-secondary' },
                                                { label: 'Success', value: 'btn-success' },
                                                { label: 'Success (Outline)', value: 'btn-outline-success' },
                                                { label: 'Danger', value: 'btn-danger' },
                                                { label: 'Danger (Outline)', value: 'btn-outline-danger' },
                                                { label: 'Warning', value: 'btn-warning' },
                                                { label: 'Warning (Outline)', value: 'btn-outline-warning' },
                                                { label: 'Info', value: 'btn-info' },
                                                { label: 'Info (Outline)', value: 'btn-outline-info' },
                                                { label: 'Light', value: 'btn-light' },
                                                { label: 'Light (Outline)', value: 'btn-outline-light' },
                                                { label: 'Dark', value: 'btn-dark' },
                                                { label: 'Dark (Outline)', value: 'btn-outline-dark' },
                                            ] }
                                            onChange={ ( value ) => onChange( 'style', value ) }
                                        />
                                    </areoi.components.PanelRow>

                                    <areoi.components.PanelRow className="areoi-panel-row">
                                        <areoi.components.SelectControl
                                            label="Size"
                                            labelPosition="top"
                                            help="Fancy larger or smaller buttons? Add .btn-lg or .btn-sm for additional sizes."
                                            value={ attributes.size }
                                            options={ [
                                                { label: 'Default', value: null },
                                                { label: 'Small', value: 'btn-sm' },
                                                { label: 'Medium', value: null },
                                                { label: 'Large', value: 'btn-lg' },
                                            ] }
                                            onChange={ ( value ) => onChange( 'size', value ) }
                                        />
                                    </areoi.components.PanelRow>

                                    <areoi.components.PanelRow>
                                        <areoi.components.SelectControl
                                            label="Text Wrap"
                                            labelPosition="top"
                                            help="If you don’t want the button text to wrap, you can add the .text-nowrap class to the button."
                                            value={ attributes.text_wrap }
                                            options={ [
                                                { label: 'Default', value: null },
                                                { label: 'Wrap', value: null },
                                                { label: 'No Wrap', value: 'text-nowrap' }
                                            ] }
                                            onChange={ ( value ) => onChange( 'text_wrap', value ) }
                                        />
                                    </areoi.components.PanelRow>                                    

                                </areoi.components.PanelBody>

                                <areoi.components.PanelBody title={ 'Additional' } initialOpen={ false }>

                                    <areoi.components.PanelRow className={ 'areoi-panel-row' }>
                                        <areoi.components.ToggleControl 
                                            label={ 'Include Badge' }
                                            help="Badges are mainly used to highlight new or unread items"
                                            checked={ attributes.badge }
                                            onChange={ ( value ) => onChange( 'badge', value ) }
                                        />
                                    </areoi.components.PanelRow>

                                    {
                                        !attributes.tooltip && !attributes.dropdown &&
                                        <areoi.components.PanelRow className={ !attributes.popover ? 'areoi-panel-row' : '' }>
                                            <areoi.components.ToggleControl 
                                                label={ 'Include Popover' }
                                                help="Popovers are generally used to display additional information about any element and are displayed on click of mouse pointer over that element."
                                                checked={ attributes.popover }
                                                onChange={ ( value ) => onChange( 'popover', value ) }
                                            />
                                        </areoi.components.PanelRow>
                                    }

                                    {
                                        !attributes.popover && !attributes.dropdown &&
                                        <areoi.components.PanelRow className={ !attributes.tooltip ? 'areoi-panel-row' : '' }>
                                            <areoi.components.ToggleControl 
                                                label={ 'Include Tooltip' }
                                                help="A small pop-up box that appears when the user moves the mouse pointer over an element"
                                                checked={ attributes.tooltip }
                                                onChange={ ( value ) => onChange( 'tooltip', value ) }
                                            />
                                        </areoi.components.PanelRow>
                                    } 

                                    {
                                        !attributes.popover && !attributes.tooltip &&
                                        <areoi.components.PanelRow>
                                            <areoi.components.ToggleControl 
                                                label={ 'Include Dropdown' }
                                                help="Toggle contextual overlays for displaying lists of links and more with the Bootstrap dropdown plugin."
                                                checked={ attributes.dropdown }
                                                onChange={ ( value ) => onChange( 'dropdown', value ) }
                                            />
                                        </areoi.components.PanelRow>
                                    }

                                </areoi.components.PanelBody>

                                {
                                    attributes.badge &&
                                    <areoi.components.PanelBody title={ 'Badge' } initialOpen={ false }>

                                        <areoi.components.PanelRow className="areoi-panel-row">
                                            <areoi.components.TextControl
                                                label="Badge Content"
                                                labelPosition="top"
                                                help="The content you wish to display in the badge. This is usually a number."
                                                value={ attributes.badge_content }
                                                onChange={ ( value ) => onChange( 'badge_content', value ) }
                                            />
                                        </areoi.components.PanelRow>

                                        <areoi.components.PanelRow className="areoi-panel-row">
                                            <areoi.components.SelectControl
                                                label="Badge Style"
                                                labelPosition="top"
                                                help="Use the .rounded-pill utility class to make badges more rounded with a larger border-radius."
                                                value={ attributes.badge_style }
                                                options={ [
                                                    { label: 'Default', value: 'bg-primary' },
                                                    { label: 'Rounded', value: 'rounded-pill' },
                                                ] }
                                                onChange={ ( value ) => onChange( 'badge_style', value ) }
                                            />
                                        </areoi.components.PanelRow>

                                        <areoi.components.PanelRow className="areoi-panel-row">
                                            <areoi.components.SelectControl
                                                label="Badge Background"
                                                labelPosition="top"
                                                help="Use our background utility classes to quickly change the appearance of a badge. Please note that when using Bootstrap’s default .bg-light, you’ll likely need a text color utility like .text-dark for proper styling."
                                                value={ attributes.badge_background }
                                                options={ [
                                                    { label: 'Default', value: 'bg-primary' },
                                                    { label: 'Primary', value: 'bg-primary' },
                                                    { label: 'Secondary', value: 'bg-secondary' },
                                                    { label: 'Success', value: 'bg-success' },
                                                    { label: 'Danger', value: 'bg-danger' },
                                                    { label: 'Warning', value: 'bg-warning' },
                                                    { label: 'Info', value: 'bg-info' },
                                                    { label: 'Light', value: 'bg-light' },
                                                    { label: 'Dark', value: 'bg-dark' },
                                                ] }
                                                onChange={ ( value ) => onChange( 'badge_background', value ) }
                                            />

                                        </areoi.components.PanelRow>

                                        <areoi.components.PanelRow className="areoi-panel-row">
                                            <areoi.components.SelectControl
                                                label="Badge Text Color"
                                                labelPosition="top"
                                                help="Use our tect color utility classes to quickly change the appearance of a badge."
                                                value={ attributes.badge_text_color }
                                                options={ [
                                                    { label: 'Default', value: 'text-primary' },
                                                    { label: 'Primary', value: 'text-primary' },
                                                    { label: 'Secondary', value: 'text-secondary' },
                                                    { label: 'Success', value: 'text-success' },
                                                    { label: 'Danger', value: 'text-danger' },
                                                    { label: 'Warning', value: 'text-warning' },
                                                    { label: 'Info', value: 'text-info' },
                                                    { label: 'Light', value: 'text-light' },
                                                    { label: 'Dark', value: 'text-dark' },
                                                ] }
                                                onChange={ ( value ) => onChange( 'badge_text_color', value ) }
                                            />
                                        </areoi.components.PanelRow>

                                        <areoi.components.PanelRow>
                                            <areoi.components.TextControl
                                                label="Additional Badge Classes"
                                                labelPosition="top"
                                                help="Use utilities to modify a .badge and position it in the corner of a link or button."
                                                value={ attributes.badge_classes }
                                                onChange={ ( value ) => onChange( 'badge_classes', value ) }
                                            />
                                        </areoi.components.PanelRow>

                                    </areoi.components.PanelBody>
                                }

                                {
                                    attributes.popover &&
                                    <areoi.components.PanelBody title={ 'Popover' } initialOpen={ false }>
                                    
                                        <areoi.components.TextControl
                                            label="Popover Title"
                                            labelPosition="top"
                                            help="Add the popover title content."
                                            value={ attributes.popover_title }
                                            onChange={ ( value ) => onChange( 'popover_title', value ) }
                                        />

                                        <areoi.components.TextareaControl
                                            label="Popover Content"
                                            labelPosition="top"
                                            help="Add the main body content for the popover."
                                            value={ attributes.popover_content }
                                            onChange={ ( value ) => onChange( 'popover_content', value ) }
                                        />

                                        <areoi.components.SelectControl
                                            label="Popover Direction"
                                            labelPosition="top"
                                            help="Four options are available: top, right, bottom, and left aligned. Directions are mirrored when using Bootstrap in RTL."
                                            value={ attributes.popover_direction }
                                            options={ [
                                                { label: 'Top', value: 'top' },
                                                { label: 'Right', value: 'right' },
                                                { label: 'Bottom', value: 'bottom' },
                                                { label: 'Left', value: 'left' },
                                            ] }
                                            onChange={ ( value ) => onChange( 'popover_direction', value ) }
                                        />

                                        <areoi.components.SelectControl
                                            label="Popover Trigger"
                                            labelPosition="top"
                                            help="By default a popover will be triggered when a user clicks on the element. But you can also set it so the trigger happens on hover."
                                            value={ attributes.popover_trigger }
                                            options={ [
                                                { label: 'Default', value: null },
                                                { label: 'Hover', value: 'hover' },
                                            ] }
                                            onChange={ ( value ) => onChange( 'popover_trigger', value ) }
                                        />

                                    </areoi.components.PanelBody>
                                }

                                {
                                    attributes.tooltip &&
                                    <areoi.components.PanelBody title={ 'Tooltip' } initialOpen={ false }>
                                    
                                        <areoi.components.PanelRow className="areoi-panel-row">
                                            <areoi.components.TextareaControl
                                                label="Tooltip Content"
                                                labelPosition="top"
                                                help="Add the content to be displayed within the tooltip."
                                                value={ attributes.tooltip_content }
                                                onChange={ ( value ) => onChange( 'tooltip_content', value ) }
                                            />
                                        </areoi.components.PanelRow>

                                        <areoi.components.PanelRow>
                                            <areoi.components.SelectControl
                                                label="Tooltip Direction"
                                                labelPosition="top"
                                                help="Four options are available: top, right, bottom, and left aligned. Directions are mirrored when using Bootstrap in RTL."
                                                value={ attributes.tooltip_direction }
                                                options={ [
                                                    { label: 'Top', value: 'top' },
                                                    { label: 'Right', value: 'right' },
                                                    { label: 'Bottom', value: 'bottom' },
                                                    { label: 'Left', value: 'left' },
                                                ] }
                                                onChange={ ( value ) => onChange( 'tooltip_direction', value ) }
                                            />
                                        </areoi.components.PanelRow>

                                    </areoi.components.PanelBody>
                                }

                                {
                                    attributes.dropdown &&
                                    <areoi.components.PanelBody title={ 'Dropdown' } initialOpen={ false }>
                                            
                                        <areoi.components.PanelRow className="areoi-panel-row">
                                            <areoi.components.SelectControl
                                                label="Dropdown Style"
                                                labelPosition="top"
                                                help="Opt into darker dropdowns to match a dark navbar or custom style by adding .dropdown-menu-dark onto an existing .dropdown-menu. No changes are required to the dropdown items."
                                                value={ attributes.dropdown_style }
                                                options={ [
                                                    { label: 'Default', value: null },
                                                    { label: 'Dark', value: 'dropdown-menu-dark' },
                                                ] }
                                                onChange={ ( value ) => onChange( 'dropdown_style', value ) }
                                            />
                                        </areoi.components.PanelRow>

                                        <areoi.components.PanelRow className="areoi-panel-row">
                                            <areoi.components.SelectControl
                                                label="Dropdown Auto Close"
                                                labelPosition="top"
                                                help="By default, the dropdown menu is closed when clicking inside or outside the dropdown menu. You can use the autoClose option to change this behavior of the dropdown."
                                                value={ attributes.dropdown_auto_close }
                                                options={ [
                                                    { label: 'True', value: 'true' },
                                                    { label: 'Inside', value: 'inside' },
                                                    { label: 'Outside', value: 'outside' },
                                                    { label: 'False', value: 'false' }
                                                ] }
                                                onChange={ ( value ) => onChange( 'dropdown_auto_close', value ) }
                                            />
                                        </areoi.components.PanelRow>

                                        <areoi.components.PanelRow className="areoi-panel-row">
                                            <areoi.components.SelectControl
                                                label="Dropdown Direction"
                                                labelPosition="top"
                                                help="Directions are mirrored when using Bootstrap in RTL, meaning .dropstart will appear on the right side."
                                                value={ attributes.dropdown_direction }
                                                options={ [
                                                    { label: 'Top', value: 'dropup' },
                                                    { label: 'Right', value: 'dropend' },
                                                    { label: 'Bottom', value: 'dropdown' },
                                                    { label: 'Left', value: 'dropstart' }
                                                ] }
                                                onChange={ ( value ) => onChange( 'dropdown_direction', value ) }
                                            />
                                        </areoi.components.PanelRow>

                                        <areoi.components.PanelRow>
                                            <areoi.components.SelectControl
                                                label="Dropdown Menu Alignment"
                                                labelPosition="top"
                                                help="Add .dropdown-menu-end to a .dropdown-menu to right align the dropdown menu. Directions are mirrored when using Bootstrap in RTL, meaning .dropdown-menu-end will appear on the left side."
                                                value={ attributes.dropdown_menu_alignment }
                                                options={ [
                                                    { label: 'Default', value: null },
                                                    { label: 'Right', value: 'dropdown-menu-end' },
                                                ] }
                                                onChange={ ( value ) => onChange( 'dropdown_menu_alignment', value ) }
                                            />
                                        </areoi.components.PanelRow>

                                    </areoi.components.PanelBody>
                                }

                                { areoi.ResponsiveTabPanel( tabDevice ) }
                                    
                            </areoi.editor.InspectorControls>

                            <div 
                                title={ attributes.popover_title }
                                data-bs-content={ attributes.popover_content }
                                data-bs-placement={ attributes.popover_placement }
                                data-bs-trigger={ 'focus ' + attributes.popover_trigger }
                                data-bs-toggle="popover"
                                className={ 'd-inline-block position-relative ' + ( attributes.dropdown ? attributes.dropdown_direction : '' ) }
                            >
                                <div { ...btnProps }>
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

                                    {
                                        attributes.badge &&
                                        <span
                                            className={ areoi.helper.GetClassNameStr( [
                                                'badge',
                                                attributes.badge_background,
                                                attributes.badge_text_color,
                                                attributes.badge_classes,
                                                attributes.badge_style
                                            ] ) }
                                        >
                                            { attributes.badge_content }
                                        </span>
                                    }
                                </div>

                                {
                                    attributes.dropdown &&
                                    <div class={ 'dropdown-menu ' + ( attributes.dropdown_style ?  attributes.dropdown_style + ' ' : '' ) +  + ( attributes.dropdown_menu_alignment ?  attributes.dropdown_menu_alignment + ' ' : '' ) }>
                                        <areoi.editor.InnerBlocks template={ BLOCKS_TEMPLATE } allowedBlocks={ ALLOWED_BLOCKS } />
                                    </div>
                                }
                            </div>
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
import { 
    TabPanel, 
} from '@wordpress/components';

const ResponsiveTabPanel = ( tabDevice ) => {
    return (
        <div>
            <div className="areoi-device-specific">
                <p><strong>Start Device Specific Settings</strong></p>
                <p>Device specific settings allow you to control elements across every device.</p>
            </div>
            <TabPanel
                className="responsive-tab-panel"
                activeClass="active-tab"
                tabs={ [
                    {
                        name: 'xs',
                        title: 'XS',
                        className: 'tab-xs',
                    },
                    {
                        name: 'sm',
                        title: 'SM',
                        className: 'tab-sm',
                    },
                    {
                        name: 'md',
                        title: 'MD',
                        className: 'tab-md',
                    },
                    {
                        name: 'lg',
                        title: 'LG',
                        className: 'tab-lg',
                    },
                    {
                        name: 'xl',
                        title: 'XL',
                        className: 'tab-xl',
                    },
                    {
                        name: 'xxl',
                        title: 'XXL',
                        className: 'tab-xxl',
                    },
                ] }
            >
            
                { ( tab ) => {
                    return tabDevice( tab );
                }}
            </TabPanel>
            <div className="areoi-device-specific">
                <strong>End Device Specific Settings</strong>
            </div>
        </div>
    );
}

export default ResponsiveTabPanel;
/**
 * WordPress Dependencies
 */

import { __ } from '@wordpress/i18n';
import { addFilter } from '@wordpress/hooks';
import { InspectorControls } from '@wordpress/block-editor';
import { ToggleControl, PanelBody } from '@wordpress/components';

function addAttributes(settings) {
    // If the block is not a table, return the original attributes
    if ('core/table' !== settings.name) {
        return settings;
    }

    // Set new attributes
    const extendTableAttributes = {
        headerColumn: {
            type: 'boolean',
            default: false
        },
        stickyHeaderRow: {
            type: 'boolean',
            default: false
        },
        stickyHeaderColumn: {
            type: 'boolean',
            default: false
        }
    }

    const tableSettings = {
        ...settings,
        attributes: {
            ...settings.attributes,
            ...extendTableAttributes
        }
    }

    return tableSettings;

}

addFilter(
    'blocks.registerBlockType',
    'caes-extend-core-blocks/add-attributes',
    addAttributes
)

/**
 * Add our new settings to the table block
 */

function addInspectorControls(BlockEdit) {
    return (props) => {
        if (props.name !== 'core/table') {
            return <BlockEdit {...props} />
        }
        const { attributes, setAttributes } = props;

        // console.log("Attributes", attributes);

        const { head, headerColumn, stickyHeaderRow, stickyHeaderColumn } = attributes;

        // Define classes based on toggled attributes
        const wrapperClasses = ['my-custom-wrapper'];
        if (stickyHeaderRow) {
            wrapperClasses.push('caes-sticky-header-row');
        }
        if (headerColumn) {
            wrapperClasses.push('caes-header-column');
        }
        if (stickyHeaderColumn) {
            wrapperClasses.push('caes-sticky-header-column');
        }

        // Check if head attribute is present
        const hasHeaderRow = !!head.length;
        
        if (!hasHeaderRow) {
            setAttributes({ stickyHeaderRow: false });
        }

        return (
            <>
                <BlockEdit {...props} />
                <InspectorControls>
                    <PanelBody
                        title={__('CAES Extended Settings', 'caes-extend-core-blocks')}>
                        {hasHeaderRow && ( // Only render if header row is present
                            <ToggleControl
                                label={__('Sticky header row')}
                                checked={stickyHeaderRow}
                                onChange={(value) => {
                                    setAttributes({ stickyHeaderRow: value });
                                }}
                            />
                        )}
                        <ToggleControl
                            label={__('Make left column a header')}
                            checked={headerColumn}
                            onChange={(value) => {
                                setAttributes({ headerColumn: value });
                                if (!value) {
                                    // If headerColumn is set to false, also set stickyHeaderColumn to false
                                    setAttributes({ stickyHeaderColumn: false });
                                }
                            }}
                        />
                        {headerColumn && ( // Only render if headerColumn is true
                            <ToggleControl
                                label={__('Sticky header column')}
                                checked={stickyHeaderColumn}
                                onChange={(value) => setAttributes({ stickyHeaderColumn: value })}
                            />
                        )}
                    </PanelBody>
                </InspectorControls>
            </>
        )

    }
}

addFilter(
    'editor.BlockEdit',
    'caes-extend-core-blocks/add-inspector-controls',
    addInspectorControls
)

// Add classes to table block in Editor

const { createHigherOrderComponent } = wp.compose;

const addEditorClasses = createHigherOrderComponent((BlockListBlock) => {
    return (props) => {
        if (props.name !== 'core/table') {
            return <BlockListBlock {...props} />
        }

        const { attributes } = props;
        const { headerColumn, stickyHeaderRow, stickyHeaderColumn } = attributes;

        // Define classes based on toggled attributes
        const classList = ['my-custom-wrapper'];
        if (stickyHeaderRow) {
            classList.push('caes-sticky-header-row');
        }
        if (headerColumn) {
            classList.push('caes-header-column');
        }
        if (stickyHeaderColumn) {
            classList.push('caes-sticky-header-column');
        }

        // Construct class string
        const classString = classList.join(' ');

        return <BlockListBlock {...props} className={classString} />;
    };
}, 'addEditorClasses');

wp.hooks.addFilter('editor.BlockListBlock', 'caes-extend-core-blocks', addEditorClasses);
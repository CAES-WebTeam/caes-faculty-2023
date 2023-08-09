/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */

import {
	useBlockProps,
	InspectorControls
} from '@wordpress/block-editor';
import {
	Panel,
	PanelBody,
	ToggleControl
} from '@wordpress/components';
import { useState } from '@wordpress/element';
/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * Gutenberg 2.8 added the <ServerSideRender> block which enables rendering to 
 * take place on the server using PHP rather than in JavaScript.
 */
import ServerSideRender from '@wordpress/server-side-render';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */

const HomeToggleControl = () => {
	const [hasHomepage, setHasHomepage] = useState(false);

	return (
		<ToggleControl
			label="Homepage breadcrumb"
			help={
				hasHomepage
					? 'Show homepage breadcrumb.'
					: 'Homepage breadcrumb is hidden.'
			}
			checked={hasHomepage}
			onChange={() => {
				setAttributes({ hasHomepage: !hasHomepage });
			}}
		/>
	);
};

const Edit = ({ attributes, setAttributes }) => {

	const { homepage } = attributes;

	return (
		<>
			<InspectorControls>
				<Panel>
					<PanelBody>
						<ToggleControl
							label="Homepage breadcrumb"
							help={
								homepage
									? 'Show homepage breadcrumb.'
									: 'Homepage breadcrumb is hidden.'
							}
							checked={homepage}
							onChange={() => {
								setAttributes({ homepage: !homepage });
							}}
						/>
					</PanelBody>
				</Panel>
			</InspectorControls>
			<div {...useBlockProps()}>
				{/* <ServerSideRender
				block="uga-caes/caes-fac-breadcrumbs"
				attributes={attributes}
			/> */}
				<p>
				Breadcrumbs will display here. {attributes.homepage ? '' : <em>Homepage breadcrumb is hidden.</em>}
				</p>
			</div>
		</>
	)
}

export default Edit;
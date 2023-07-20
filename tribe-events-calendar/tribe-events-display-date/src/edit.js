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
} from '@wordpress/block-editor';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */

import { useEntityProp } from '@wordpress/core-data';
import { useState, useEffect } from 'react';

export default function Edit({ attributes, setAttributes, context: { postType, postId } }) {
	const [formattedDate, setFormattedDate] = useState('');
	const [meta, updateMeta] = useEntityProp('postType', 'tribe_events', 'meta', postId);

	useEffect(() => {
		const startDateTime = new Date(meta._EventStartDate);
		const endDateTime = new Date(meta._EventEndDate);

		// Start year and end year
		const startYear = startDateTime.getFullYear();
		const endYear = endDateTime.getFullYear();

		// Start month and end month
		const startMonth = startDateTime.getMonth();
		const endMonth = endDateTime.getMonth();

		// Start day and end day
		const startDay = startDateTime.getDate();
		const endDay = endDateTime.getDate();

		// Current year
		const currentYear = new Date().getFullYear();

		if (startYear === endYear && startMonth === endMonth && startDay === endDay) {
			setFormattedDate(startDateTime.toLocaleString('en-US', {
				month: 'short',
				day: 'numeric',
				year: 'numeric',
			}));
		}
		else if (startYear === endYear && startMonth !== endMonth || startYear === endYear && startDay !== endDay) {
			setFormattedDate(`${startDateTime.toLocaleString('en-US', {
				month: 'short',
				day: 'numeric',
			})} – ${endDateTime.toLocaleString('en-US', {
				month: 'short',
				day: 'numeric',
				year: 'numeric',
			})}`);
		} else {
			setFormattedDate(`${startDateTime.toLocaleString('en-US', {
				month: 'short',
				day: 'numeric',
				year: 'numeric',
			})} – ${endDateTime.toLocaleString('en-US', {
				month: 'short',
				day: 'numeric',
				year: 'numeric',
			})}`);
		}
	}, [meta]);

	return (
		<>
			<time {...useBlockProps()}>
				{formattedDate}
			</time>
		</>
	);
}
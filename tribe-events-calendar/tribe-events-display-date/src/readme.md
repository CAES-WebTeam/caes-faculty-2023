# Display Date Block for Tribe's "The Events Calendar"

In this block we're making a block that displays the event date for Tribe's event posts. This block is different from the one that comes with the plugin, because it works inside of a query block. It also just displays the event date, and does not allow you to change it.

To do this, we have to wrap our heads around the `useState` and `useEffect` React hooks. We also need to learn how to use `useEntityProp` from WordPress's `@wordpress/core-data` package.

This readme is intended to help us understand these concepts.

## What is useState?

React’s `useState` hook lets you add “state” to functional components. State represents data that can change over time and **AFFECTS THE RENDERING OF YOUR COMPONENT.**

When you call `useState`, it returns an array with two elements: 
* Current state value
* Function to update the state

## What is useEffect?

`useEffect` is a React hook that allows you to perform side effects in functional components. 

Side effects refer to any actions that affect the external world outside the component, such as fetching data, subscribing to events, or manipulating the DOM.

`useEffect` accepts two parameters: 
* Callback function
* Optional dependency array

### useEffect’s callback function 
* Executed after the React component renders and the browser has painted any changes. 
* This function is where you can place the code for your side effect.

### useEffect’s dependency array
* Optional second parameter
* Lets you to specify dependencies that the effect relies on. 
* When any of the dependencies change, the effect will be re-run. 
* If the dependency array is empty, the effect will only run once, after the initial render.

## What is useEntityProp?

### useEntityProp
* A function that is part of the `@wordpress/core-data` package
* Used to access and manage entity properties of a specific post or term

### Entity
* in WordPress, an entity refer to a post or term (taxonomy term) object
* Entity properties are the metadata associated with that entity

For example, in the context of a post entity, the properties could include the post title, content, featured image, custom fields, and more.

## Code explanation

This code fetches the metadata of a specific post (tribe_events post type) using the `useEntityProp` hook. It then uses the `useState` and `useEffect` hooks to format the event date and update the formatted date in the component state. The formatted date is rendered in the output.

```javascript
import { useEntityProp } from '@wordpress/core-data';
import { useState, useEffect } from 'react';

export default function Edit({ attributes, setAttributes, context: { postType, postId } }) {
	const [formattedDate, setFormattedDate] = useState('');
	const [meta, updateMeta] = useEntityProp('postType', 'tribe_events', 'meta', postId);

	useEffect(() => {
		const rawEventDate = meta._EventStartDate;
		const date = new Date(rawEventDate);
		const options = {
			month: 'long',
			day: 'numeric',
			year: 'numeric'
		};
		const formattedDate = date.toLocaleDateString('en-US', options);
		setFormattedDate(formattedDate);
	}, [meta]);

	return (
		<>
			<div {...useBlockProps()}>
				<p>{formattedDate}</p>
			</div>
		</>
	);
}
```

1.  The code imports the necessary dependencies: `useEntityProp` from `@wordpress/core-data`, and `useState` and `useEffect` from `react`.

2.  The `Edit` function component is defined, which receives props such as `attributes`, `setAttributes`, and `context` with `postType` and `postId`.

3.  Inside the `Edit` component, the state variable `formattedDate` and its corresponding setter function `setFormattedDate` are created using the `useState` hook. The initial value of `formattedDate` is an empty string.

4.  The `useEntityProp` hook is used to access the metadata (`meta`) of a specific post (identified by `postId`) of a given post type (`tribe_events`). The returned `meta` value and `updateMeta` function are destructured from the hook.

5.  The `useEffect` hook is used to perform a side effect when the `meta` value changes. It runs a callback function that formats the event date and updates the `formattedDate` state accordingly. The dependency array `[meta]` ensures that the effect is triggered whenever the `meta` value changes.

6.  Inside the `useEffect` callback, the `rawEventDate` is extracted from `meta._EventStartDate`. A `Date` object is created from the `rawEventDate`.

7.  The `options` object is defined with the desired date formatting options, specifying a short month name, numeric day, and numeric year.

8.  The `toLocaleDateString` method is used on the `date` object to format it as a localized date string based on the specified options. The resulting formatted date is assigned to a new variable `formattedDate`.

9.  The `setFormattedDate` function is called with `formattedDate` to update the state value of `formattedDate`.

10. The component returns JSX code that renders a `<div>` element with block props. Inside the `<div>`, a `<p>` element displays the `formattedDate` state value.

## Helpful Resources

* [useState documentation](https://react.dev/reference/react/useState)
* [useEffect documentation](https://react.dev/reference/react/useEffect#useeffect)
* [Managing Site Settings from the WordPress Block Editor](https://lapero.io/blog/lapero/2022/08/19/managing-site-settings-from-the-wordpress-block-editor): mentions `useEntityProp`


# :calendar: CAES Additions to "The Events Calendar" (aka Tribe Events)

These files extend [The Events Calendar](https://theeventscalendar.com/) plugin when installed on a CAES or Extension site. The current functionalities include:

- [x] Overriding the default single event page template with our own.
- [x] Adding a query loop variation block to the editor for pulling event feeds.
- [x] Adding an event date block to the editor for event feed query block variation.

## I can't see the blocks or patterns. What's happening?

The theme's functions.php checks for if "The Events Calendar" is installed/activated. 

If it is:

* `tribe-events-functions.php` in this folder is enqueued
* Our custom `/patterns` associated with the plugin remain intact and aren't removed from the patterns library.


If not:

* The blocks won't be available in the editor, and the patterns are unregistered.
* To access the blocks, activate "The Events Calendar".
* Ensure that the plugin settings are set to use the block editor for events. Otherwise, our single event template won't be available.

## tribe-events-functions.php

This file is referenced by the theme's functions.php, if "The Events Calendar" plugin is activated. It contains several scripts:

* A function that replaces the default single event page template with our own. The default template can be modified in this file. Note that the plugin settings must be set to use the block editor for this to work.
* A function for pulling in a custom query block variation for event feeds (see caes-tribe-events-list.js).
* A filter for sorting custom events list on the front end.
* A filter for sorting custom events list in the editor.
* Registering our custom [event date block](tribe-events-display-date/tribe-events-display-date.php).

## caes-tribe-events-list.js

This file creates a query block variation that pulls in events from Tribe's plugin. 

* The block appears as "Events (The Events Calendar)" in the blocks selector of the block editor.
* When the block is first inserted, the user can click the "Choose" button to select a grid pattern design option. 
* The grid pattern code can be found here: [../patterns/caes-tribe-events-list.php](../patterns/caes-tribe-events-list.php)

## /tribe-events-display-date

This folder contains our custom block for displaying the event date in an event feed. It uses `@wordpress/scripts` dev dependencies. Before using, install the packages with npm, and then run `npm run build` in this directory to build it.
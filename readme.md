# CAES Faculty 2023 Theme

This repo is for the 2023 WordPress theme for UGA CAES and Extension faculty sites. It's a block theme with ready-to-go patterns designed for faculty websites. It also supports the site editor for further customization.

## Node.js and Node Package Manager

There are several node packages in this repo. 

If working with this repo for the first time, first make sure you have node installed on your machine (https://nodejs.org/) and Node Package Manager (https://www.npmjs.com/).

Then after pulling the repo to your machine, install the packages with ```npm install```.

## Theme Blocks (/blocks)

There are several blocks included with this theme. They are used in the templates for consistent branding, and allow limited options for the end user to change on their own site. Some blocks also add extra functionality to the site (ie breadcrumbs and post social share).

1. **Breadcrumbs**
2. **Footer Brand**
3. **Footer Copyright**
4. **Post Social Share**
5. **Preheader Brand**
6. **UGA Footer**

## Extend Core Blocks (/extend-core-blocks)

This directory contains code for extending the core blocks in WordPress when the theme is activated. This code does not add variation blocks. Instead, it adds options onto the core WordPress blocks, without adding an extra block for the end user to select.

### Current Extensions

1. **Table**
   - If header row is toggled in core options, the option to toggle sticky header appears
   - Header column option
   - Sticky header column option (if header column is on)

## Build Commands

1. **package.json** 
   - Use ```npm run build``` to compile theme CSS and JS
2. **/blocks/package.json** 
   - cd to directory, and use ```npm run build``` to compile CSS, JS, and PHP for theme blocks
3. **/extend-core-blocks/package.json**
   - cd to directory, and use ```npm run build``` to compile CSS and JS for extending core blocks
4. **/tribe/tribe-events-categories-list/** 
   - cd to directory, and use ```npm run build``` to compile CSS, JS, and PHP for Tribe Events Categories List block
5. **/tribe/tribe-events-display-date/** 
   - cd to directory, and use ```npm run build``` to compile CSS, JS, and PHP for Tribe Events Display Date block

## Changelog

| Version | Date | Changes | Contributor |
|---------|------|---------|-------------|
| 1.4.61 | 2026-05-15 | Add Citation list block style with hanging indent. Remove Flickr link in footer. | Ashley |
| 1.4.59 | 2026-04-23 | Hide core/post-author block when author is unresolved, fixing empty link issue | Ashley |
| 1.4.58 | 2026-04-15 | Add caes_title support tp Wufoo shortcode for iframe a11y | Ashley |
| 1.4.57 | 2026-03-11 | Reverted parvus to 2.6.0 due to v3 bugs | Ashley |
| 1.4.56 | 2026-03-11 | Fix Parvus 3 dialog overlay bug on gallery pages | Ashley |
| 1.4.55 | 2026-03-11 | Updated remaining packages | Ashley |
| 1.4.5 | 2026-03-11 | Update blocks to API version 3, updated low risk packages, updated SASS @import to @use | Ashley |
| 1.4.4 | 2026-01-27 | Scroll to accordion when it opens | Ashley, Mikey |
| 1.4.3 | 2026-01-06 | Image fix on RSS feed | Ashley |
| 1.4.2 | 2025-12-11 | Styles added for new accordion block | Ashley |
| | 2025-10-31 | Added class for gutenslider | Ashley |
| | 2025-10-08 | Adding new checkbox style | Ashley |
| | 2025-09-12 | Update to EOO statement | Ashley |
| | 2025-06-03 | New helper class hide-mobile | Ashley |
| | 2025-05-29 | Removing guest author name function and filter | Ashley |
| | 2025-03-26 | Login CSS fixes | Ashley |
| | 2025-03-25 | Fix for editor view of card style on blocks | Ashley |
| | 2025-03-19 | Adding card style for group and new shadows | Ashley |
| | 2025-02-10 | Update to events query block variation | Ashley |
| | 2024-11-19 | WP 6.7 updates | Ashley |
| | 2024-09-25 | Adding Extension logo asset | Ashley |
| | 2024-09-19 | Adding CAES Events plugin styles | Ashley |
| | 2024-07-17 | Theme.json updates for WP 6.6 | Ashley |
| | 2024-06-27 | Added submit a complaint link option to UGA footer | Ashley |
| | 2024-06-26 | CSS adjustments for TOC block | Ashley |
| | 2024-06-11 | Added back to top button | Ashley |
| | 2024-05-17 | Updates for RSS feed plugin CSS | Ashley |
| | 2024-05-09 | RSS feed block CSS and social share block bug fix | Ashley |
| | 2024-04-15 | Updates for WP 6.5, extend core blocks update | Ashley |
| | 2024-04-03 | Misc updates, spacing fixes for cover block and text-media | Ashley |
| | 2024-03-19 | Disabled searchfilter function | Mikey |
| | 2024-03-01 | New Flavor of Georgia product template, removed TikTok icon, CSS bug fixes | Ashley |
| | 2024-02-08 | Added hide-thumbnail-caption helper class | Ashley |
| | 2024-01-19 | Roll off old events on archive pages | Ashley |
| | 2024-01-10 | Fixed social share to show X icon | Ashley |
| | 2023-12-06 | Fix for CSS issue on Tribe event buttons | Ashley |
| | 2023-11-28 | Tribe events updates | Ashley |
| | 2023-11-21 | Added X logo for footer | Ashley |
| | 2023-11-07 | Updates for WP 6.4 and readme.md | Ashley |
| | 2023-11-02 | Tribe events category sorting, personnel directory style fixes | Ashley |
| | 2023-10-26 | Updates for tribe-events, UGA footer options, bug fixes | Ashley |
| | 2023-10-02 | Updates for event date styling | Ashley |
| | 2023-09-26 | Preventing non-super admins from editing lock settings in templates | Ashley |
| | 2023-08-21 | Removed Snapchat link from UGA footer, accessibility adjustments | Ashley |
| | 2023-08-14 | Bug fix for event query variation | Ashley |
| | 2023-08-11 | Updates for WP 6.3 | Ashley |
| | 2023-08-09 | Updates for breadcrumbs block and single event page template | Ashley |
| | 2023-08-02 | Breadcrumbs block | Ashley |
| | 2023-07-24 | Default event template now in PHP | Ashley |
| | 2023-07-20 | Extended The Events Calendar plugin, search result fixes, version 1.0.7 | Ashley, Mikey |
| | 2023-06-06 | Breadcrumbs block added | Ashley |
| | 2023-05-31 | Updated CAES personnel plugin styles | Ashley |
| | 2023-05-24 | Styles added for CAES Google Search block | Ashley |
| | 2023-05-16 | No results added to search template, image gallery caption fix | Ashley |
| | 2023-05-11 | Search results post template style toggle for author/date | Ashley |
| 1.0 | 2023-05-10 | Version 1, gallery style option added | Ashley |
| | 2023-05-09 | Adjusted list styles in caes-fac-query-loop-one | Ashley |
| | 2023-05-08 | Favicon can be set by site admin | Ashley |
| | 2023-05-01 | Mixitup styling, optimization updates | Ashley |
| | 2023-04-19 | Accordion styles and spacer on content templates | Ashley |
| | 2023-04-13 | Personnel style updates | Ashley |
| | 2023-04-12 | Fixed z-index and search icon issue | Ashley |
| | 2023-03-31 | Added styles for WP Inventory and Wufoo forms | Ashley |
| | 2023-03-30 | People profile fixes, GTM placement, RSS excerpt | Ashley, Mikey |
| | 2023-03-28 | Added site tagline block, fixed avatar sizing | Ashley |
| | 2023-03-27 | People profile updates | Ashley |
| | 2023-03-22 | Small max-width fix for iframes | Ashley |
| | 2023-03-20 | Author info mobile fix, RSS image function, preheader commodities link | Ashley, Mikey |
| | 2023-03-13 | People profile patterns added | Ashley |
| | 2023-03-09 | Fixed template for single CAES people | Ashley |
| | 2023-03-08 | Updated block names, small adjustments | Ashley |
| | 2023-03-07 | Removed test message from author name | Mikey |
| | 2023-03-06 | Mobile nav design, sidebar nav fixes, preheader and footer options | Ashley |
| | 2023-03-01 | Option for disabling login link on UGA footer block | Ashley |
| | 2023-02-28 | Added no bullet/number list style, misc updates | Ashley |
| | 2023-02-20 | CAES people and site list work | Ashley |
| | 2023-02-15 – 2023-02-16 | Guest author filters, WPJM function fixes, print styles | Ashley, Mikey |
| | 2023-02-14 | WP global paddings, accessibility fixes | Ashley |
| | 2023-02-07 – 2023-02-08 | WPJM updates, theme screenshot, misc edits | Ashley, Mikey |
| | 2023-02-03 | Edits to WP Job Manager styles | Ashley |
| | 2023-02-01 | WP Job Manager additions | Ashley |
| | 2023-01-31 | Content alignment fixes, additional global styles | Ashley |
| | 2023-01-24 | Template locking for header/footer, CSS edits | Ashley |
| | 2023-01-12 | Added social metatags, login styles | Ashley |
| | 2022-12-20 | Miscellaneous updates before dev OIT site | Ashley |
| | 2022-12-13 | Content/wide width adjustments, added blocks folder | Ashley, Mikey |
| | 2022-11-29 – 2022-12-06 | Added Parvus lightbox library, reorganized src files | Ashley |
| | 2022-11-07 | First batch of changes | Ashley |
| | 2022-09-28 | Initial repo push | Ashley |
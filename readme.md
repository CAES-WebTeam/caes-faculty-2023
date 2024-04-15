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
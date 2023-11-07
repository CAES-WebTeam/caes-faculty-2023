# CAES Faculty 2023 Theme

This repo is for the 2023 WordPress theme for UGA CAES and Extension faculty sites. It's a block theme with ready-to-go patterns designed for faculty websites. It also supports the site editor for further customization.

## Node.js and Node Package Manager

There are several node packages in this repo. 

If working with this repo for the first time, first make sure you have node installed on your machine (https://nodejs.org/) and Node Package Manager (https://www.npmjs.com/).

Then after pulling the repo to your machine, install the packages with ```npm install```.

## Build Commands

1. **package.json** 
   - Use ```npm run build``` to compile theme CSS and JS
2. **/blocks/package.json** 
   - cd to directory, and use ```npm run build``` to compile CSS, JS, and PHP for theme blocks
3. **/tribe-events-calendar/tribe-events-categories-list/** 
   - cd to directory, and use ```npm run build``` to compile CSS, JS, and PHP for Tribe Events Categories List block
4. **/tribe-events-calendar/tribe-events-display-date/** 
   - cd to directory, and use ```npm run build``` to compile CSS, JS, and PHP for Tribe Events Display Date block
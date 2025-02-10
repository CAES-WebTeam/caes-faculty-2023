console.log('test');

// Variable with name of block variation
const MY_VARIATION_NAME = 'uga-caes-fac-2023/caes-tribe-events-list';

// Register custom query block for Events (Tribe's Events Calendar)
wp.blocks.registerBlockVariation(
    'core/query',
    {
        name: MY_VARIATION_NAME,
        title: 'Events (The Events Calendar)',
        description: 'Displays a list of events from The Events Calendar.',
        isDefault: false,
        icon: 'calendar-alt',
        attributes: {
            namespace: MY_VARIATION_NAME,
            query: {
                perPage: 3,
                pages: 0,
                postType: 'tribe_events',
                offset: 0,
                filterByDate: true
            }
        },
        isActive: ['namespace'],
        scope: ['inserter']
    }
);
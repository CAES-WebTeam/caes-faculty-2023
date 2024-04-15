
/**
 * FUNCTIONS
 */

// Function to check if element is shorter than 80% of viewport height
function isShorterThan80vh(element) {
    const elementHeight = element.offsetHeight;
    const viewportHeight = window.innerHeight;
    const eightyPercentViewportHeight = 0.8 * viewportHeight;
    return elementHeight < eightyPercentViewportHeight;
}

// Function to check if element is wider or equal to parent wrapper
function isWiderThanParent(element) {
    const elementWidth = element.offsetWidth;
    const parentWidth = element.parentNode.offsetWidth;
    return elementWidth >= parentWidth;
}

/**
 * EVENT LISTENERS
 */

document.addEventListener("DOMContentLoaded", function () {
    const figures = document.querySelectorAll("figure.caes-extended-core-table");

    figures.forEach(figure => {

        // If figure has sticky header row class or sticky header column class.
        if (figure.classList.contains("caes-sticky-header-row") || figure.classList.contains("caes-sticky-header-column")) {
            // console.log("Sticky header row or column");

            // Get table element
            const table = figure.querySelector("table");

            // Wrap table in div with class "caes-responsive-table-wrapper"
            const wrapper = document.createElement("div");
            wrapper.classList.add("caes-responsive-table-wrapper");
            table.parentNode.insertBefore(wrapper, table);
            wrapper.appendChild(table);

        }

        // If table has sticky header row class.
        if (figure.classList.contains("caes-sticky-header-row")) {

            // Find all th elements and add sticky-header-row-cell class.
            const ths = figure.querySelectorAll("thead th");
            ths.forEach(th => {
                th.classList.add("sticky-header-row-cell");
            });

            // Max height of responsive tables are 80vh.
            // Adds caes-sticky-header-row-short class if table is shorter,
            // adding overflow-x: unset to hide scrollbars.
            const table = figure.querySelector("table");
            if (isShorterThan80vh(table)) {
                figure.classList.add("caes-sticky-table-short");
            }
        }

        // If table has sticky header column class.
        if (figure.classList.contains("caes-sticky-header-column")) {
            
            // Find all th elements in each row of tbody and add sticky-header-column-cell class.
            const table = figure.querySelector("table");
            const tbody = table.querySelector("tbody");
            const trs = tbody.querySelectorAll("tr");
            trs.forEach(tr => {
                const ths = tr.querySelectorAll("th");
                ths.forEach(th => {
                    th.classList.add("sticky-header-column-cell");
                });
            });

            if (isWiderThanParent(table)) {
                figure.classList.add("caes-sticky-table-wide");
            }

            
        }

    });
});
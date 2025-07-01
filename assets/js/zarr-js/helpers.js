// helpers.js

/**
 * Gets all attributes of a given element
 * @param {HTMLElement} element - The DOM element to get attributes from
 * @returns {Object} - An object containing all attributes as key-value pairs
 */
export function getAllAttributes(element) {
    const attributes = {};
    if (element && element.attributes) {
        for (let i = 0; i < element.attributes.length; i++) {
            const attr = element.attributes[i];
            attributes[attr.name] = attr.value;
        }
    }
    return attributes;
}

/**
 * Checks if an element is currently in the viewport
 * @param {jQuery} $element - The jQuery object for the element
 * @returns {boolean} - True if the element is in the viewport, otherwise false
 */
export function isElementInViewport($element) {
    const elementTop = $element.offset().top;
    const elementBottom = elementTop + $element.outerHeight();
    const viewportTop = $(window).scrollTop();
    const viewportBottom = viewportTop + $(window).height();

    return elementBottom > viewportTop && elementTop < viewportBottom;
}

/**
 * Debounces a function, limiting how often it is called
 * @param {Function} func - The function to debounce
 * @param {number} wait - The debounce delay in milliseconds
 * @returns {Function} - The debounced function
 */
export function debounce(func, wait) {
    let timeout;
    return function () {
        const context = this,
            args = arguments;
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(context, args), wait);
    };
}

var LazyLoader = (function () {
    function lazyLoad(selector) {
        $(selector).each(async function () {
            var $element = $(this);
            if (isElementInViewport($element)) {
                var attributes = getAllAttributes(this);

                if (attributes['data-src']) {
                    var imgSrc = attributes['data-src'];
                    var $img = $('<img>').addClass('lazyload');

                    $.each(attributes, function (attrName, attrValue) {
                        if (attrName !== 'data-src') {
                            $img.attr(attrName, attrValue);
                        }
                    });

                    $img.attr('src', '').addClass('loading');
                    $element.replaceWith($img);

                    try {
                        const response = await fetch(imgSrc);
                        if (!response.ok) throw new Error('Failed to fetch image');
                        const imgBlob = await response.blob();
                        const imgUrl = URL.createObjectURL(imgBlob);
                        $img.attr('src', imgUrl).removeClass('loading').addClass('loaded');
                    } catch (e) {
                        console.error('Error loading image:', e);
                        $img.removeClass('loading').addClass('error');
                    }
                }
            }
        });
    }

    function getAllAttributes(element) {
        var attributes = {};
        if (element && element.attributes) {
            for (var i = 0; i < element.attributes.length; i++) {
                var attr = element.attributes[i];
                attributes[attr.name] = attr.value;
            }
        }
        return attributes;
    }

    function isElementInViewport($element) {
        var elementTop = $element.offset().top;
        var elementBottom = elementTop + $element.outerHeight();
        var viewportTop = $(window).scrollTop();
        var viewportBottom = viewportTop + $(window).height();

        return elementBottom > viewportTop && elementTop < viewportBottom;
    }

    function debounce(func, wait) {
        var timeout;
        return function () {
            var context = this,
                args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(function () {
                func.apply(context, args);
            }, wait);
        };
    }

    function init(selector, delay = false) {
        $(document).ready(function () {
            function onEvent() {
                lazyLoad(selector);
            }

            if (!delay) {
                onEvent()
            }

            $(window).on('scroll resize orientationchange', debounce(onEvent, 200));
            $(window).on('mousemove', debounce(onEvent, 200));
        });
    }

    return {
        init: init
    };
})();
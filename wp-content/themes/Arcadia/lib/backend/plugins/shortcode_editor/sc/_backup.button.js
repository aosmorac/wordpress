scnShortcodeMeta = {
    attributes: [{
        label: "Title",
        id: "content",
        help: "The button title.",
        isRequired: true
    }, {
        label: "Link",
        id: "link",
        help: "Optional link (e.g. http://google.com).",
        validateLink: true
    }, {
        label: "Size",
        id: "size",
        help: "Values: &lt;empty&gt; for normal size, small, large, xl."
    }, {
        label: "Style",
        id: "style",
        help: "Values: &lt;empty&gt;, info, alert, tick, download, note."
    }, {
        label: "Background Color",
        id: "color",
        help: "Values: &lt;empty&gt; for default or a color (e.g. red or #000000)."
    }, {
        label: "Border",
        id: "border",
        help: "&lt;empty&gt; for default or the border color (e.g. red or #000000)."
    }, {
        label: "Dark Text?",
        id: "text",
        help: 'Leave empty for light text color or use "dark" (for light background color buttons).'
    }, {
        label: "CSS Class",
        id: "class",
        help: "Optional CSS class."
    }],
    defaultContent: "Button",
    shortcode: "button"
};
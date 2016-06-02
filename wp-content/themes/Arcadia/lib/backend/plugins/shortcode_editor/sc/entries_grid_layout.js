scnShortcodeMeta = {
  shortcode: "entries",
  disablePreview: true,
  attributes: [{
    label: "IDs",
    id:    "ids",
    help:  "IDs, separated by commas",
    isRequired: true
  }, {
    label: "Column Size",
    id:    "column_size",
		controlType: "select-control", 
		options:     ['full', 'one-half', 'one-third', 'one-fourth'],
		defValue:    'one-third', 
		defText:     'one-third'
  }, {
    label: "Featured Content Height",
    id:    "featured_content_height",
    help:  "Enter the amount of pixel or * to adapt the height of content."
  }, {
    label: "Excerpt Length",
    id:    "excerpt_length",
    help:  ""
  }, {
    label: "Bottom Padding",
    id:    "bottom_padding",
		controlType: "select-control", 
		options:     ['', 'small', 'none'],
		defValue:    '', 
		defText:     'default'
  }, {
    label: "Show Featured Content",
    id:    "show_featured_content",
		controlType: "select-control", 
		options:     ['true', 'false']
  }, {
    label: "Show Headings",
    id:    "show_headings",
		controlType: "select-control", 
		options:     ['true', 'false']
  }, {
    label: "Show Meta Infos",
    id:    "show_meta_infos",
		controlType: "select-control", 
		options:     ['false', 'true']
  }, {
    label: "Show Excerpts",
    id:    "show_excerpts",
		controlType: "select-control", 
		options:     ['true', 'false']
  }, {
    label: "Show Buttons",
    id:    "show_buttons",
		controlType: "select-control", 
		options:     ['true', 'false']
  }, {
    label: "Featured Image Link Method",
    id:    "featured_image_link_method",
		controlType: "select-control", 
		options:     ['entry', 'lightbox', 'none']
  }, {
    label: "\"Read More\" Link Text",
    id:    "read_more_link_text",
    help:  "Change the \"Read More\" link text."
  }, {
    label: "External Link Text",
    id:    "external_link_text",
    help:  "Change the link text that appears for portfolio items when you assign a URL to them."
  }]
};
scnShortcodeMeta = {
  shortcode: "entries",
  disablePreview: true,
  attributes: [{
    label: "Post Type",
    id:    "type",
    help:  "",
		controlType: "select-control", 
		options:     ['post', 'portfolio']
  }, {
    label: "Category",
    id:    "category",
    help:  "Enter a category slug if you want to filter entries by category. Separate them with commas if you want to use more than one.",
  }, {
    label: "Number of Entries",
    id:    "count",
    help:  ""
  }, {
    label: "Column Size",
    id:    "column_size",
    help:  "",
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
    help:  "",
		controlType: "select-control", 
		options:     ['true', 'false']
  }, {
    label: "Show Headings",
    id:    "show_headings",
    help:  "",
		controlType: "select-control", 
		options:     ['true', 'false']
  }, {
    label: "Show Meta Infos",
    id:    "show_meta_infos",
    help:  "",
		controlType: "select-control", 
		options:     ['false', 'true']
  }, {
    label: "Show Excerpts",
    id:    "show_excerpts",
    help:  "",
		controlType: "select-control", 
		options:     ['true', 'false']
  }, {
    label: "Show Buttons",
    id:    "show_buttons",
    help:  "",
		controlType: "select-control", 
		options:     ['true', 'false']
  }, {
    label: "Featured Image Link Method",
    id:    "featured_image_link_method",
    help:  "",
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
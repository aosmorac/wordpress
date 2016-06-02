scnShortcodeMeta = {
  shortcode: "entry",
  disablePreview: true,
  attributes: [{
    label: "ID",
    id:    "id",
    isRequired: true
  }, {
    label: "Column Size",
    id:    "column_size",
		controlType: "select-control", 
		options:     ['two-third', 'one-half', 'one-third', 'one-fourth'],
		defValue:    'one-third', 
		defText:     'one-third'
  }, {
    label: "Excerpt Length",
    id:    "excerpt_length",
    help:  ""
  }, {
    label: "List Layout",
    id:    "list_layout",
		controlType: "select-control", 
		options:     ['true']
  }, {
    label: "Featured Content Height",
    id:    "featured_content_height",
    help:  "Enter the amount of pixel or * to adapt the height of content."
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
    label: "Last entry in row",
    id:    "last",
		controlType: "select-control", 
		options:     ['false', 'true']
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
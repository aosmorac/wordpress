scnShortcodeMeta = {
  attributes: [{
    label: "URL",
    id: "content",
    help: "E.g. http://thissite.com/wp-content/uploads/2011/08/image.jpg",
    isRequired: true
  }, {
    label: "Size",
    id: "size",
		controlType: "select-control", 
		options:     ['none', 'full', 'two-third', 'one-half', 'one-third', 'one-fourth'],
		defValue:    'none', 
		defText:     'Self Defined (default)',
		help: 'Select a size that you can preset in the Image Size Options. This is optional. You can also adjust the size by yourself with the fields below.'
  }, {
    label: "Width (in pixel)",
    id: "width",
  }, {
    label: "Height (in pixel)",
    id: "height",
    help:  "Enter the amount of pixel or * to adapt the image height."
  }, {
    label: "No Lightbox",
    id: "no_lightbox",
		controlType: "select-control", 
		options:     ['false', 'true']
  }, {
    label: "Lightbox URL",
    id: "lightbox_url",
    help: "If you want to specify what should be displayed in the lightbox (other image, YouTube video, Website etc.)"
  },  {
    label: "Link URL",
    id: "link",
    help: "You can link the image to any URL you want. This disables the lightbox automatically."
  }, {
    label: "Open New Tab",
    id: "open_new_tab",
		controlType: "select-control", 
		options:     ['false', 'true'],
    help: "If you set a link, you can make it open in a new tab."
  }, {
    label: "Caption",
    id: "caption"
  }, {
    label: "Title",
    id: "title"
  }, {
    label: "Alternative Text",
    id: "alt"
  }, {
    label: "Align",
    id: "align",
		controlType: "select-control", 
		options:     ['', 'left', 'right'],
		defValue:    '', 
		defText:     'none'
  }, {
    label: "Fancy Frame",
    id: "fancy",
		controlType: "select-control", 
		options:     ['false', 'true']
  }],
  disablePreview: true,
  defaultContent: "http://thissite.com/wp-content/uploads/2012/08/image.jpg",
  shortcode: "image"
};
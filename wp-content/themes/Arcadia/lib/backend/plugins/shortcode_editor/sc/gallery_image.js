scnShortcodeMeta = {
  attributes: [{
    label: "URL",
    id: "content",
    help: "E.g. http://thissite.com/wp-content/uploads/2011/08/image.jpg",
    isRequired: true
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
  }],
  disablePreview: true,
  defaultContent: "http://thissite.com/wp-content/uploads/2011/08/image.jpg",
  shortcode: "image"
};
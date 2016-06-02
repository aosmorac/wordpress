scnShortcodeMeta = {
  attributes: [{
    label: "Size",
    id: "size",
		controlType: "select-control", 
		options:     ['full', 'one-half', 'one-third', 'one-fourth'],
		defValue:    'one-third', 
		defText:     'one-third'
  }, {
    label: "Height (in pixel)",
    id: "height",
    help:  "Enter the amount of pixel or * to adapt the image height."
  }, {
    label: "Fancy Frames",
    id: "fancy",
		controlType: "select-control", 
		options:     ['false', 'true']
  }],
  disablePreview: true,
  customMakeShortcode: function (b) {
    var size   = jQuery('#scn-value-size').val();
    var height = jQuery('#scn-value-height').val();
    var fancy  = jQuery('#scn-value-fancy').val();
    
    size = " size='"+size+"'";
    
    if(height != '') height = " height='"+height+"'";
    else             height = '';
    
    if(fancy  != 'false') fancy  = " fancy='true'";
    else                  fancy  = '';
    
    var output = '';
    output+= "[image_gallery "+size+height+fancy+"]<br/>";
    output+= "Gallery images here...<br/>";
    output+= "[/image_gallery]";
    
    return output;
  }
};
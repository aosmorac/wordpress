(function () {
  tinymce.create("tinymce.plugins.ShortcodeNinjaPlugin", {
    init: function (d, e) {
      d.addCommand("scnVisitWooThemes", function () {
        window.open("http://visualshortcodes.com/scn-woothemes")
      });
      d.addCommand("scnOpenDialog", function (a, c) {
        scnSelectedShortcodeType = c.identifier;
        jQuery.get(e + "/dialog.php", function (b) {
          jQuery("#scn-dialog").remove();
          jQuery("body").append(b);
          jQuery("#scn-dialog").hide();
          var f = jQuery(window).width();
          b = jQuery(window).height();
          f = 720 < f ? 720 : f;
          f -= 80;
          b -= 84;
          tb_show("Shortcode Editor", "#TB_inline?width=" + f + "&height=" + b + "&inlineId=scn-dialog");
          jQuery("#scn-options h3:first").text("Customize the " + c.title + " Shortcode")
        })
      });
      d.onNodeChange.add(function (a, c) {
        c.setDisabled("scn_button", a.selection.getContent().length > 0)
      })
    },
    createControl: function (d, e) {
      if (d == "scn_button") {
        d = e.createMenuButton("scn_button", {
          title: "Insert Shortcode",
          image: rvn.template_url+"/lib/backend/plugins/shortcode_editor/tinymce/img/icon.png",
          icons: false
        });
        var a = this;
        d.onRenderMenu.add(function (c, b) {

          a.addWithDialog(b, "Blockquote", "blockquote");

          a.addWithDialog(b, "Box",        "box");

          a.addWithDialog(b, "Button",     "button");

          a.addWithDialog(b, "Columns",    "columns");

          a.addWithDialog(b, "Contact Form", "contact_form");

          b.addSeparator();

          a.addImmediate(b, "Divider (clears floats)", "[divider] ");

          c = b.addMenu({title: "Gallery"});
                a.addWithDialog(c, "Gallery Wrapper", "gallery");
                c.addSeparator();
                a.addWithDialog(c, "Gallery Image (goes into the Gallery Wrapper)", "gallery_image");

          c = b.addMenu({title: "Dropcaps"});
                a.addImmediate(c, "Dropcap (Big Letter)",        "[dropcap]A[/dropcap] ");
                a.addImmediate(c, "Dropcap (Square Background)", "[dropcap style='square']A[/dropcap] ");
                a.addImmediate(c, "Dropcap (Circle Background)", "[dropcap style='circle']A[/dropcap] ");
                c.addSeparator();
                a.addImmediate(c, "Colored Dropcap (Big Letter)",        "[dropcap colored='true']A[/dropcap] ");
                a.addImmediate(c, "Colored Dropcap (Square Background)", "[dropcap style='square' colored='true']A[/dropcap] ");
                a.addImmediate(c, "Colored Dropcap (Circle Background)", "[dropcap style='circle' colored='true']A[/dropcap] ");

          a.addWithDialog(b, "Heading",    "heading");

          c = b.addMenu({title: "Horizontal Rulers (hr)"});
                a.addImmediate(c, "Horizontal Ruler",         "[hr] ");
                a.addImmediate(c, "Big Horizontal Ruler",     "[hr size='big'] ");
                a.addImmediate(c, "Bigger Horizontal Ruler",  "[hr size='bigger'] ");
                a.addImmediate(c, "Small Horizontal Ruler",   "[hr size='small'] ");
                a.addImmediate(c, "Smaller Horizontal Ruler", "[hr size='smaller'] ");

          b.addSeparator();

          a.addWithDialog(b, "Image",      "image");

          a.addWithDialog(b, "Icon Text",  "icon_text");

          a.addWithDialog(b, "Info Box",   "info_box");

          c = b.addMenu({title: "Entries"});
                a.addWithDialog(c, "Latest Entries of Post Type (Grid Layout)", "entries_post_type_grid_layout");
                a.addWithDialog(c, "Latest Entries of Post Type (List Layout)", "entries_post_type_list_layout");
                c.addSeparator();
                a.addWithDialog(c, "Several Entries by ID (Grid Layout)", "entries_grid_layout");
                a.addWithDialog(c, "Several Entries by ID (List Layout)", "entries_list_layout");
                c.addSeparator();
                a.addWithDialog(c, "Single Entry by ID (Grid Layout)", "entry_grid_layout");
                a.addWithDialog(c, "Single Entry by ID (List Layout)", "entry_list_layout");

          c = b.addMenu({title: "Lists"});
                a.addImmediate(c, "Check List", "[checklist]<li>List Element</li><li>List Element</li><li>List Element</li>[/checklist] ");
                a.addImmediate(c, "Cross List", "[crosslist]<li>List Element</li><li>List Element</li><li>List Element</li>[/crosslist] ");
                a.addImmediate(c, "Plus List",  "[pluslist]<li>List Element</li><li>List Element</li><li>List Element</li>[/pluslist] ");
                a.addImmediate(c, "Minus List", "[minuslist]<li>List Element</li><li>List Element</li><li>List Element</li>[/minuslist] ");

          b.addSeparator();

          c = b.addMenu({title: "Spacers"});
                a.addImmediate(c, "Spacer",        "[spacer] ");
                a.addImmediate(c, "Big Spacer",    "[spacer size='big'] ");
                a.addImmediate(c, "Bigger Spacer", "[spacer size='bigger'] ");
                a.addImmediate(c, "Small Spacer",  "[spacer size='small'] ");

          c = b.addMenu({title: "Tables"});
                a.addImmediate(c, "Table",   "[table]<br/><br/>...Table HTML code goes here...<br/><br/>[/table] ");
                a.addImmediate(c, "Minimal", "[table style='minimal']<br/><br/>...Table HTML code goes here...<br/><br/>[/table] ");

          c = b.addMenu({title: "Tabs"});
                a.addWithDialog(c, "Tab Wrapper", "tabgroup");
                c.addSeparator();
                a.addWithDialog(c, "Tab (goes into the Tab Wrapper)", "tab");

          c = b.addMenu({title: "Toggler"});
                a.addWithDialog(c, "Toggler Wrapper", "togglergroup");
                a.addWithDialog(c, "Toggler (goes into the Toggler Wrapper)", "toggler");

          c = b.addMenu({title: "Highlights"});
                a.addImmediate(c, "Highlight",                   "[highlight]Highlight[/highlight] ");
                a.addImmediate(c, "Highlight (Dark Background)", "[highlight style='dark']Highlight[/highlight] ");
                a.addImmediate(c, "Highlight (Neon Background)", "[highlight style='neon']Highlight[/highlight] ");

          b.addSeparator();

          c = b.addMenu({title: "HTML"});
                a.addWithDialog(c, "div", "div");
                a.addWithDialog(c, "span", "span");


          /*
          b.addSeparator();
          b.addSeparator();
          a.addWithDialog(b, "Button", "button");
          a.addWithDialog(b, "Icon Link", "ilink");
          b.addSeparator();
          a.addWithDialog(b, "Related Posts", "related");
          b.addSeparator();
          c = b.addMenu({
            title: "Social Buttons"
          });
            a.addWithDialog(c, "Twitter", "twitter");
            a.addWithDialog(c, "Tweetmeme", "tweetmeme");
            a.addWithDialog(c, "Digg", "digg");
            a.addWithDialog(c, "Like on Facebook", "fblike");
          */
        });
        return d
      }
      return null
    },
    addImmediate: function (d, e, a) {
      d.add({
        title: e,
        onclick: function () {
          tinyMCE.activeEditor.execCommand("mceInsertContent", false, a)
        }
      })
    },
    addWithDialog: function (d, e, a) {
      d.add({
        title: e,
        onclick: function () {
          tinyMCE.activeEditor.execCommand("scnOpenDialog", false, {
            title: e,
            identifier: a
          })
        }
      })
    },
    getInfo: function () {
      return {
        longname: "Shortcode Ninja plugin",
        author: "VisualShortcodes.com",
        authorurl: "http://visualshortcodes.com",
        infourl: "http://visualshortcodes.com/shortcode-ninja",
        version: "1.0"
      }
    }
  });
  tinymce.PluginManager.add("ShortcodeNinjaPlugin", tinymce.plugins.ShortcodeNinjaPlugin)
})();
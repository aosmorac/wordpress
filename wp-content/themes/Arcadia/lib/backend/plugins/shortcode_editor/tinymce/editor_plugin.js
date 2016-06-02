(function () {
    tinymce.create("tinymce.plugins.ShortcodeNinjaPlugin", {
        init: function (editor, e) {


          var _self = this;

          editor.addButton( 'scn_button', {
            type: 'menubutton',
            text: "",
            title : "Insert Theme Shortcode",
            // icon : 'wp_code',
            // image : rvn.template_url+"/lib/backend/plugins/shortcode_editor/tinymce/img/icon.png",
            menu: _self.createMenuValues(editor)
           });


            editor.addCommand("scnOpenDialog", function (a, c) {

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
                    tb_show("Insert Shortcode", "#TB_inline?width=" + f + "&height=" + b + "&inlineId=scn-dialog");
                    jQuery("#scn-options h3:first").text("Customize the " + c.title + " Shortcode")
                })
            });

        },

        control_by_key: function(passed_key, final_options)
        {
          var shortcodes = false, key;

          if(shortcodes)
      {
        for (key in shortcodes)
        {
          if( passed_key == false && typeof shortcodes[key] == 'string')
          {
            final_options.push({text: shortcodes[key].charAt(0).toUpperCase() + shortcodes[key].slice(1) , shortcode: shortcodes[key].toLowerCase().replace(/ /,'_')});
          }
          else if(key == passed_key )
          {
            for (sub_key in shortcodes[key])
            {
              final_options.push({text: shortcodes[key][sub_key].charAt(0).toUpperCase() + shortcodes[key][sub_key].slice(1) , shortcode: sub_key});
            }
          }
        }
            }
        },

        createMenuValues: function()
        {
          var _self       = this,
            shortcodes    = false,
            final_options   = [],
            remove      = {}


      //     final_options.push({text: 'Button', shortcode: 'button'});
      //     final_options.push({text: 'Icon link', shortcode: 'ilink'});
      //     _self.control_by_key('inline', final_options);

      //     final_options.push({text: "Quote", shortcode: 'quote'});
      //       final_options.push({text: "Info Box", shortcode: 'box'});
      //       final_options.push({text: "Icon Box", shortcode: 'iconbox'});
      //       _self.control_by_key("small_box", final_options);

      //     final_options.push({text: "Column Layout", shortcode:"column"});
      // final_options.push({text: "Content Slider",shortcode: "slider"});
      // final_options.push({text: "Toggles",shortcode: "toggle"});
      // final_options.push({text: "Tabbed Content",shortcode: "tab"});
      // _self.control_by_key( "content", final_options);

      //     var dividers = {text: 'Dividers', menu: []};
      //     dividers.menu.push({av_type: 'insert', text: "Horizontal Rule", shortcode: "<br>[hr] <br>"});
      //       dividers.menu.push({av_type: 'insert', text: "Horizontal Rule with top link", shortcode: "<br>[hr top] <br>"});
      //       dividers.menu.push({av_type: 'insert', text: "Whitespace", shortcode: "<br>[hr_invisible] <br>"});
      //     final_options.push(dividers);

      //     var dropcaps = {text: 'Dropcaps', menu: []};
      //     dropcaps.menu.push({av_type: 'insert', text: "Dropcap Style 1 (Big Letter)", shortcode: "[dropcap1]A[/dropcap1]"});
      //       dropcaps.menu.push({av_type: 'insert', text: "Dropcap Style 2 (Colored Background)", shortcode: "[dropcap2]A[/dropcap2]"});
      //       dropcaps.menu.push({av_type: 'insert', text: "Dropcap Style 3 (Dark Background)", shortcode: "[dropcap3]A[/dropcap3]"});
      //     final_options.push(dropcaps);

      //     var widgets = {text: 'Widgets', menu: []};
      //       widgets.menu.push({text: "Latest Posts", shortcode: "latest_posts"});
      //       if(!shortcodes || (typeof remove.portfolio == 'undefined'))  widgets.menu.push({text: "Latest Portfolio entries", shortcode: "latest_portfolio"});
      //       _self.control_by_key( "widgets", widgets);
      //     final_options.push(widgets);

      final_options.push({text: 'Blockquote', shortcode: 'blockquote'});
      final_options.push({text: 'Box', shortcode: 'box'});
      final_options.push({text: 'Button', shortcode: 'button'});
      final_options.push({text: 'Columns', shortcode: 'columns'});
      final_options.push({text: 'Contact Form', shortcode: 'contact_form'});

      // b.addSeparator();

      final_options.push({av_type: 'insert', text: "Divider (clears floats)", shortcode: "[divider] "});

      var gallery = {text: 'Gallery', menu: []};
        gallery.menu.push({text: "Gallery Wrapper", shortcode: "gallery"});
        // c.addSeparator();
        gallery.menu.push({text: "Gallery Image (goes into the Gallery Wrapper)", shortcode: "gallery_image"});
      final_options.push(gallery);

      var dropcaps = {text: 'Dropcaps', menu: []};
        dropcaps.menu.push({av_type: 'insert', text: "Dropcap (Big Letter)", shortcode: "[dropcap]A[/dropcap] "});
        dropcaps.menu.push({av_type: 'insert', text: "Dropcap (Square Background)", shortcode: "[dropcap style='square']A[/dropcap] "});
        dropcaps.menu.push({av_type: 'insert', text: "Dropcap (Circle Background)", shortcode: "[dropcap style='circle']A[/dropcap] "});
        // c.addSeparator();
        dropcaps.menu.push({av_type: 'insert', text: "Colored Dropcap (Big Letter)", shortcode: "[dropcap colored='true']A[/dropcap] "});
        dropcaps.menu.push({av_type: 'insert', text: "Colored Dropcap (Square Background)", shortcode: "[dropcap style='square' colored='true']A[/dropcap] "});
        dropcaps.menu.push({av_type: 'insert', text: "Colored Dropcap (Circle Background)", shortcode: "[dropcap style='circle' colored='true']A[/dropcap] "});
      final_options.push(dropcaps);

      final_options.push({text: 'Heading', shortcode: 'heading'});

      var hr = {text: 'Horizontal Rulers (hr)', menu: []};
        hr.menu.push({av_type: 'insert', text: "Horizontal Ruler", shortcode: "[hr] "});
        hr.menu.push({av_type: 'insert', text: "Big Horizontal Ruler", shortcode: "[hr size='big'] "});
        hr.menu.push({av_type: 'insert', text: "Bigger Horizontal Ruler", shortcode: "[hr size='bigger'] "});
        hr.menu.push({av_type: 'insert', text: "Small Horizontal Ruler", shortcode: "[hr size='small'] "});
        hr.menu.push({av_type: 'insert', text: "Smaller Horizontal Ruler", shortcode: "[hr size='smaller'] "});
      final_options.push(hr);

      // b.addSeparator();

      final_options.push({text: 'Image', shortcode: 'image'});
      final_options.push({text: 'Icon Text', shortcode: 'icon_text'});
      final_options.push({text: 'Info Box', shortcode: 'info_box'});

      var entries = {text: 'Entries', menu: []};
        entries.menu.push({text: "Latest Entries of Post Type (Grid Layout)", shortcode: "entries_post_type_grid_layout"});
        entries.menu.push({text: "Latest Entries of Post Type (List Layout)", shortcode: "entries_post_type_list_layout"});
        // c.addSeparator();
        entries.menu.push({text: "Several Entries by ID (Grid Layout)", shortcode: "entries_grid_layout"});
        entries.menu.push({text: "Several Entries by ID (List Layout)", shortcode: "entries_list_layout"});
        // c.addSeparator();
        entries.menu.push({text: "Single Entry by ID (Grid Layout)", shortcode: "entry_grid_layout"});
        entries.menu.push({text: "Single Entry by ID (List Layout)", shortcode: "entry_list_layout"});
      final_options.push(entries);

      var lists = {text: 'Lists', menu: []};
        lists.menu.push({av_type: 'insert', text: "Check List", shortcode: "[checklist]<li>List Element</li><li>List Element</li><li>List Element</li>[/checklist] "});
        lists.menu.push({av_type: 'insert', text: "Cross List", shortcode: "[crosslist]<li>List Element</li><li>List Element</li><li>List Element</li>[/crosslist] "});
        lists.menu.push({av_type: 'insert', text: "Plus List", shortcode: "[pluslist]<li>List Element</li><li>List Element</li><li>List Element</li>[/pluslist] "});
        lists.menu.push({av_type: 'insert', text: "Minus List", shortcode: "[minuslist]<li>List Element</li><li>List Element</li><li>List Element</li>[/minuslist] "});
      final_options.push(lists);

      // b.addSeparator();

      var spacers = {text: 'Spacers', menu: []};
        spacers.menu.push({av_type: 'insert', text: "Spacer", shortcode: "[spacer] "});
        spacers.menu.push({av_type: 'insert', text: "Big Spacer", shortcode: "[spacer size='big'] "});
        spacers.menu.push({av_type: 'insert', text: "Bigger Spacer", shortcode: "[spacer size='bigger'] "});
        spacers.menu.push({av_type: 'insert', text: "Small Spacer", shortcode: "[spacer size='small'] "});
      final_options.push(spacers);

      var tables = {text: 'Tables', menu: []};
        tables.menu.push({av_type: 'insert', text: "Table", shortcode: "[table]<br/><br/>...Table HTML code goes here...<br/><br/>[/table] "});
        tables.menu.push({av_type: 'insert', text: "Minimal Table", shortcode: "[table style='minimal']<br/><br/>...Table HTML code goes here...<br/><br/>[/table] "});
      final_options.push(tables);

      var tabs = {text: 'Tabs', menu: []};
        tabs.menu.push({text: "Tab Wrapper", shortcode: "tabgroup"});
        tabs.menu.push({text: "Tab (goes into the Tab Wrapper)", shortcode: "tab"});
      final_options.push(tabs);

      var toggler = {text: 'Toggler', menu: []};
        toggler.menu.push({text: "Toggler Wrapper", shortcode: "togglergroup"});
        toggler.menu.push({text: "Toggler (goes into the Toggler Wrapper)", shortcode: "toggler"});
      final_options.push(toggler);

      var highlights = {text: 'Highlights', menu: []};
        highlights.menu.push({av_type: 'insert', text: "Highlight", shortcode: "[highlight]Highlight[/highlight] "});
        highlights.menu.push({av_type: 'insert', text: "Highlight (Dark Background)", shortcode: "[highlight style='dark']Highlight[/highlight] "});
        highlights.menu.push({av_type: 'insert', text: "Highlight (Neon Background)", shortcode: "[highlight style='neon']Highlight[/highlight] "});
      final_options.push(highlights);

      // b.addSeparator();

      var html = {text: 'HTML', menu: []};
        html.menu.push({text: "div", shortcode: "div"});
        html.menu.push({text: "span", shortcode: "span"});
      final_options.push(html);


          _self.control_by_key( false, final_options);

          //add the onclick event programmaticaly
          for(var key in final_options)
          {
            if(typeof final_options[key].menu != "undefined")
            {
              for(var subkey in final_options[key].menu)
              {
                if(typeof final_options[key].menu[subkey].av_type != "undefined" && final_options[key].menu[subkey].av_type == "insert")
                {
                  final_options[key].menu[subkey].onclick = _self.addImmediate;
                }
                else
                {
                  final_options[key].menu[subkey].onclick = _self.addWithDialog;
                }
              }
            }
            else
            {
              if(typeof final_options[key].av_type != "undefined" && final_options[key].av_type == "insert")
              {
                final_options[key].onclick = _self.addImmediate;
              }
              else
              {
                final_options[key].onclick = _self.addWithDialog;
              }
            }
          }


          return final_options;
        },

        addImmediate: function () {

            var shortcode = this.settings.shortcode;

          tinyMCE.activeEditor.execCommand("mceInsertContent", false, shortcode);

        },
        addWithDialog: function () {

          var shortcode   = this.settings.shortcode,
            title   = this.settings.text;

            tinyMCE.activeEditor.execCommand("scnOpenDialog", false, {
                title: title,
                identifier: shortcode
            });

        },
        getInfo: function () {
            return {
                longname: "Shortcode Ninja plugin",
                author: "VisualShortcodes.com (modified by Kriesi)",
                authorurl: "http://visualshortcodes.com",
                infourl: "http://visualshortcodes.com/shortcode-ninja",
                version: "1.0"
            }
        }
    });
    tinymce.PluginManager.add("ShortcodeNinjaPlugin", tinymce.plugins.ShortcodeNinjaPlugin)
})();
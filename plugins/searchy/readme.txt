=== Searchy ===
Contributors: dopewp
Tags: search, ajax, filter, category, tag, custom fields, sorting
Requires at least: 3.0.1
Tested up to: 4.2
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
 
An AJAX Search Engine allowing different criterias for sorting and filtering your posts. Use via simple shortcodes and few settings.

== Description ==

# The Purpose: allowing your users to search differently #

_Ajaxed search engines_ are all over the place Ð literally.
Whenever a large amount of items is available, be it houses for rent 
or computer spare parts, providing your users with a **fast, structured, faceted search**
can be one thousand times more efficient, rather than letting your visitors sink into hundreds of web pages,
hoping theyÕll find what they need Ð almost by chance.
This tool does not replace or try to extend the build in textual search feature of Wordpress;
it aims to provide a quick bootstrap to an ajaxed search engine, demonstrating how easy it can be to turn
your website into a powerful search tool, without installing a huge and bloated code.

It is easy to hack and to extend at your will.
You can read here the  original article about why [Searchy](http://www.dopewp.com/searchy/) was built. 

##Main Features##
Let your users search combining different criterias: Filter  by name, category, tag, or custom field (=1).
Sort results by date, name or custom field (numeric)

##Typical usage##

Searchy is a customizable search engine composed of two elements: the **search filters** - typically a filters column, and the **search results**.

Use the **searchy_filter** shortcode or the **built-in widget** to show the filters column.
Place the  **searchy_results**  shortcode in a WordPress page to show the sort bar and the search results.
Of course those go in square brackets in a chosen Page.
You can place them one after the other, having searchy_filter and searchy_results close,
Or get fancy building your custom layout, placing some **do_shortcode** calls wherever you want.
 

== Installation ==

This section describes how to install the plugin and get it working. 

e.g.

1. Upload the plugin folder ("searchy) to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. In a WordPress Page, place the [searchy_filter]  and the [searchy_results] to display your new search engine.
4. View the Page, you should see something going on!
5. A set of options is provided in the /wp-admin/ at the ** Settings > Searchy** options page.
6. Study the code and the documentation to get wild.

== Frequently Asked Questions ==

= How do I get started? =

Read the Installation section just before this one. It's quite simple.

= How do I add the search by *custom fields* feature? =

Let's say your blog is about animals; let's imagine you do flag animals that fly, setting at 1 a custom field called **"can-fly"**.
You may thus want to display as search criteria "can fly": to achieve this, a set of options is provided in the
/wp-admin/ at the **Settings > Searchy** options page. Just add the custom field slug in the **Custom Fields in the Filter** textarea.

= How do I make the search engine look different? =

Add your custom CSS, this plugin does not aim to solve this. It aims to blend in naturally with your Theme.
You can find some examples and demos here to have a [horizontal search](http://www.dopewp.com/searchy/standard-page-with-shortcodes/ "Your favorite software")  

 
== Changelog ==

= 1.0 =
* First public release.
 
  
 
  
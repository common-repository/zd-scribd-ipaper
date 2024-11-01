=== ZD Scribd iPaper ===
Contributors: websmokers
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=6451324
Tags: scribd, ipaper, scribd ipaper, document, embed document, pdf viewer, ms word viewer, viewer
Requires at least: 2.7
Tested up to: 2.8
Stable tag: trunk

Embed Scribd iPaper supported documents in your wordpress website.

== Description ==

Embed Scribd supported documents in your wordpress website.

You can also choose whether to display document to everyone or only to logged users. If you are using Suma plugin then you can use ZD Scribd iPaper plugin along with Suma. There is option on admin page to turn Suma checking on. If you need any other authentication plugin integration then email me your requirement.

You can make few document public and few for loged in user by using 'access' attribute within [scribd] and [scribdlink] shorttags.

You can also display document link instead of embedding the ipaper. Upon clicking the link, lightview window will open the document. Next version will have more JavaScript window options like thickbox, fancybox, etc. If you have some suggestion for JavaScript window tools then please email me your suggestions.

= Usage =

To embed already published scribd document:

[scribd id=DOCUMENT_ID_HERE key=ACCESS_KEY_HERE]

You can get this tag from scribd document page.


To embed a document from url:

[scribd pubid=SCRIBD_PUBLISHER_ID_HERE]DOCUMENT_URL_HERE[/scribd] 

or

[scribd url=DOCUMENT_URL_HERE pubid=SCRIBD_PUBLISHER_ID_HERE]
(Use this format when embedding multiple document on same page/post)


Available Attributes for [scribd] shorttag:-
<ul>
<li>url - URL (http://) of document, when embed a document from url</li>
<li>id - Scribd document id.</li>
<li>key - Scribd document key.</li>
<li>pubid - Your Scribd Publisher Key. You can find it on your Scribd account page. You need register at <a href=http://www.scribd.com target=”_blank”>scribd.com</a> to get this key</li>
<li>height - The height of iPaper, in pixels.</li>
<li>width - The width of iPaper, in pixels.</li>
<li>public - Whether to make the document public on Scribd. This parameter is only for iPapers created from Url. iPapers created with the id and key will ignore this parameter. Value: true or false</li>
<li>page - You can use this to scroll iPaper to a default start page. Defaults to 1</li>
<li>extension - This parameter is only for iPapers created from the Url. When Scribd processes a file it will try to identify the file type using the contents of the file and various heuristics. If Scribd is guessing wrong on one of your files, you can override this behavior and set the extension directly with this parameter (e.g., "docx").</li>
<li>title - This parameter is only for iPapers created from the Url. Sets the title of the new file uploaded. </li>
<li>disable_related_docs - When true the related docs tab is not shown in List Mode. Value: true or false</li>
<li>mode - Sets the default view mode for the document, overriding the document's default. Parameter must be added before the document is written. Valid values are: "list", "book", "slide", and "tile".</li>
<li>auto_size - When false, this parameter forces iPaper to use the provided width and height rather than using a width multiplier of 85/110. Values: true or false</li>
<li>access - You set whether document requires login for viewing. Value: public / private.</li>
</ul>


Place a link to iPaper:
[scribdlink href=DOCUMENT_URL id=DOCUMENT_ID_HERE key=ACCESS_KEY_HERE pubid=SCRIBD_PUBLISHER_ID_HERE]LINK_TEXT_OR_IMAGE[/scribdlink]


Avaliable Attributes for [scribdlink] shorttag:-
<ul>
<li>href - URL (http://) of document, when embed a document from url</li>
<li>id - Scribd document id.</li>
<li>key - Scribd document key.</li>
<li>pubid - Your Scribd Publisher Key. You can find it on your Scribd account page. You need register at <a href=http://www.scribd.com target=”_blank”>scribd.com</a> to get this key</li>
<li>title - Title of lightview window</li>
<li>caption - Caption of lightview window</li>
<li>access - You set whether document requires login for viewing. Value: public / private.</li>
</ul>


== Installation ==

1. Upload the full directory into your 'wp-content/plugins' directory
2. Activate the plugin at the plugin administration page
3. Use [scribd] or [scribdlink] shortcode in your post or page. Use the attributes as per your requirements.

== Frequently Asked Questions ==

= Minimum PHP Version =

PHP5

= Lightview not working? =
If you are using jQuery in you theme or if any of your other plugins are using jquery then you have to put following code in your theme's header.php file.

<script type="application/x-javascript">jQuery.noConflict();</script>

Use  jQuery instead of $.

== Screenshots ==

1. Front end preview
2. Admin Panel
3. Shorttag

== Support ==

Email at support@proloy.me

== Changelog ==
= Version 1.0 =
07-Aug-2008
<ul>
<li>First Release</li>
</ul>
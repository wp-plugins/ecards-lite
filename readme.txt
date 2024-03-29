=== eCards Lite ===
Contributors: butterflymedia
Tags: akismet, ecard, electronic card, flash card, greeting card, paypal, postcard
License: GPLv3
Requires at least: 4.0
Tested up to: 4.3.1
Stable tag: 3.2.1

== Description ==
eCards is a WordPress plugin used to send electronic cards to friends. It can be implemented in a page, a post or the sidebar.

There are two ways you can use this plugin:

1. Add the shortcode [ecard] to a post or a page;
2. Call the function from a template file: <?php if(function_exists('display_ecardMe')) echo display_ecardMe(); ?>;
3. Use the shortcode [ecard_counter] to display the number of eCards sent;
4. Call the function from a template file: <?php if(function_exists('display_ecardCounter')) echo display_ecardCounter(); ?>.

== Installation ==

1. Upload the wp-ecards folder to your '/wp-content/plugins/' directory
2. Activate the plugin via the Plugins menu in WordPress
3. Create and publish a new page/post and add this shortcode: [ecard]
4. A new eCards menu will appear in WordPress with options, and general help

== Screenshots ==

1. eCards Settings
2. eCards Email Settings
3. eCards Restrictions and Payment
4. eCards Labels
5. eCards Dashboard/Help/Usage

== Changelog ==

= 3.2.1 =
* FIX: Fixed encoding issue

= 3.2 =
* FEATURE: Added dedicated email address
* FEATURE: Added Reply-To header for emails

= 3.1 =
* FIX: Fixed include() syntax
* FIX: Removed unused global variable
* FIX: Renamed main plugin file for WordPress actions compatibility
* IMPROVEMENT: Reduced number of requests by moving function calls to plugins_loaded
* IMPROVEMENT: Removed unused options deletion

= 3.0.4 =
* FEATURE: Updated WordPress compatibility

= 3.0.3 =
* FEATURE: Added WordPress plugin repository assets and screenshots

= 3.0.2 =
* SECURITY: Sanitized all options

= 3.0.1 =
* IMPROVEMENT: Removed radio button if there is only one image

= 3.0 =
* FIX: Removed link from the labels tab
* FIX: Added missing update notice
* FIX: Fixed missing image size from PayPal shortcode
* FEATURE: Added PRO/LITE version

= 2.9.6 =
* FIX: Fixed user creation not being triggered
* FEATURE: Added labels directly to plugin settings (instead of PO)
* UPDATE: Removed label from the file upload button

= 2.9.5 =
* UPDATE: Updated return URL to match both HTTP and HTTPS protocols
* FIX: Added default option for user creation
* FIX: Fixed several wp_mail() rules

= 2.9.4 =
* UPDATE: Removed internal mail overrides (use a third-party plugin to accomplish this)
* UPDATE: Use sender's name and email address for sending eCards
* UPDATE: Added dismissible notices

= 2.9.3 =
* PERFORMANCE: Removed sparkline visualizer
* UPDATE: Updated WordPress compatibility
* FIX: Added more translatable strings

= 2.9.2 =
* IMPROVEMENT: Added option to disable Akismet
* IMPROVEMENT: Added option to save eCard senders to the users database
* FIX: Removed email filters for PHP lower than 5.3
* UPDATE: Added several translation strings to .po files

= 2.9.1 =
* FIX: Updated a deprecated Akismet call
* FIX: Removed PHP 5.3+ specific functions for mail filters

= 2.9 =
* IMPROVEMENT: Removed reCAPTCHA and implemented Akismet
* IMPROVEMENT: Cleaned up email sending process
* FIX: Fixed theme link (again)

= 2.8.1 =
* FIX: Fixed theme link

= 2.8 =
* FEATURE: Added option to choose between image source and label behaviour (click eCard thumbnail to select radio box)
* IMPROVEMENT: Merged some community changes to reCAPTCHA library

= 2.7.3 =
* FIX: Added PHP check before using filter functions
* FIX: Added UTF8 encoding

= 2.7.2 =
* FIX: Fixed custom PayPal amount
* FIX: Custom reCAPTCHA fixes (more to come from https://github.com/google/ReCAPTCHA)

= 2.7.1 =
* ENHANCEMENT: Updated reCAPTCHA to v2 (php_1.0)
* ENHANCEMENT: Removed featured image from eCards list
* ENHANCEMENT: Removed Flash cards
* ENHANCEMENT: Improved PayPal form
* FIX: Removed singular card display (all images now appear as selectables)
* FIX: Various code fixes and improvements

= 2.7 =
* ENHANCEMENT: Added internal wp_mail() filters (removed global ones)
* ENHANCEMENT: Removed support for multiple emails (due to abuse)
* ENHANCEMENT: Removed BCC header, Reply-To header and email trimming

= 2.6.1 =
* FIX: Renamed a function to avoid conflicts
* FIX: Renamed order_by to orderby to avoid conflicts
* FIX: Removed a redundant function - chip_magic_quotes()
* FIX: Defaulted 'ecard_shortcode_fix' ("Apply shortcode fix" option) to 'off'
* FEATURE: Bumped required version to 3.9

= 2.6 =
* FEATURE: Added option to allow sender to CC self
* ACCESSIBILITY: Removed custom image size and allowed for listing all registered image sizes (more image sizes can be added by using third-party plugins)
* ACCESSIBILITY: Removed wp_mail() filters from diagnostics tab as they were far from accurate
* FIX: Removed option to deactivate mail filters

= 2.5.0.4 =
* FEATURE: Added Reply-To header
* FEATURE: Added wp_mail() test function and SMTP plugin link
* FEATURE: Added settings link to plugins section
* FIX: Various fixes
* FIX: Moved plugin to Settings menu

= 2.5.0.3 =
* FEATURE: Added decimals to PayPal price section

= 2.5.0.2 =
* FIX: Fixed PayPal return page with no shortcode filter

= 2.5.0.1 =
* FEATURE: Added PayPal sandbox option
* IMPROVEMENT: Added .ecards (or .ecard a) as lightbox selector
* IMPROVEMENT: Renamed CSS name for enqueued styles
* HELP: Added contextual help for lightbox selectors
* HELP: Fixed typo in readme.txt file

= 2.5 =
* UPDATE: Added internal mail parameters (with options)
* UPDATE: Changed user upload behaviour
* UPDATE: Updated Dropbox Chooser to version 2
* UPDATE: Updated styles
* IMPROVEMENT: Fixed stylesheet enqueue mode
* IMPROVEMENT: General clean-up

= 2.4.9 =
* SECURITY: Removed Google Charts API and replaced it with a simple sparkline chart
* CHECK: Fixed a conflict on the demo page

= 2.4.8 =
* FIX: Added function check for reCAPTCHA conflict
* IMPROVEMENT: Switched to strict comparison for faster PHP code execution
* UPDATE: Updated compatibility with WordPress 4.0

= 2.4.7 =
* FIX: Reversed order of email elements, due to spam filters

= 2.4.6 =
* FIX: Fixed eCards chart when the plugin is first installed (no statistics)
* FEATURE: eCards can now be reordered from the Gallery screen

= 2.4.5 =
* UPDATE: Changed menu icon to dashicon
* UPDATE: Clarified eCard image size options
* UPDATE: Merged eCard internal counter functions
* UPDATE: Moved statistics chart to plugin's home

= 2.4.4 =
* FIX: Fixed single eCard not showing (revert 2.4.3 input checking fix)
* FIX: Frontend form appearance improvements
* UPDATE: Updated all translation files with correct plural forms
* IMPROVEMENT: Admin UI performance improvements

= 2.4.3 =
* FIX: Removed the "Missing attachment" text if user uploaded own image
* FIX: Removed all checked attributes from eCards
* FIX: Fixed both selected image and attachment being sent
* FIX: Fixed div nesting inside paragraph element
* FIX: Removed unused option both from code and options table
* FIX: Renamed print_filters_for() function for better compatibility with other plugins
* FIX: Fixed diagnostics tab for WordPress multisite
* IMPROVEMENT: Moved eCard message and content below the image (inside email)
* IMPROVEMENT: Added radiogroup role to the list of radio inputs
* IMPROVEMENT: Removed featured image from list of available eCards
* DOCUMENTATION: Added new link for Gmail authentication

= 2.4.2 =
* VERSION: Added WordPress 3.9 compatibility
* FIX: Fixed unclosed paragraphs in dashboard help section 
* IMPROVEMENT: Better formatting for the dashboard help section

= 2.4.1 =
* FEATURE: Added custom eCard thumbnail (also added recommendations)

= 2.4 =
* FIX: Removed mysql_query
* FIX: Fixed statistics chart not working on multisite
* IMPROVEMENT: Removed MAIL FROM filters as dedicated plugins do it for free (also added recommendations)
* IMPROVEMENT: wp_mail() headers are now an array instead of a string

= 2.3.2 =
* FIX: Reverted a change from 2.3.1 preventing the payment shortcode

= 2.3.1 =
* FEATURE: Added Flash cards (use [fcard] shortcode)
* IMPROVEMENT: Removed "autofocus" attribute for email redirection (page was already scrolled)

= 2.3 =
* FIX: Forced correct appearance for radio input
* IMPROVEMENT: Added optional content shortcode fix
* IMPROVEMENT: Added eCard size inside shortcode (thumbnail, medium, large, full)
* IMPROVEMENT: Removed a redundant option and combined the upload functions

= 2.2 =
* FEATURE: Added statistics
* FEATURE: Added diagnostics
* FEATURE: Added payment restrictions
* IMPROVEMENT: Streamlined template options
* IMPROVEMENT: Removed classic CAPTCHA
* IMPROVEMENT: Moved options initialization to a hook
* IMPROVEMENT: Lots of code overhauling and simplification

= 2.1 =
* FEATURE: Added theme selector for reCAPTCHA
* IMPROVEMENT: Added multiple emails as BCC
* IMPROVEMENT: Added noreply@domain.ext as sender
* LOCALIZATION: Added Czech (cs_CZ) translation (thanks Radoslav Polasek)

= 2.0.7 =
* FIX: Hardcoded email was not working (due to _POST[] reusal)

= 2.0.6 =
* FEATURE: Added option to include post/page content (thanks Gary)
* FEATURE: Added option to hide all attached images

= 2.0.5 =
* FIX: Fixed an unquoted server constant
* FIX: Fixed display of attached eCards when PayPal payment was activated
* FEATURE: Added option to modify PayPal button image

= 2.0.4 =
* UI: Fixed an administration label
* GENERAL: Fixed user upload option

= 2.0.3 =
* UI: Fixed a (too) long input field
* UI: More integration with MP6 plugin and WordPress 3.6-beta2

= 2.0.2 =
* Added option to exclude certain attached images by adding "noselect" as ALT text
* Fixed German (de_DE) translation

= 2.0.1 =
* Fixed missing labels
* Fixed contextual label help

= 2.0 =
* Redesigned plugin administration for better accessibility
* Added more contextual help
* Added missing symbols

= 1.7 =
* If no <Mail From> fields are filled in, the eCard will use the original sender (both name and email address)
* Added Danish translation (da_DK)
* Added Finnish translation (fi)
* Added option to toggle (show/hide) the message area ("Tip a friend" type email message)
* Modified name to be closer to the top in the Plugins section

= 1.7-beta =
* Added paragraph formatting for email template (wpautop)
* Added email name/address override (plugin Mail From II is no longer necessary)
* Added payment option (PayPal)
* Fixed reCAPTCHA inclusion conflict

= 1.6.8 =
* Added option to show single image (if only one image is attached, the radio button is hidden)
* Fixed subject line misbehaving when using single quotes

= 1.6.7 =
* Removed several links from eCard email
* Added license declaration and license.txt (GPL v3)
* Removed the donation link and improved the readme.txt file
* Tested the plugin with latest 3.5.1-beta1 and 3.6-alpha

= 1.6.6 =
* Allow user to upload image from Dropbox (Chooser)
* More code cleanup

= 1.6.5 =
* Clarified eCard behaviour (show/hide image or link)
* Code cleanup

= 1.6.4 =
* Added German (de_DE) translation (thanks to @Adrian)
* Fixed an English string (thanks to @Janaki)
* Fixed a link anchor being incorrectly displayed
* Removed email tweaks to get rid of spam detection

= 1.6.3 =
* Added small tweaks to eCard form
* Added CSS classes for message styling
* Added improved documentation
* Fixed counter update for "thank you" pages (thanks to @bad_designer)
* Removed unused styles and fonts

= 1.6.2 =
* Added link to attachment page inside email
* Added link to eCard page inside email
* Removed a useless hidden field

= 1.6.1 =
* Added back eCard behaviour (hide eCard, show link, show eCard or hide both)
* Added backlink to single attachment (now working as expected)
* Added Spanish locale (es_ES) (thanks to @render)

= 1.6 =
* Added possibility of adding more attachments to a single post/page
* Fixed a relative file inclusion error

= 1.5.11 =
* Added a magic quotes circumventing function to deal with `stripslashes_deep`
* Added additional headers for wp_mail function - mainly to deal with SPAM
* Added option to hide the recipient email address and send all eCards to a universal email address (thanks to @Sabrina for the suggestion)
* Tested with WordPress 3.5-beta3

= 1.5.10 =
* Added restriction for members only
* Added restriction message
* Fixed a typo
* Small UI changes
* Tested with WordPress 3.5-beta-1

= 1.5.9 =
* Added option to redirect to a "Thank You" page upon success
* Removed some unused code from a previous update

= 1.5.8 =
* Removed custom font for CTA, as it didn't render diacritics
* Removed size style for CTA, as headers should be styled by theme
* Removed width and height restrictions - send multiple dimensions eCards
* Fixed an error with thumb generator script, where a wrong parameter was passed to the function
* Fixed an old typo in the documentation
* Added style selector
* Added two new styles - Metro Light and Metro Dark
* Added charset information next to version line
* Added option to rename the submit button
* Updated all language files (removed one string)

= 1.5.7 =
* Added reCAPTCHA library
* Added French translation
* Added en_GB variant translation

= 1.5.6 =
* Added HTML validation switch for email (send to multiple recipients!)
* Tested and confirmed compatibility with WordPress 3.4

= 1.5.5 =
* Fixed a typo (eCard instead of Ecard)
* Added a new option to hide eCard and display a link
* Added a new shortcode to display number of eCards sent
* Changed plugin behaviour to not require a hardcoded folder name

= 1.5.2 =
* Fixed a warning for the main function (thanks to Zirta)

= 1.5.1 =
* Added editor buttons to email template
* Added sample email template, with tags explanation
* Added HTML5 form input types (when viewed in a browser that does not support them, these input types fall back to text input)
* Added HTML5 (required) attributes (form validation)

= 1.5 =
* Fixed the eCard display function
* Fixed 2 typos
* Fixed slashes appearing inside email message body
* Changed CAPTCHA function with a PHP text-based one to avoid path issues
* Changed some backend styles

= 1.4 =
* Added optional CAPTCHA
* Fixed a deprecated function
* Fixed a conflict with ABSPATH
* Removed email class filter
* Removed editor button

= 1.3 =
* Added mathematical CAPTCHA
* Fixed email template editing
* Updated translations

= 1.2 =
* Added translatable strings
* Added email template
* Cleaned up source

= 1.0 =
* First public release

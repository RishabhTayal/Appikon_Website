=== Facebook Comments Notifier ===
Contributors: ltnow, eppand, kseifert
Tags: facebook, comments, comment, facebook comments, facebook comment, email, notify, notification, notifications, social, social media, commenting, email notification, email notifications
Requires at least: 3.0
Tested up to: 3.5.1
Stable tag: 1.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Get email notifications when Facebook Comments are posted on your WordPress website. 


== Description ==

The Facebook Comments Notifier plugin adds the facebook comment system in place of the default WordPress comments and creates email notifications on successfully posted comments. 

The email notification includes:

* A link back to the page where the comment was submitted
* The name of the person who submitted the comment
* The text of the comment
* Distinction between "Comment" and "Reply"

If Facebook Comments are already in place on your WordPress site, this plugin will perform the email notification functionality.

The settings area allows for configurable items such as Facebook AppID and the recipient email(s). A Facebook AppID is not required. By default, the plugin will email notifications to the site's admin email address.

Facebook Comments Notifier uses the wp_mail() function to send the email notifcations.

WordPress Plugin developed by Lieberman Technologies, www.LTnow.com.


== Installation ==

1. Unzip the .zip file downloaded from the WordPress plugins library.
1. Upload 'facebook-comments-notifier' folder to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Navigate to your WordPress Dashboard
4. Configure the desired settings under Settings > Facebook Comments

**Note**, If you have not recieving the email notifications, please review the FAQs.


== Frequently Asked Questions ==

= I have installed the plugin but am not receiving emails =

This sometimes exists on a WordPress website running on IIS. The Facebook Comments Notifier plugin uses the wp_mail() function to send email and IIS is not always configured to handle mail this way. A work around to this mail issue is to use a plugin to authenticate your mail via SMTP protocol. For the SMTP authentication, we have found this plugin to work: WP Mail SMTP by Callum Macdonald (http://wordpress.org/extend/plugins/wp-mail-smtp/).

= How do I change the language of the Facebook comment widget? =

The plugin reads the Wordpress language setting (wordpress default is en_US).  This is defined in wp-config.php on the line: define('WPLANG', '');


== Screenshots ==

1. Settings screen for the Facebook Comments Notifier plugin
2. View of the Email Notification


== Changelog ==

= 1.5 =
* Add light/dark theme option under admin settings

= 1.4 =
* Add Facebook Admin ID field to the plugin settings to support comment moderation efforts. Reference "Moderation tools" at https://developers.facebook.com/docs/reference/plugins/comments/

= 1.3 =
* Distinguish between comments and replies in the email notifications.

= 1.2 =
* Add internationalization for Facebook comment widget. 

= 1.1 =
* Add Facebook name and comments to email
* Use permalink as Facebook page id

= 1.0 =
* Add auto width for control
* Handle dynamic window resize
* Add (optional) absolute width for control

= 0.9.1 =
* Labeling updates
* Added screenshot of settings screen

= 0.9 =
* Facebook Comments Notifier plugin published to WordPress.org


== Upgrade Notice ==

= 1.1 =
Now using permalink as facebook page id rather than page url (which can change).  In the unusual case that comments are orphaned in this upgrade, you may relink them by updating the permalink in the database to match the original post/page URL.


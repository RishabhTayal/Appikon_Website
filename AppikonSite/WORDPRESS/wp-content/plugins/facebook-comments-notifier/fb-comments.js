// encode data for html context
// default: \n -> &#10;  \r -> &#13;
var FCN_HTML_BR       = 1; // \n -> <br />
var FCN_HTML_NBSP     = 2; // ' ' -> &nbsp;
var FCN_HTML_NBSP_BR  = 3; // 1 + 2
var FCN_HTML_BR_NBSP  = 3; // 1 + 2
var FCN_HTML_PRESERVE = 4; // preserve 

function fcn_htmlencode (str, ws) {
	if ( str === null || str === undefined ) {
		return '';
	}
	var str = new String(str);
	str = str.replace(/&/g, "&amp;");
	str = str.replace(/>/g, "&gt;");
	str = str.replace(/</g, "&lt;");
	str = str.replace(/"/g, "&quot;");
	str = str.replace(/'/g, "&apos;");
	// encode whitespace
	if ( ws ) {
		// translate space
		if ( ws == 2 || ws == 3 ) {
			str = str.replace(/ /g, "&nbsp;");
			str = str.replace(/\t/g, "&nbsp;&nbsp;&nbsp;&nbsp;");
		}
		// htmlify line breaks
		if ( ws == 1 || ws == 3 ) {
			str = str.replace(/\r\n/g, "\n"); //pc
			str = str.replace(/\r/g, "\n");   // mac <= 9
			str = str.replace(/\n/g, "<br />");
		}
	} else {
		// for attributes/general
		str = str.replace(/\n/g, "&#10;");
		str = str.replace(/\r/g, "&#13;");
	}
	return str.valueOf();
}


// similar to php string escape
function fcn_addslashes(str) {
	if ( str === null || str === undefined ) {
		return '';
	}

	str = new String( str );
	var str = str.replace(/\\/g, '\\\\').
		replace(/\u0008/g, '\\b').
		replace(/\t/g, '\\t').
		replace(/\n/g, '\\n').
		replace(/\f/g, '\\f').
		replace(/\r/g, '\\r').
		replace(/'/g, '\\\'').
		replace(/"/g, '\\"');
	return str.valueOf();
}


// logging for client console
function fcn_log( s ) {
	if ( typeof console != 'undefined' && console.log ) {
		console.log( s );
	}
}


// load widget
jQuery(document).ready(function($) {

	// is form?
	if ( ! $('#commentform')[0] ) {
		return;
	}

	// check if fb is up
	if ( typeof(FB) == 'undefined' ) {
		$('#commentform').html( 'Facebook comments are currently unavailable' );
		return;
	}

	// get page id
	var url; 
	if ( fcn_global_data.permalink ) {
		url = fcn_global_data.permalink;
	}  else {
		url = window.location.href;
		url = url.replace(/#.*/, ''); 
	} 

	// comment form
	var html = '';
	if ( ! $('#fb-root')[0] )  {
		html += '<div id="fb-root"></div>';
	}
	html += '<fb:comments id="fbcomments" class="fbcomments" notify="true" href="' + fcn_htmlencode(url) + '" migrated="1"';

	// size control, clone/override
	var width = 550;
	if ( fcn_global_data.width ) {
		width =	fcn_global_data.width;
	} else {
		width =	$('#commentform').width();

		// handle resize event
		jQuery(window).resize(function() {
			if ( $('.fb_ltr')[0] ) {
				var width = $('#commentform').width();
				$('.fb_ltr').width( width );
			}
		});
	}
	html += ' width="' + fcn_htmlencode(width) + '" ';

	if (fcn_global_data.colorscheme) {
		html += ' colorscheme="' + fcn_htmlencode(fcn_global_data.colorscheme) + '" ';
	}

	html += '></fb:comments>' ;
	$('#commentform').html(html);
	$('#commentform').show();

	// add listener
	FB.Event.subscribe("comment.create", function(response){

		if ( ! response || ! response.commentID ) {
			fcn_log( 'fcn: no response' );
			return;
		} 

		var href = response.href;
		var commentID = response.commentID;
		var parentCommentID = response.parentCommentID; // if reply

		// get comments/reply text
		var fbsqlComment = "SELECT text, fromid FROM comment WHERE post_fbid='"+fcn_addslashes(commentID)+"' AND ( object_id in (select comments_fbid from link_stat where url ='"+fcn_addslashes(href)+"') or object_id in (select post_fbid from comment where object_id in (select comments_fbid from link_stat where url ='"+fcn_addslashes(href)+"')))"; 

		//fcn_log(fbsqlComment);

		// get user
		var commentQuery = FB.Data.query(fbsqlComment);;
		var fbsqlUser = "SELECT name FROM user WHERE uid in (select fromid from {0})";
		var userQuery = FB.Data.query(fbsqlUser, commentQuery);

		FB.Data.waitOn([commentQuery, userQuery], function() {

			var commentText = '';
			var userName = '';

			if ( commentQuery.value && commentQuery.value[0] ) {
				var commentRow = commentQuery.value[0];
				if ( commentRow ) {
					commentText = commentRow.text;
				}
			}

			if ( userQuery.value && userQuery.value[0] ) {
				var userRow = userQuery.value[0];
				if ( userRow.name ) {
					userName = userRow.name;
				}
			}

			// post to ajax service
			var data = {
				"action": "fcn_comment_created",
				"href": href,
				"commentID": commentID,
				"parentCommentID": parentCommentID,
				"commentText": commentText, 
				"userName": userName 
			};

			$.post( fcn_global_data.ajaxurl, data , function(jsonstr){
				var response = $.parseJSON(jsonstr);
				if ( response ) {
					if ( ! response.status ) {
						fcn_log( response );
					}
				}
			});
		});
	});


});



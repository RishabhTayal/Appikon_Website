jQuery(document).ready( function($) {


	var $final = $("#pages");

	$("#pages-custom").sortable({
		stop: function(event, ui) { getPages(); return false; }
	});

	function getPages() {

		var f = '';

		$(".pages-custom .single-page").each(function(i, e) {
			f += $(this).find("span").attr('rel') + ',' + $(this).find("span").attr('data-external') + ";";
		});

		$final.val(f);

		$("#pages-custom").sortable({
			stop: function(event, ui) { getPages(); }
		});
	}

	getPages();
	
	$(".pages-custom .single-page a.remove-item").live("click", function() {

		if(confirm("Do you have sure you want delete this page from menu?"))
		{
			$(this).parent().parent().remove();
		}

		getPages();

		return false;
	});

	$(".pages-custom .single-page a.external").live("click", function() {

		$(this).toggleClass("external-y");

		if($(this).prev().attr('data-external') == 'y') {
			$(this).prev().attr('data-external', 'n');
			$(this).text('Normal');
		}
		else if($(this).prev().attr('data-external') == 'n') {
			$(this).prev().attr('data-external', 'y');
			$(this).text('External');
		}

		getPages();

		return false;

	});

	$("#new-page").live("click", function() {
		var id = $("#page_id").val();
		var txt = $("#page_id option:selected").text();

		if(id != "") {

			$(".pages-custom").append('<div class="single-page"><div><span data-external="n" rel="'+ id + '">' + txt + '</span><a class="external" href="#">Normal</a><a class="remove-item" href="#">Remove</a></div></div>');


			getPages();
		}
		else {
			alert("Select a page, please.");
		}

		return false;
	});
	
});
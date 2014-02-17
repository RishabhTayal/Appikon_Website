var previewSrc = "";

var sample = '';

var content = 'Sample Text';

var description = '';

if(selectedText != '') {
	content = selectedText;
}
 
xt_wpShortcodeAtts={
	attributes:[
		{
			label:"Link URL",
			id:"link",
			help:"ex: http://google.com"
		},
		{
			label:"Color",
			id:"color",
			help:"Select the color of the button.", 
			controlType:"select-control", 
			selectValues:['default', 'black']
		}
		],
	defaultContent:content,
	shortcode:""
};
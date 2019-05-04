$.ajax({
	url: "Assets/info.txt",
	type: 'POST',
	dataType: 'text',
	success: function (data) {
		$.each(data.split(/[\n\r]+/), function(index, line) {
			$('<li>').text(line).appendTo('#theorems');
		});
	},
	async: false
});
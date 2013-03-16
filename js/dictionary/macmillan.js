jQuery(function(){
    var $ = jQuery;
    
    $("#macmillan").draggable();
    
    var cursor = {};
	$(window).mousemove(function(e) {
		cursor.x = e.pageX;
		cursor.y = e.pageY;
	});
    
    $(window).mouseup(function(e){
        var currentCursor = {
			x : cursor.x,
			y : cursor.y
		};
		var text = (document.all) ? document.selection.createRange().text : document.getSelection();
		text = $.trim(String(text));
        if(text.length == 0)
            return;
		if (text.length < 80) {
			//track dictionary
			_gaq.push(['_trackEvent', 'Note', 'Dictionary', text, 0]);
			$.ajax({
				url : BASE_URL + 'dictionary/macmillan/ajax/w/' + text,
				dataType: 'json',
				success : function(data) {
					if (!data) {
						return;
					}
					$("#macmillan .word").html(data.word[0].toUpperCase() + data.word[0].substr(1));
                    $("#macmillan .mean").html(data.mean);
                    $("#macmillan .link_search a.google").attr('href', 'http://www.google.com/search?q=' + data.word[0]);
                    $("#macmillan .link_search a.wiki").attr('href', 'http://en.wikipedia.org/wiki/' + data.word[0]);
                    $("#macmillan .link_search a.source").attr('href', 'http://www.macmillandictionary.com/dictionary/american/' + data.word[0]);
                    
					var h = $("#macmillan").height();
					var w = $("#macmillan").width();
                    
					$("#macmillan").css('top', currentCursor.y - h - 35 + 'px');
					var left = currentCursor.x - w / 2;
					if (left < 0)
						left = 0;
					$("#macmillan").css('left', left + 'px');
					$("#macmillan").show();
				}
			});
		} else if (text.length >= 80) {
			_gaq.push(['_trackEvent', 'Note', 'Mark', text]);
		}
    });
});
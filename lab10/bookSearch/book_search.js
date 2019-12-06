window.onload = function() {
    $("b_xml").onclick=function(){
			var category = getCheckedRadio($$('input'));
    	    new Ajax.Request('http://localhost:8888/lab10/bookSearch/books.php', {
				method: 'get',
				parameters: {'category': category},
				onSuccess: showBooks_XML,
				onFailure: ajaxFailed,
				onException: ajaxFailed
			})
    }
    $("b_json").onclick=function(){
		var category = getCheckedRadio($$('input'));
		new Ajax.Request('http://localhost:8888/lab10/bookSearch/books_json.php', {
			method: 'get',
			parameters: {'category': category},
			onSuccess: showBooks_JSON,
			onFailure: ajaxFailed,
			onException: ajaxFailed
		})
    }
};

function getCheckedRadio(radio_button){
	for (var i = 0; i < radio_button.length; i++) {
		if(radio_button[i].checked){
			return radio_button[i].value;
		}
	}
	return undefined;
}

function showBooks_XML(ajax) {
	var ul = $('books');
	while(ul.firstChild){
		ul.firstChild.remove();
	}
	var result = ajax.responseXML;
	var book = result.getElementsByTagName('book');
	for(var i=0;i<book.length;i++){
		var title = book[i].getElementsByTagName('title')[0].firstChild.nodeValue;
		var author = book[i].getElementsByTagName('author')[0].firstChild.nodeValue;
		var year = book[i].getElementsByTagName('year')[0].firstChild.nodeValue;
		var li = document.createElement('li');
		li.innerHTML = title + ', by' + author + ' (' + year +')';
		ul.appendChild(li);
	}

}

function showBooks_JSON(ajax) {
	var ul = $('books');
	while(ul.firstChild){
		ul.firstChild.remove();
	}
	var result = JSON.parse(ajax.responseText);
	
	for(var i=0;i<result.books.length;i++){
		var book = result.books[i];
		var title = book.title;
		var author = book.author;
		var year = book.year;
		var li = document.createElement('li');
		li.innerHTML = title + ', by' + author + ' (' + year +')';
		ul.appendChild(li);
	}
}

function ajaxFailed(ajax, exception) {
	var errorMessage = "Error making Ajax request:\n\n";
	if (exception) {
		errorMessage += "Exception: " + exception.message;
	} else {
		errorMessage += "Server status:\n" + ajax.status + " " + ajax.statusText + 
		                "\n\nServer response text:\n" + ajax.responseText;
	}
	alert(errorMessage);
}

function clearListCookies()
{
	var cookies = document.cookie.split(";");
	for (var i = 0; i < cookies.length; i++) {
		var spcook = cookies[i].split("=");
		document.cookie = spcook[0] + "=;expires=Thu, 21 Sep 1979 00:00:01 UTC;";
	}
}

function getCookies() {
	if (document.cookie && document.cookie != "") {
		document.cookie.split(";").forEach(function(x) {
			var tmp = x.split("=");
			for (var i = 0; i < tmp.length; i++) tmp[i] = tmp[i].trim();
			console.log(tmp);
			if (tmp[0] && tmp[0].match(/todo\d+/) != null && tmp[1]) addTodo(tmp[1]);
		});
	}
}

var ft_list;

window.onload = function() {
	ft_list = document.getElementById("ft_list");
	getCookies();
	document.getElementById("new").addEventListener("click", function() {
		addTodo(prompt("To do:", ""));
	});
};

window.onunload = function() {
	clearListCookies();
	var todo = ft_list.children;
	var newCookie = [];
	for (var i = 0; i < todo.length; i++) {
		document.cookie = `todo${i}=${todo[i].textContent};`;
	}
};

function addTodo(task) {
	if (task == "") return;

	var elem = document.createElement("div");
	elem.classList.add("todo");
	elem.textContent = task;
	elem.addEventListener("click", function() {
		if (confirm("Are you sure?") == true) elem.remove();
	});
	ft_list.insertBefore(elem, ft_list.firstChild);
}

function deleteAllCookies() {
	var cookies = document.cookie.split(";");

	for (var i = 0; i < cookies.length; i++) {
		var cookie = cookies[i];
		var eqPos = cookie.indexOf("=");
		var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
		document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
	}
}

$(document).ready(function(){
	$("#new").click(newTodo);
	
	if (document.cookie)
	{
		var oldCookie = JSON.parse(document.cookie);
		oldCookie.forEach(function(e){
			addTodo(e);
		});
	}
});

$(window).on("beforeunload", function(){
	var newCookie = $.map($("#ft_list").children(), function(a){
		return a.textContent;
	});
	document.cookie = JSON.stringify(newCookie);
});

function newTodo() {
	var task = prompt("To do:", "");
	if (task !== "")
		addTodo(task);
}

function addTodo(task)
{
	var elem = $('<div class="todo">' + task + "</div>").click(deleteTodo);
	$("#ft_list").prepend(elem);
}

function deleteTodo()
{
	if (confirm("Are you sure?") == true)
		this.remove();
}
var ft_list;
var cookie = [];

$(document).ready(function ()
{
	$('#new').click(newItem);
	$('#ft_list div').click(deleteItem);
	ft_list = $('#ft_list');
	var temp = document.cookie;
	if (temp)
	{
		cookie = JSON.parse(temp);
		cookie.forEach(function(e)
		{
			addItem(e);
		});
	}
});

$(window).unload(function ()
{
	var item = ft_list.children;
	var newCookie = [];
	for (var i = 0; i < item.length; i++)
		newCookie.unshift(item[i].innerHTML);
	document.cookie = JSON.stringify(newCookie);
})

function newItem()
{
	var item = prompt("Add an item to your list?", "e.g.: 'Laminate my student card'");
	if (item && item !== "" && item !== "e.g.: 'Laminate my student card'" && item !== null)
		addItem(item);
}

function addItem(item) {
	ft_list.prepend($('<div>' + item + '</div>').click(deleteItem));
}

function deleteItem()
{
	if (confirm("Delete this item? Really??"))
		this.remove();
}
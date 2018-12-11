var ft_list;

$(document).ready(function ()
{
	$('#new').click(newItem);
	$('#ft_list div').click(deleteItem);
	ft_list = $('#ft_list');
	loadItem();
});

function loadItem()
{
	ft_list.empty();
	funcAJAX('select.php', "GET", null, function(data)
	{
		data = jQuery.parseJSON(data);
		jQuery.each(data, function(i, val)
		{
			ft_list.prepend($('<div data-id="' + i + '">' + val + '</div>').click(deleteItem));
		});
	});
}

function newItem()
{
	var item = prompt("Add an item to your list?", "e.g.: 'Laminate my student card'");
	if (item && item !== "" && item !== "e.g.: 'Laminate my student card'" && item !== null)
		funcAJAX('insert.php?item=' + item, "GET", null, loadItem);
}

function deleteItem()
{
	if (confirm("Delete this item? Really??"))
		funcAJAX('delete.php?id=' + $(this).data('id'), "GET", null, loadItem);
}

function funcAJAX(url, method, data, success)
{
	$.ajax({
		method: method,
		url: url,
		data: data
	})
	.done(function(data)
	{
		success(data);
	})
	.error(function(msg)
	{
		alert("AJAX Error: " + msg);
	});
}
var ft_list;
var cookie = [];

window.onload = function ()
{
	document.querySelector("#new").addEventListener("click", newItem);
	ft_list = document.querySelector("#ft_list");
	var temp = document.cookie;
	if (temp)
	{
		cookie = JSON.parse(temp);
		cookie.forEach(function(e)
		{
			addItem(e);
		});
	}
};

window.onunload = function ()
{
	var item = ft_list.firstChild;
	var newCookie = '';
	for (var i = 0; i < item.length; i++)
		newCookie.unshift(item[i].innerHTML);
	document.cookie = JSON.stringify(newCookie);
};

function newItem()
{
	var item = prompt("Add an item to your list?", "e.g.: 'Laminate my student card'");
	if (item && item !== "" && item !== "e.g.: 'Laminate my student card'" && item !== null)
		addItem(item);
}

function addItem(item) {
	var div = document.createElement("div");
	div.innerHTML = item;
	div.addEventListener("click", deleteItem);
	ft_list.insertBefore(div, ft_list.firstChild);
}

function deleteItem()
{
	if (confirm("Delete this item? Really??"))
	{
		this.parentElement.removeChild(this);
	}
}

function checkCookie() {
    var list=getCookie("list");
    if (list != "") {
        alert("Welcome again " + list);
    } else {
       list = ft_list.firstChild;
       if (list != "" && list != null) {
           setCookie("list", list, 0.0416666667);
       }
    }
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
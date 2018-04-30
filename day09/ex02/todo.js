var tab = [];
var cook = get_cookie('tasks');

if (cook != "")
{
    tab = JSON.parse(cook);
    var list = document.getElementById('ft_list');
    for (var i = 0; i < tab.length;i++)
    {
        list.insertBefore(new_div(unescape(tab[i])), list.firstChild);
    }
}

function new_task()
{
    var task = prompt("Entrez le nom de la tache");
    var list = document.getElementById('ft_list');

    if (task != "" && task)
    {
        list.insertBefore(new_div(task), list.firstChild);
        tab.push(escape(task));
        set_cookie('tasks', JSON.stringify(tab), 15); 
    }
}

function new_div(message)
{
    var div = document.createElement('div');

    div.innerHTML = message;
    div.style.color = 'blue';
    div.onclick = delete_div;
    return (div);
}

function delete_div()
{
    if (confirm('Voulez-vous supprimer cette tache ?'))
    {
        tab.splice(tab.indexOf(unescape(this.innerHTML)), 1);
        set_cookie('tasks', JSON.stringify(tab), 15);
        this.remove();
    }
}

function set_cookie(name, value, days)
{
    var expires;

    if (days)
    {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }
    var request = name + "=" + value + expires + "; path=/";
    document.cookie = request;
}

function get_cookie(c_name)
{
    if (document.cookie.length > 0)
    {
        c_start = document.cookie.indexOf(c_name + "=");
        if (c_start != -1)
        {
            c_start = c_start + c_name.length + 1;
            c_end = document.cookie.indexOf(";", c_start);
            if (c_end == -1) {
                c_end = document.cookie.length;
            }
            return document.cookie.substring(c_start, c_end);
        }
    }
    return "";
}
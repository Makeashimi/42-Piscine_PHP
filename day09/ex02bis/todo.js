function new_div(message)
{
    var div = document.createElement('div');

    div.innerHTML = message;
    div.style.color = 'blue';
    div.id = 'task';
    return (div);
}
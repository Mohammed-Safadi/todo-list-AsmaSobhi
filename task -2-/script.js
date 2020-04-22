var taskInput = document.getElementById("new-task");
var addButton = document.getElementsByTagName("button")[0];
var tasks = document.getElementById("tasks");

tasks.addEventListener("click", function (e) {
    console.log(e.target.className == "done");
    if (e.target.className == "done") {
        changeColor(e.target);
    }

    if (e.target.className == "delete") {
        deleteTask(e.target);
    }

    e.preventDefault();
});

var createNewTaskElement = function (taskString) {
    var listItem = document.createElement("li");
    var label = document.createElement("label");
    var doneButton = document.createElement("button");
    var span = document.createElement("span");
    var dash = document.createElement("span");
    var btn = document.createElement("div");
    var deleteButton = document.createElement("button");

    label.innerText = taskString;
    doneButton.innerText = "Make as Done";
    doneButton.className = "done";
    deleteButton.innerText = "Delete";
    dash.innerText = "|";
    dash.className = "dash";
    deleteButton.className = "delete";
    btn.className = "btn";

    span.appendChild(doneButton);
    span.appendChild(dash);
    btn.appendChild(span);
    btn.appendChild(deleteButton);
    listItem.appendChild(label);
    listItem.appendChild(btn);
    return listItem;
};
var addTask = function () {
    if (taskInput.value != "") {
        console.log("Add Task...");
        var listItem = createNewTaskElement(taskInput.value);
        tasks.appendChild(listItem);
        taskInput.value = "";
    } else {
        alert("can not enter empty task ... please enter data");
    }
};
addButton.onclick = addTask;
var deleteTask = function (elemnt) {
    console.log("Delete Task...");
    var btn = elemnt.parentNode;
    var listItem = btn.parentNode;
    var ul = listItem.parentNode;
    ul.removeChild(listItem);
};
var changeColor = function (elemnt) {
    console.log("change color...");
    var span = elemnt.parentNode;
    var btn = span.parentNode;
    var listItem = btn.parentNode;
    listItem.style.color = "green";
    span.style.display = 'none';
};
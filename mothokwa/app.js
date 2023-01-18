function putTodo(todo) {
    // implement your code here
    console.log("calling putTodo");
    fetch(window.location.href + 'api/todo', {
        method: "PUT",
        headers: {"Content-Type": "application/json;charset=UTF-8"},
        body: JSON.stringify(todo)
    })
    .then(response => response.json())
    .then(json => console.log(json))
    .catch(
    //error => showToastMessage('Failed to create todo...');
    error=>console.log(error)
    );
    console.log(todo);
}

function postTodo(todo) {
    // implement your code here
    console.log("calling postTodo");
    fetch(window.location.href + 'api/todo', {
        method: "POST",
        headers: {"Content-Type": "application/json;charset=UTF-8"},
        body: JSON.stringify(todo)
    })
    .then(response => response.json())
    .then(json => console.log(json))
    .catch(
    //error => showToastMessage('Failed to create todo...');
    error=>console.log(error)
    );
    
}

function deleteTodo(todo) {
    // implement your code here
    console.log("calling deleteTodo");
    fetch(window.location.href + 'api/todo', {
        method: "DELETE",
        headers: {"Content-Type": "application/json;charset=UTF-8"},
        body: JSON.stringify(todo)
    })
    .then(response => response.json())
    .then(json => console.log(json))
    .catch(
    //error => showToastMessage('Failed to create todo...');
    error=>console.log(error)
    );
    //console.log(todo);
}

// example using the FETCH API to do a GET request
function getTodos() {
    fetch(window.location.href + 'api/todo')
            .then(response => response.json())
            .then(json => drawTodos(json))
            .catch(error => showToastMessage('Failed to retrieve todos...'));
}


getTodos();
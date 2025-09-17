function validateTaskForm() {
    const title = document.forms["taskForm"]["title"].value.trim();
    const due_date = document.forms["taskForm"]["due_date"].value;
    const priority = document.forms["taskForm"]["priority"].value;

    if (!title) {
        alert("Title is required");
        return false;
    }
    if (!due_date) {
        alert("DOnate date is required");
        return false;
    }
    if (!priority) {
        alert("Blood Group is required");
        return false;
    }
    return true;
}

function validateLoginForm() {
    const email = document.forms["loginForm"]["email"].value.trim();
    const password = document.forms["loginForm"]["password"].value.trim();

    if (!email) {
        alert("Email is required");
        return false;
    }
    if (!password) {
        alert("Password is required");
        return false;
    }
    return true;
}
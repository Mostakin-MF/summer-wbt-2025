var database = [
    {
        username: "guest",
        password: "guest@123",
    },
];

var information = [];

function signIn() {
    var userNamePrompt = prompt("What's your username?");
    var passwordPrompt = prompt("What's your password?");

    for (var i = 0; i < database.length; i++) {
        if (
            userNamePrompt === database[i].username &&
            passwordPrompt === database[i].password
        ) {
            console.log("Login successful!");
            console.log(information[i]);
            return true;
        }
    }
    alert("Incorrect username or password.");
    return false;
}

function ValidateForm() {
    let fname = document.getElementById("fname").value.trim();
    let lname = document.getElementById("lname").value.trim();
    let email = document.getElementById("email").value.trim();
    let title = document.getElementById("title").value.trim();

    if (fname === "") {
        alert("Please enter your First Name.");
        return false;
    }

    if (lname === "") {
        alert("Please enter your Last Name.");
        return false;
    }
    let fieldSelected = document.querySelector('input[name="field"]:checked');
    if (!fieldSelected) {
        alert("Please select a field of interest.");
        return false;
    }

    if (title === "") {
        alert("Please enter a Project Title.");
        return false;
    }

    let skills = document.querySelectorAll('input[name="skill"]:checked');
    if (skills.length === 0) {
        alert("Please select at least one required skill.");
        return false;
    }

    alert("Form submitted successfully!");
    alert(
        "👉 Use one of the following accounts to login:\n\n" +
        "Username: guest | Password: guest@123"
    );

    let skillsSelected = Array.from(skills)
        .map((s) => s.value)
        .join(", ");
    let newEntry = {
        submittedBy: fname + " " + lname,
        email: email,
        field: fieldSelected.value,
        title: title,
        skills: skillsSelected,
        submittedAt: new Date().toLocaleString(),
    };

    information.push(newEntry);

    signIn();
    let lastEntry = information[information.length - 1];
    alert(
        "📌 New Project Info:\n\n" +
        "Name: " +
        lastEntry.submittedBy +
        "\n" +
        "Email: " +
        lastEntry.email +
        "\n" +
        "Field: " +
        lastEntry.field +
        "\n" +
        "Project Title: " +
        lastEntry.title +
        "\n" +
        "Skills: " +
        lastEntry.skills +
        "\n" +
        "Submitted At: " +
        lastEntry.submittedAt
    );
    return true;
}

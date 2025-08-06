// this code only run only in console

// function for showing contact me information in Prompt and Alert Format

function ContactMePromptAndAlert() {
  let reason = prompt("Why do you want to contact? (research / project / other)");

  if (reason === "research") {
    let title = prompt("Enter your proposed research project title:");
    let field = prompt("Enter the research field (e.g., Data Science, ML):");

    alert("Thank you for your interest in research.\nTitle: " + title + "\nField: " + field);

  } else if (reason === "project") {
    let title = prompt("Enter your proposed project title:");
    let skills = prompt("Mention the required skills (e.g., Python, SQL):");

    alert("Thanks for submitting project details.\nTitle: " + title + "\nRequired Skills: " + skills);

  } else if (reason === "other") {
    let message = prompt("Please briefly state your message:");
    alert("Thanks for reaching out. Message received:\n" + message);

  } else {
    alert("Invalid input. Please refresh and type: research, project, or other.");
  }
}


ContactMePromptAndAlert()

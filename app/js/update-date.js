const currentYear = new Date().getFullYear();
const footerTextContent = `${currentYear}`;

let footerTextElement = document.querySelector("#copy-year");
footerTextElement.append(footerTextContent);

let date = new Date(document.lastModified);
let updateElement = document.querySelector("#update-date");
updateElement.append(`${date.toLocaleString('default', { month: 'long', day: 'numeric', year: 'numeric' })}`);
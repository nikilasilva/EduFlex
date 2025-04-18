//// table-1 = student table or teacher table.

const body = document.querySelector("body");
const sidebar = document.querySelector(".sidebar");
const toggle = document.querySelector(".toggle");


// Function to toggle sidebar
document.querySelector('.toggle').addEventListener('click', function() {
    const sidebar = document.querySelector('.sidebar');
    const topNavbarContainer = document.querySelector(".topNav-container");
    const dashBoardMainContent = document.querySelector(".main-content");
    const footer = document.querySelector(".footer");
    const table1 = document.querySelector(".table-1-container");
    const feedbackContainer = document.querySelector(".feedback-set-container");
    const announcementFormContainer = document.querySelector(".announcement-container");
    const announcementBoxViewContainer = document.querySelector(".announcement-box-container");
    const userprofileContainer = document.querySelector(".user-profile-container");
    const userSettingsContainer = document.querySelector(".user-settings-container");
    
    // Toggle sidebar
    if (sidebar) {
        sidebar.classList.toggle('close');
    }

    // Toggle top navbar container width
    if (topNavbarContainer) {
        topNavbarContainer.classList.toggle('full-width');
    }

    // Toggle footer visibility
    if (footer) {
        footer.classList.toggle("close");
    }

    // Toggle table width (if class exists)
    if (table1) {
        table1.classList.toggle('full-width');
    }

    // Toggle dashboard main content width
    if (dashBoardMainContent) {
        dashBoardMainContent.classList.toggle('full-width');
    }

    if (feedbackContainer) {
        feedbackContainer.classList.toggle('full-width');
    }

    if (announcementFormContainer) {
        announcementFormContainer.classList.toggle('full-width');
    }

    if (announcementBoxViewContainer) {
        announcementBoxViewContainer.classList.toggle('full-width');
    }

    if (userprofileContainer) {
        userprofileContainer.classList.toggle('full-width');
    }

    if (userSettingsContainer) {
        userSettingsContainer.classList.toggle('full-width');
    }
});



const students = [
    { id: 22, name: "Daniel Grant", gender: "Male", class: 2, parents: "Kofi Grant", address: "59 Australia Sydney", dateOfBirth: "02/05/2001", phone: "+123 9988568" },
    { id: 23, name: "Daniel Grant", gender: "Male", class: 3, parents: "Kofi Grant", address: "59 Australia Sydney", dateOfBirth: "02/05/2001", phone: "+123 9988568" },
    { id: 24, name: "Daniel Grant", gender: "Male", class: 5, parents: "Kofi Grant", address: "59 Australia Sydney", dateOfBirth: "02/05/2001", phone: "+123 9988568" },
    { id: 25, name: "Daniel Grant", gender: "Male", class: 4, parents: "Kofi Grant", address: "59 Australia Sydney", dateOfBirth: "02/05/2001", phone: "+123 9988568" },
    { id: 26, name: "Daniel Grant", gender: "Male", class: 2, parents: "Kofi Grant", address: "59 Australia Sydney", dateOfBirth: "02/05/2001", phone: "+123 9988568" },
    { id: 27, name: "Daniel Grant", gender: "Male", class: 1, parents: "Kofi Grant", address: "59 Australia Sydney", dateOfBirth: "02/05/2001", phone: "+123 9988568" },
    { id: 28, name: "Daniel Grant", gender: "Male", class: 3, parents: "Kofi Grant", address: "59 Australia Sydney", dateOfBirth: "02/05/2001", phone: "+123 9988568" },
    { id: 29, name: "Daniel Grant", gender: "Male", class: 4, parents: "Kofi Grant", address: "59 Australia Sydney", dateOfBirth: "02/05/2001", phone: "+123 9988568" },
    { id: 30, name: "Daniel Grant", gender: "Male", class: 4, parents: "Kofi Grant", address: "59 Australia Sydney", dateOfBirth: "02/05/2001", phone: "+123 9988568" },
    { id: 31, name: "Daniel Grant", gender: "Male", class: 1, parents: "Kofi Grant", address: "59 Australia Sydney", dateOfBirth: "02/05/2001", phone: "+123 9988568" },
    { id: 32, name: "Daniel Grant", gender: "Male", class: 3, parents: "Kofi Grant", address: "59 Australia Sydney", dateOfBirth: "02/05/2001", phone: "+123 9988568" },
    { id: 33, name: "Daniel Grant", gender: "Male", class: 4, parents: "Kofi Grant", address: "59 Australia Sydney", dateOfBirth: "02/05/2001", phone: "+123 9988568" },
    { id: 34, name: "Daniel Grant", gender: "Male", class: 4, parents: "Kofi Grant", address: "59 Australia Sydney", dateOfBirth: "02/05/2001", phone: "+123 9988568" },
];

function populateStudentTable() {
    const tableBody = document.getElementById('studentTableBody');
    tableBody.innerHTML = '';
    students.forEach(student => {
        const row = `
            <tr>
                <td>${student.id}</td>
                <td>${student.name}</td>
                <td>${student.gender}</td>
                <td>${student.class}</td>
                <td>${student.parents}</td>
                <td>${student.address}</td>
                <td>${student.dateOfBirth}</td>
                <td>${student.phone}</td>
            </tr>
        `;
        tableBody.innerHTML += row;
    });
}

// Call the function to populate the table when the page loads
window.onload = populateStudentTable;


const teachers = [
    { id: 22, name: "Daniel Grant", gender: "Male", class: 2, subject: "Science", address: "59 Australia Sydney", dateOfBirth: "02/05/2001", phone: "+123 9988568" },
    { id: 23, name: "Daniel Grant", gender: "Male", class: 3, subject: "Maths", address: "59 Australia Sydney", dateOfBirth: "02/05/2001", phone: "+123 9988568" },
    { id: 24, name: "Daniel Grant", gender: "Male", class: 5, subject: "Maths", address: "59 Australia Sydney", dateOfBirth: "02/05/2001", phone: "+123 9988568" },
    { id: 25, name: "Daniel Grant", gender: "Male", class: 4, subject: "English", address: "59 Australia Sydney", dateOfBirth: "02/05/2001", phone: "+123 9988568" },
    { id: 26, name: "Daniel Grant", gender: "Male", class: 2, subject: "Science", address: "59 Australia Sydney", dateOfBirth: "02/05/2001", phone: "+123 9988568" },
    { id: 27, name: "Daniel Grant", gender: "Male", class: 1, subject: "History", address: "59 Australia Sydney", dateOfBirth: "02/05/2001", phone: "+123 9988568" },
    { id: 28, name: "Daniel Grant", gender: "Male", class: 3, subject: "Maths", address: "59 Australia Sydney", dateOfBirth: "02/05/2001", phone: "+123 9988568" },
    { id: 29, name: "Daniel Grant", gender: "Male", class: 4, subject: "Science", address: "59 Australia Sydney", dateOfBirth: "02/05/2001", phone: "+123 9988568" },
    { id: 30, name: "Daniel Grant", gender: "Male", class: 4, subject: "History", address: "59 Australia Sydney", dateOfBirth: "02/05/2001", phone: "+123 9988568" },
    { id: 31, name: "Daniel Grant", gender: "Male", class: 1, subject: "Science", address: "59 Australia Sydney", dateOfBirth: "02/05/2001", phone: "+123 9988568" },
    { id: 32, name: "Daniel Grant", gender: "Male", class: 3, subject: "English", address: "59 Australia Sydney", dateOfBirth: "02/05/2001", phone: "+123 9988568" },
    { id: 33, name: "Daniel Grant", gender: "Male", class: 4, subject: "Maths", address: "59 Australia Sydney", dateOfBirth: "02/05/2001", phone: "+123 9988568" },
    { id: 34, name: "Daniel Grant", gender: "Male", class: 4, subject: "English", address: "59 Australia Sydney", dateOfBirth: "02/05/2001", phone: "+123 9988568" },
];

function populateTeacherTable() {
    const tableBody = document.getElementById('teacherTableBody');
    tableBody.innerHTML = '';
    teachers.forEach(teacher => {
        const row = `
            <tr>
                <td>${teacher.id}</td>
                <td>${teacher.name}</td>
                <td>${teacher.gender}</td>
                <td>${teacher.class}</td>
                <td>${teacher.subject}</td>
                <td>${teacher.address}</td>
                <td>${teacher.dateOfBirth}</td>
                <td>${teacher.phone}</td>
            </tr>
        `;
        tableBody.innerHTML += row;
    });
}

// Call the function to populate the table when the page loads
window.onload = populateTeacherTable;

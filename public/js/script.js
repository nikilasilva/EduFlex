import { setupTimetableSearch } from './timetable.js';

const body = document.querySelector("body");
const sidebar = document.querySelector(".sidebar");
const toggle = document.querySelector(".toggle");

// Function to determine timetable type based on page content
function getTimetableType() {
    if (document.querySelector('.class-timetable-container')) {
        return 'class';
    } else if (document.querySelector('.teacher-timetable-container')) {
        return 'teacher';
    }
    return null;
}

// Function to toggle sidebar
document.addEventListener('DOMContentLoaded', function () {
    // Select elements
    const sidebar = document.querySelector('.sidebar');
    const toggleButton = document.querySelector('.toggle');
    const containers = [
        document.querySelector(".topNav-container"),
        document.querySelector(".main-content"),
        document.querySelector(".footer"),
        document.querySelector(".table-1-container"),
        document.querySelector(".feedback-set-container"),
        document.querySelector(".announcement-container"),
        document.querySelector(".announcement-box-container"),
        document.querySelector(".user-profile-container"),
        document.querySelector(".user-settings-container"),
        document.querySelector(".background-container"),
        document.querySelector(".school-contact"),
        document.querySelector(".current-activities-container"),
        document.querySelector(".all-teachers-container"),
    ];

    // Restore sidebar state from localStorage
    const isSidebarClosed = localStorage.getItem('sidebarClosed') === 'true';

    if (isSidebarClosed && sidebar) {
        sidebar.classList.add('close');
        containers.forEach(container => {
            if (container) {
                container.classList.add('full-width');
            }
        });
    }

    // Add click event listener to toggle button
    if (toggleButton) {
        toggleButton.addEventListener('click', function () {
            const isNowClosed = sidebar.classList.toggle('close');
            localStorage.setItem('sidebarClosed', isNowClosed);

            containers.forEach(container => {
                if (container) {
                    container.classList.toggle('full-width');
                }
            });
        });
    }

    // Initialize timetable search based on page type
    const timetableType = getTimetableType();
    if (timetableType === 'class') {
        setupTimetableSearch(false);
    } else if (timetableType === 'teacher') {
        setupTimetableSearch(true);
    }
});

// Student table population
const students = [
    { id: 22, name: "Daniel Grant", gender: "Male", class: 2, parents: "Kofi Grant", address: "59 Australia Sydney", dateOfBirth: "02/05/2001", phone: "+123 9988568" },
    // ... rest of your student data ...
];

function populateStudentTable() {
    const tableBody = document.getElementById('studentTableBody');
    if (tableBody) {
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
}

// Teacher table population
const teachers = [
    { id: 22, name: "Daniel Grant", gender: "Male", class: 2, subject: "Science", address: "59 Australia Sydney", dateOfBirth: "02/05/2001", phone: "+123 9988568" },
    // ... rest of your teacher data ...
];

function populateTeacherTable() {
    const tableBody = document.getElementById('teacherTableBody');
    if (tableBody) {
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
}

// Modified window.onload to handle both tables based on page
window.onload = function() {
    const timetableType = getTimetableType();
    if (timetableType === 'class' && document.getElementById('studentTableBody')) {
        populateStudentTable();
    } else if (timetableType === 'teacher' && document.getElementById('teacherTableBody')) {
        populateTeacherTable();
    }
};
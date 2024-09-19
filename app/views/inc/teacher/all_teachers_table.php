<div class="all-teachers-container table-1-container">
    <h1>All Teachers Data</h1>
    <div class="search-bar">
        <input type="text" placeholder="Search by name...">
        <select>
            <option value="">Select Class</option>
            <option value="1">Class 1</option>
            <option value="2">Class 2</option>
            <option value="3">Class 3</option>
            <option value="4">Class 4</option>
            <option value="5">Class 5</option>
        </select>
        <select>
            <option value="">Select Subject</option>
            <option value="math">Math</option>
            <option value="science">Science</option>
            <option value="english">English</option>
            <option value="history">History</option>
        </select>
        <button>SEARCH</button>
    </div>
    <table class="table-1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Class</th>
                <th>Subject</th>
                <th>Address</th>
                <th>Date of Birth</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody id="teacherTableBody">
            <!-- Teacher data will be inserted here -->
        </tbody>
    </table>
    <div class="pagination">
        <span>Previous</span>
        <button class="active">1</button>
        <button>2</button>
        <button>3</button>
        <span>Next</span>
    </div>
</div>
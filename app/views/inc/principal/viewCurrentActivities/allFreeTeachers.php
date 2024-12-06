<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT . '/views/inc/components/sideBar.php'; ?>


<div class="current-activities-container">
    <main>
        <div class="current-activity-content">
        <h1>All Free Teachers</h1>
        <div class="search-bar">
            <input type="text" placeholder="Search by class" id="search-input">
            <button id="search-button">SEARCH</button>
        </div>
        <table class="free-classes-table">
            <thead>
            <tr>
                <th>Class</th>
                <th>Subject</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="table-body">
            <tr>
                <td>11-B</td>
                <td>Science</td>
                <td>
                    <a href="#" class="confirm-button">Confirm</a>
                </td>
            </tr>
            </tbody>
        </table>
        </div>
    </main>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>

<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>

<div class="layout">
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

    <div class="container">
        <h1>Edit Activity</h1>

        <form action="<?php echo URLROOT; ?>/teacher/editActivity/<?php echo $data['activity']->activity_id; ?>" method="POST">
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" id="date" value="<?php echo htmlspecialchars($data['activity']->date); ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" required><?php echo htmlspecialchars($data['activity']->description); ?></textarea>
            </div>

            <div class="form-group">
                <label for="additional_note">Additional Note</label>
                <textarea name="additional_note" id="additional_note"><?php echo htmlspecialchars($data['activity']->additional_note); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button><br></br>
            <a href="<?php echo URLROOT; ?>/teacher/viewActivities" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?php require APPROOT.'/views/inc/footer.php'; ?>


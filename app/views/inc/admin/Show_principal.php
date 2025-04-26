<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Activity</title>

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/teacher.css">
teacher
<body>
    <div class="layout">
        <!-- Sidebar -->
        <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

        <!-- Main content -->
        <div class="container">
            <h1>Show Principal Details</h1>

            <!-- Activities table -->
            <table class="activities-table">
                <thead>
                    <tr>
                        <th>User Reg</th>
                        <th>Principal ID</th>
                        <th>Year Of experience</th>
                        <th>Name With Initial</th>
                        <th>Hired Date</th>
        
                        <th>Operation</th>
        

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['principals'] as $principal): ?>
                        <tr>
                            <td><?php echo $principal->regNo; ?></td>
                            <td><?php echo $principal->principalId; ?></td>
                            <td><?php echo $principal->experience; ?></td>
                            <td><?php echo $principal->nameWithInitial?></td>
                            <td><?php echo $principal->hireDate; ?></td>


                    
                            <td>
                                <a href="<?php echo URLROOT; ?>/Admin/editPrincipal/<?php echo $principal->principalId; ?>" class="btn btn-edit">Update</a>
                                <a href="<?php echo URLROOT; ?>/Admin/deletePrincipal/<?php echo $principal->principalId; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this recode?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

<?php require APPROOT . '/views/inc/footer.php'; ?>
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
            <h1>Show VicePrincipal Details</h1>

            <!-- Activities table -->
            <table class="activities-table">
                <thead>
                    <tr>

                        <th>User Reg</th>
                        <th>Vice Principal ID</th>
                        <th>Name With Initial</th>
                        <th>Year Of experience</th>
                        <th>Hired Date</th>
        
                        <th>Operation</th>
        

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['vicePrincipals'] as $vicePrincipal): ?>
                        <tr>
                            <td><?php echo $vicePrincipal->regNo; ?></td>
                            <td><?php echo $vicePrincipal->vicePrincipalId; ?></td>
                            <td><?php echo $vicePrincipal->nameWithInitial?></td>
                            <td><?php echo $vicePrincipal->experience; ?></td>
                            <td><?php echo $vicePrincipal->hireDate; ?></td>


                    
                            <td>
                                <a href="<?php echo URLROOT; ?>/Admin/editVicePrincipal/<?php echo $vicePrincipal->vicePrincipalId; ?>" class="btn btn-edit">Update</a>
                                <a href="<?php echo URLROOT; ?>/Admin/deletevicePrincipal/<?php echo $vicePrincipal->vicePrincipalId; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this recode?');">Delete</a>
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
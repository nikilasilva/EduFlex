<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Insert User</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/insert_actor_style.css">
  <style>
    .error-message {
      color: red;
      font-size: 0.9rem;
      margin-top: 5px;
    }
  </style>
</head>

<body>
<div class="layout">
  <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>
  <div class="container">
    <h1>Insert User Details</h1>

    <form id="userForm" action="<?php echo URLROOT; ?>/Admin/submitUser" method="POST" novalidate>

      <!-- Full Name -->
      <div class="form-group">
        <label for="fullName">Full Name:</label>
        <input type="text" name="fullName" id="fullName" value="<?php echo isset($data['userData']['fullName']) ? $data['userData']['fullName'] : ''; ?>">
        <div class="error-message" id="fullNameError"></div>
      </div>

      <!-- Name With Initials -->
      <div class="form-group">
        <label for="nameWithInitial">Name With Initials:</label>
        <input type="text" name="nameWithInitial" id="nameWithInitial" required>
        <div class="error-message" id="nameWithInitialError"></div>
      </div>

      <!-- Mobile No -->
      <div class="form-group">
        <label for="mobileNo">Mobile Number :</label>
        <input type="text" name="mobileNo" id="mobileNo" required>
        <div class="error-message" id="mobileNoError"></div>
      </div>

      <!-- Address -->
      <div class="form-group">
        <label for="address">Address :</label>
        <textarea name="address" id="address" rows="2" required></textarea>
        <div class="error-message" id="addressError"></div>
      </div>

      <!-- Email -->
      <div class="form-group">
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required>
        <div class="error-message" id="emailError"></div>
      </div>

      <!-- Password -->
      <div class="form-group" style="position: relative;">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <span onclick="togglePassword()" style="position: absolute; right: 10px; top: 35px; cursor: pointer;">
          <i class="fa-solid fa-eye" id="eyeIcon" style="color: black;"></i>
        </span>
        <div class="error-message" id="passwordError"></div>
      </div>

      <!-- DOB -->
      <div class="form-group">
        <label for="dob">Date of Birth :</label>
        <input type="date" name="dob" id="dob" required>
        <div class="error-message" id="dobError"></div>
      </div>

      <!-- Gender -->
      <div class="form-group">
        <label for="gender">Gender :</label>
        <select name="gender" id="gender" required>
          <option value="">Select Gender</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
          <option value="Other">Other</option>
        </select>
        <div class="error-message" id="genderError"></div>
      </div>

      <!-- Religion -->
      <div class="form-group">
        <label for="religion">Religion :</label>
        <input type="text" name="religion" id="religion" required>
        <div class="error-message" id="religionError"></div>
      </div>

      <!-- Role -->
      <div class="form-group">
        <label for="role">Role :</label>
        <select name="role" id="role" required>
          <option value="">Select Role</option>
          <option value="admin">Admin</option>
          <option value="teacher">Teacher</option>
          <option value="student">Student</option>
          <option value="principal">Principal</option>
          <option value="vice-principal">Vice Principal</option>
          <option value="non-academic">Non-Academic</option>
          <option value="parent">Parent</option>
        </select>
        <div class="error-message" id="roleError"></div>
      </div>

      <!-- Submit Buttons -->
      <button type="submit" class="btn btn-primary">Submit User</button><br><br>
      <button type="button" onclick="window.location.href='<?php echo URLROOT; ?>/admin/viewUser'" class="btn btn-primary">View Users</button><br><br>
      <a href="<?php echo URLROOT; ?>/Dashboard/index" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</div>

      <!-- Validation Script -->
      <script>
      function togglePassword() {
        const passwordInput = document.getElementById("password");
        const eyeIcon = document.getElementById("eyeIcon");

        if (passwordInput.type === "password") {
          passwordInput.type = "text";
          eyeIcon.classList.remove("fa-eye");
          eyeIcon.classList.add("fa-eye-slash");
          eyeIcon.style.color = "white";
        } else {
          passwordInput.type = "password";
          eyeIcon.classList.remove("fa-eye-slash");
          eyeIcon.classList.add("fa-eye");
          eyeIcon.style.color = "black";
        }
      }

      document.getElementById('userForm').addEventListener('submit', function(event) {
        let isValid = true;

        // Clear previous error messages
        document.querySelectorAll('.error-message').forEach(el => el.textContent = '');

        // Full Name
        const fullName = document.getElementById('fullName').value.trim();
        if (!fullName) {
          document.getElementById('fullNameError').textContent = 'Full Name is required.';
          isValid = false;
        }

        // Name With Initials
        const nameWithInitial = document.getElementById('nameWithInitial').value.trim();
        if (!nameWithInitial) {
          document.getElementById('nameWithInitialError').textContent = 'Name with Initials is required.';
          isValid = false;
        }

        // Mobile No
      // Mobile No
      const mobileNo = document.getElementById('mobileNo').value.trim();
      const mobilePattern = /^\d{10}$/; // 10 digits only
      if (!mobileNo) {
        document.getElementById('mobileNoError').textContent = 'Mobile number is required.';
        isValid = false;
      } else if (!mobilePattern.test(mobileNo)) {
        document.getElementById('mobileNoError').textContent = 'Mobile number must be exactly 10 digits.';
        isValid = false;
      }


        // Address
        const address = document.getElementById('address').value.trim();
        if (!address) {
          document.getElementById('addressError').textContent = 'Address is required.';
          isValid = false;
        }

        // Email
        const email = document.getElementById('email').value.trim();
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email || !emailPattern.test(email)) {
          document.getElementById('emailError').textContent = 'Please enter a valid email address.';
          isValid = false;
        }

        // Password
        const password = document.getElementById('password').value.trim();
        if (!password) {
          document.getElementById('passwordError').textContent = 'Password is required.';
          isValid = false;
        } else if (password.length < 6) {
          document.getElementById('passwordError').textContent = 'Password must be at least 6 characters long.';
          isValid = false;
        }

        // DOB
        const dob = document.getElementById('dob').value;
        if (!dob) {
          document.getElementById('dobError').textContent = 'Date of Birth is required.';
          isValid = false;
        } else {
          const selectedDate = new Date(dob);
          const today = new Date();
          today.setHours(0, 0, 0, 0);

          if (selectedDate > today) {
            document.getElementById('dobError').textContent = 'Date of Birth cannot be a future date.';
            isValid = false;
          }
        }

        // Gender
        const gender = document.getElementById('gender').value;
        if (!gender) {
          document.getElementById('genderError').textContent = 'Please select a gender.';
          isValid = false;
        }

        // Religion
        const religion = document.getElementById('religion').value.trim();
        if (!religion) {
          document.getElementById('religionError').textContent = 'Religion is required.';
          isValid = false;
        }

        // Role
        const role = document.getElementById('role').value;
        if (!role) {
          document.getElementById('roleError').textContent = 'Please select a role.';
          isValid = false;
        }

        if (!isValid) {
          event.preventDefault();
        }
      });
      </script>

</body>
</html>
<?php require APPROOT.'/views/inc/footer.php'; ?>


<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Dependent Dropdown List</title>
    <link rel="stylesheet" href="form_styles.css">
</head>
<body>

    
<div class="container col-md-12">
<?php
    if(isset($_POST["submit"])) {
        $errors = array(); // Initialize an empty array to store errors

        // Retrieve form data
        $lastName = $_POST["LastName"];
        $firstName = $_POST["FirstName"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $repeatPassword = $_POST["password_repeat"]; // Ensure the correct name is used

        // Validate form inputs
        if (empty($lastName) || empty($firstName) || empty($email) || empty($password) || empty($repeatPassword)) {
            $errors[] = "All fields are required";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email is not valid";
        }

        if (strlen($password) < 8) {
            $errors[] = "Password must be at least 8 characters long";
        }

        if ($password != $repeatPassword) {
            $errors[] = "Passwords do not match";
        }

        // Display errors if any
        if (!empty($errors)) {
            echo "<div class='alert alert-danger'>";
            foreach ($errors as $error) {
                echo "<p>$error</p>";
            }
            echo "</div>";
        } else {
            // Validation passed, proceed with registration
            require_once "database.php"; // Include your database connection file

            // Prepare and bind the insertion query
            $sql = "INSERT INTO user (Last_Name, First_Name, email, password) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "<div class='alert alert-danger'>SQL Error</div>";
            } else {
                // Hash the password
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                // Bind parameters and execute the statement
                mysqli_stmt_bind_param($stmt, "ssss", $lastName, $firstName, $email, $passwordHash);
                mysqli_stmt_execute($stmt);

                // Check if the insertion was successful
                if (mysqli_stmt_affected_rows($stmt) > 0) {
                    echo "<div class='alert alert-success'>You are Registered Successfully!</div>";
                } else {
                    echo "<div class='alert alert-danger'>Registration failed</div>";
                }
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
    }
?>


    <form action="registration.php" method="post">
        <div class="name col-md-12">
            <h4>Fullname</h4>
            <div>
                <input type="text" class="form-control" placeholder="Last Name" name="LastName">
            </div>
            <div>
                <input type="text" class="form-control" placeholder="First Name" name="FirstName">
            </div>
        </div>

        <div class="form">
            <div class="select_option col-md-6">
                <h4>Address</h4>
                <input type="text" class="form-control" placeholder="Lot/Blk" name="lot_blk">
                <input type="text" class="form-control" placeholder="Street" name="street">
                <input type="text" class="form-control" placeholder="Phase/Subdivision" name="phase_subdivision">
                <select class="form-select country" aria-label="Default select example" onchange="loadStates()" name="country">
                    <option value="">Select Country</option>
                    <!-- Options loaded dynamically using JavaScript -->
                </select>
                <select class="form-select state" aria-label="Default select example" onchange="loadCities()" disabled name="state">
                    <option value="">Select Province</option>
                </select>
                <select class="form-select city" aria-label="Default select example" onchange="loadBarangays()" disabled name="city">
                    <option value="">Select City</option>
                </select>
                <select class="form-select barangay" aria-label="Default select example" disabled name="barangay">
                    <option value="">Barangay - Philippines Only</option>
                </select>
            </div>

            <div class="select_option col-md-6">
                <h4>Contact</h4>
                <div class="input-group">
                    <select class="col-md-1" aria-label="Default select example" id="country-code-select" onclick="loadCountryCodes()" name="country_code">
                        <option value="">#</option>
                        <!-- Options loaded dynamically using JavaScript -->
                    </select> 
                    <input type="tel" class="form-control contact-number" placeholder="Contact Number" name="contact_number">
                </div>
                <input type="email" class="form-control"  placeholder="Email" id="email" name="email">
                <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                <input type="password" class="form-control" placeholder="Repeat Password" id="password_repeat" name="password_repeat">
                
                <div class="login">
                    <p>Already registered? <a href="login.php">Login Here</a></p>
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>

    var config = {
        cUrl: 'https://api.countrystatecity.in/v1/countries',
        ckey: 'NHhvOEcyWk50N2Vna3VFTE00bFp3MjFKR0ZEOUhkZlg4RTk1MlJlaA=='
    }



    const apiUrl = "https://psgc.gitlab.io/api/";


    var countrySelect = document.querySelector('.country'),
        stateSelect = document.querySelector('.state'),
        citySelect = document.querySelector('.city'),
        barangaySelect = document.querySelector('.barangay');


    function loadCountries() {

        let apiEndPoint = config.cUrl


        fetch(apiEndPoint, {headers: {"X-CSCAPI-KEY": config.ckey}})
            .then(Response => Response.json())
            .then(data => {
                data.forEach(country => {
                    const option = document.createElement('option')
                    option.value = country.iso2
                    option.textContent = country.name
                    countrySelect.appendChild(option)
                })
            })
            .catch(error => console.error('Error loading countries:', error))

        stateSelect.disabled = true
        citySelect.disabled = true
        barangaySelect.disabled = true
    }


    function loadStates() {
        stateSelect.disabled = false

        const selectedCountryCode = countrySelect.value
        stateSelect.innerHTML = '<option value="">Select State</option>'
        citySelect.innerHTML = '<option value="">Select City</option>'
        barangaySelect.innerHTML = '<option value="">Select Barangay</option>'

        if (selectedCountryCode === 'PH') {
            citySelect.disabled = true;
            barangaySelect.disabled = true;
            populateDropdown(apiUrl + "provinces/", stateSelect);
            
        } else {
            citySelect.disabled = true;
            barangaySelect.disabled = true;

            fetch(`${config.cUrl}/${selectedCountryCode}/states`, {headers: {"X-CSCAPI-KEY": config.ckey}})
            .then(response => response.json())
            .then(data => {
                data.forEach(state => {
                    const option = document.createElement('option')
                    option.value = state.iso2
                    option.textContent = state.name
                    stateSelect.appendChild(option)
                })
            })
            .catch(error => console.error('Error loading countries:', error))
        }

    }


    function loadCities() {
        citySelect.disabled = false;

        const selectedCountryCode = countrySelect.value
        const selectedStateCode = stateSelect.value

        citySelect.innerHTML = '<option value="">Select City</option>'
        barangaySelect.innerHTML = '<option value="">Select Barangay</option>'

        if (selectedCountryCode === 'PH' && selectedStateCode) {
            populateDropdown(apiUrl + "provinces/" + selectedStateCode + "/cities/", citySelect);


            // call function populateDropdown(url, selectElement)
        } else {
            barangaySelect.disabled = true;

            fetch(`${config.cUrl}/${selectedCountryCode}/states/${selectedStateCode}/cities`, {headers: {"X-CSCAPI-KEY": config.ckey}})
            .then(response => response.json())
            .then(data => {
                data.forEach(city => {
                    const option = document.createElement('option')
                    option.value = city.iso2
                    option.textContent = city.name
                    citySelect.appendChild(option)
                })
            })
        }
    }

    function loadBarangays() {

    const selectedCityCode = citySelect.value;

    barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

    if (selectedCityCode) {
        // If a city is selected, load barangays
        populateDropdown(apiUrl + "cities/" + selectedCityCode + "/barangays/", barangaySelect);
    }
}
    function populateDropdown(url, selectElement) {
      fetch(url)
        .then(response => {
          if (!response.ok) {
            throw new Error(`Failed to fetch ${selectElement.id}`);
          }
          return response.json();
        })
        .then(data => {
          data.forEach(item => {
            const option = document.createElement('option');
            option.value = item.code;
            option.textContent = item.name;
            selectElement.appendChild(option);
          });
          selectElement.disabled = false;
        })
        .catch(error => console.error(`Error loading ${selectElement.id}:`, error.message));
    }


    function loadCountryCodes() {
    const countryCodeSelect = document.getElementById('country-code-select');
    countryCodeSelect.innerHTML = '<option value=""> #</option>';

    // Fetch your JSON file containing country codes and names
    fetch('country_codes.json')
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to fetch country codes');
            }
            return response.json();
        })
        .then(data => {
            data.forEach(country => {
                // Check if required properties exist
                if (country?.dial_code && country?.name) {
                    const option = document.createElement('option');
                    option.value = country.dial_code;
                    option.textContent = `${country.dial_code} (${country.name})`;
                    countryCodeSelect.appendChild(option);
                }
            });
        })
        .catch(error => console.error('Error fetching country codes:', error));

    // Add event listener to update input field with selected country code
    countryCodeSelect.addEventListener('change', function() {
        const selectedCountryCode = this.value;
        const contactNumberInput = document.querySelector('.contact-number');
        contactNumberInput.value = selectedCountryCode + " ";
    });
}






    window.onload = function() {
        loadCountries();
        loadCountryCodes();
    };



    

</script>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>

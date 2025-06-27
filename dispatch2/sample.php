<div class="new-reportList">
        <h1>Resolved Incident List</h1>
        <div class="searchBar bg-transparent">
    <i class="fa-solid fa-magnifying-glass bg-transparent"></i>
    <input type="text" name="search" id="search" placeholder="Search">
    <button id="search-btn">Search</button>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
   <script>
    $(document).ready(function () {
        function updateTableWithSearchResults() {
            var searchQuery = $('#search').val();
            var url = 'Get_Search.php?search=' + encodeURIComponent(searchQuery);

            $.ajax({
                type: 'GET',
                url: url,
                success: function (response) {
    console.log('Response from server:', response);
    $('#incident-table-body').html(response);
},
                error: function () {
                    console.error('Error fetching search results');
                }
            });
        }

        function updateTable() {
            $.ajax({
                type: 'GET',
                url: 'Get_Latest_Incidents.php',
                success: function (response) {
                    $('#incident-table-body').html(response);
                },
                error: function () {
                    console.error('Error fetching latest incidents');
                }
            });
        }

        // Initial table update
        updateTable();

        // Event listener for the "Search" button
        $('#search-btn').on('click', function () {
            updateTableWithSearchResults();
        });

        // Event listener for the "Update Entries" button
        $('#entries').on('change', function () {
            // Your existing code for updating entries
            // ...

            // After updating entries, update the entire table
            updateTable();
        });
    });
</script>

        <div class="showEntries bg-transparent">
            <span>Show</span>
            <input type="number" name="entries" id="entries" >
            <span>entries</span>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
    $(document).ready(function () {
        // Check if the default entries value is not set in the session
        if (!sessionStorage.getItem('entries_default')) {
            // Set the default entries value in the session
            sessionStorage.setItem('entries_default', '50');
        }

        // Set default entries value on page load
        var defaultEntries = sessionStorage.getItem('entries_default');
        $('#entries').val(defaultEntries);

        // Event listener for the "Update Entries" button
        $('#entries').on('change', function () {
            var entries = $(this).val();

            // Set a default value if entries is empty or not a valid number
            entries = entries.trim() === '' || isNaN(entries) ? defaultEntries : entries;

            // Call the PHP script to update the entries dynamically
            $.ajax({
                type: 'GET',
                url: 'Get_Entries.php',
                data: { entries: entries },
                success: function () {
                    // Reload the table or perform any other necessary updates
                    updateTable();
                },
                error: function () {
                    // Handle errors
                    console.error('Failed to update entries. Please try again.');
                }
            });
        });

        // Your existing script for updating the table
        function updateTable() {
            $.ajax({
                type: 'GET',
                url: 'Get_Latest_Incidents.php', // Replace with the actual URL to fetch the latest incidents
                success: function (response) {
                    $('#incident-table-body').html(response);

                    // Update the #entries input value based on the number of rows in the table
                    var rowCount = $('#incident-table-body tr').length;
                    $('#entries').val(rowCount);
                },
                error: function () {
                    // Handle errors
                }
            });
        }

        // Initial table update
        updateTable();
    });
</script>


    <div class="dashboard-container">
    <table class="new-report-table">
        <thead>
            <tr>
                <th>Incident ID</th>
                <th>Date and Time of Incident<br>(Reported)</th>
                <th>Type of Incident</th>
                <th>Location of Incident<br>(Barangay)</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="incident-table-body">
        
        </tbody>
    </table>
    <script>
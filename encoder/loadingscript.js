$(document).ready(function() {
    // Initially load the 'incident-list.php' page
    loadPage('incident-list.php');
    loadPage('resolved_incident.php');
    loadPage('archive_list.php');

    // Handle clicks on report links
    $('.toggle-report').click(function(e) {
        e.preventDefault();
        let page = $(this).attr('href');
        loadPage(page);
    });
});

function loadPage(page) {
    // Use AJAX or Fetch API to load content dynamically
    $.ajax({
        url: page,
        method: 'GET',
        success: function(data) {
            $('#content-container').html(data);
        },
        error: function() {
            // Handle errors, e.g., show an error message or load a default page
            $('#content-container').html('Failed to load content.');
        }
    });
}

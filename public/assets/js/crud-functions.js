// 2022-01-09 OG NEW - Admin create functionality
// =============================================================================
// CREATE
// 
// The request get handled by ajax to allow for asynchronous functionality
// =============================================================================

// 2022-01-09 OG NEW - When the form is submitted by clicking the button of type submit
$("#create").submit(function(event) {

    // 2022-01-09 OG NEW - Take the submitted data and prevent the form from being submitted 
    var request = $(this).serializeArray();
    event.preventDefault();

    // 2022-01-09 OG NEW - Create the object for the ajax request 
    var data = {};
    request.forEach(function(requestInput) {
        data[requestInput['name']] = requestInput['value'];
    });

    // 2022-01-09 OG NEW - Make the request 
    $.ajax({
        url: 'index.php?'+ document.getElementById('route').value +'/create',
        method: 'POST',
        data: data,
        success: function(data) { 
            var parsedData = JSON.parse(data);
            
            // 2022-01-09 OG NEW - Get the current number of rows
            var countElement = document.getElementById('count');
            var count = parseInt(countElement.innerHTML) + 1;

            // 2022-01-09 OG NEW - Go to last table page 
            dataTable.page((count/10) + 1);

            // 2022-01-09 OG NEW - Display the row in the table 
            var newRow = [];

            request.forEach(function(requestInput) {
                newRow.push(parsedData[requestInput['name']]);
            });

            dataTable.rows().add(newRow);
            
            // 2022-01-09 OG NEW - Increase the counter by one
            countElement.innerHTML = count;
        }
    });
});


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
            var newRow = ['<button class="btn btn-danger btn-sm btn-delete" value="'+ parsedData['id'] +'">Delete</button>'];

            request.forEach(function(requestInput) {
                newRow.push(parsedData[requestInput['name']]);
            });

            console.log(newRow);

            dataTable.rows().add(newRow);
            
            // 2022-01-09 OG NEW - Increase the counter by one
            countElement.innerHTML = count;

            // 2022-01-09 OG NEW - Empty the array for next creation 
            newRow = [];

            del();
        }
    });
});

// 2022-01-09 OG NEW - Admin delete functionality
// =============================================================================
// DELETE
// 
// The request get handled by ajax to allow for asynchronous functionality
// =============================================================================
function del() {
    $('.btn-delete').click(function() {
        // 2022-01-09 OG NEW - Create the object for the ajax request
        var data = {id: this.value};
        var row = $(this).parent().parent();
        
        $.ajax({
            url: 'index.php?'+ document.getElementById('route').value +'/delete',
            method: 'POST',
            data: data,
            success: function(data) {
                row.remove();

                var countElement = document.getElementById('count');
                var count = parseInt(countElement.innerHTML) - 1;
                countElement.innerHTML = count;
            }
        });
    });
}

del();
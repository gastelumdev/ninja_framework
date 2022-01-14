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
    var requestData = {};
    request.forEach(function(requestInput) {
        requestData[requestInput['name']] = requestInput['value'];
    });

    console.log(requestData);

    // 2022-01-09 OG NEW - Make the request 
    $.ajax({
        url: 'index.php?'+ document.getElementById('route').value +'/create',
        method: 'POST',
        data: requestData,
        success: function(data) { 
            var parsedData = JSON.parse(data);
            
            // 2022-01-09 OG NEW - Get the current number of rows
            var countElement = document.getElementById('count');
            var count = parseInt(countElement.innerHTML) + 1;

            dataTable.refresh();

            // 2022-01-09 OG NEW - Go to last table page 
            dataTable.page((count/10) + 1);

            // 2022-01-09 OG NEW - Display the row in the table 
            var newRow = ['<button class="btn btn-danger btn-sm btn-delete" value="'+ parsedData['id'] +'">Delete</button>'];
            console.log(newRow);

            request.forEach(function(requestInput) {
                newRow.push(parsedData[requestInput['name']]);
            });

            console.log(newRow);

            dataTable.rows().add(newRow);
            
            // 2022-01-09 OG NEW - Increase the counter by one
            countElement.innerHTML = count;

            // 2022-01-09 OG NEW - Empty the array for next creation 
            newRow = [];

            // 2022-01-09 OG NEW - Empty the form inputs 
            document.getElementById('create').reset();

            // 2022-01-09 OG NEW - Call the delete function to listen for delete changes 
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
        console.log('Clicked');
        // 2022-01-09 OG NEW - Create the object for the ajax request
        var requestData = {id: this.value};
        
        // 2022-01-09 OG NEW - Make request to the server to delete 
        $.ajax({
            url: 'index.php?'+ document.getElementById('route').value +'/delete',
            method: 'POST',
            data: requestData,
            success: function(data) {
                // console.log(JSON.parse(data));

                // 2022-01-09 OG NEW - Decrement the display of the total rows 
                var countElement = document.getElementById('count');
                var count = parseInt(countElement.innerHTML) - 1;
                countElement.innerHTML = count;

                // 2022-01-09 OG NEW - Get all the trs and loop through them to find which 
                //                     one to remove with simple-dataTables api
                var tableRows = document.getElementById('table1').children[1].children;

                for (var i = 0; i < tableRows.length; i++) {
                    var buttonValue = tableRows[i].children[0].children[0].value;
                    // 2022-01-09 OG NEW - If event id matches the event id in the tr, then remove table row 
                    if (buttonValue == requestData['id']) {
                        // 2022-01-09 OG NEW - First set the table page to the current page or else it will not remove it
                        dataTable.page(dataTable.currentPage);
                        dataTable.rows().remove(i);
                        dataTable.update();
                    }
                }

                dataTable.update();
                del();
            }
        });
    });
}

// 2022-01-09 OG NEW - If the page changes call the delete function to listen for changes 
dataTable.on('datatable.page', function(page) {
    del();
});

del();
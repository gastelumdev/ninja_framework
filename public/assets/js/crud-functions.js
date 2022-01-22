// 2022-01-17 OG NEW - This will hold the element that becomes row that becomes editable
//                     so that they can be changed back to not editable
var editableElements = {};
var editable = false;

// 2022-01-09 OG NEW - When the body is clicked and there is a row that is editable set it back to view-only
$('body').click(function(event) {
    if (editable) {
        // 2022-01-17 OG NEW - show delete and edit buttons and hide save and cancel buttons 
        editableElements['deleteButton'].style.display = 'inline-block';
        editableElements['editButton'].style.display = 'inline-block';

        editableElements['saveButton'].style.display = 'none';
        editableElements['cancelButton'].style.display = 'none';

        for (var i = 0; i < editableElements['formDataElements'].length; i++) {
            editableElements['formDataElements'][i].style.display = 'block';
        }

        for (var i = 0; i < editableElements['inputDataElements'].length; i++) {
            editableElements['inputDataElements'][i].style.display = 'none';
        }
    }
});

function stopPropInputs() {
    var inputs = document.getElementsByClassName('inputData');

    for (var i = 0; i < inputs.length; i++) {
        inputs[i].addEventListener('click', function(event) {
            event.stopPropagation();
        });
    }
}

stopPropInputs();

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
            var newRow = ['<button id="delete'+ parsedData['id'] +'" class="btn btn-danger btn-sm btn-delete" value="'+ parsedData['id'] +'">Delete</button> <button id="edit'+ parsedData['id'] +'" type="button" class="btn btn-success btn-sm btn-edit" value="'+ parsedData['id'] +'">Edit</button>'];
            newRow[0] += '<button id="save'+ parsedData['id'] +'" class="btn btn-primary btn-sm btn-save" value="'+ parsedData['id'] +'" style="display: none;">Save</button> <button id="cancel'+ parsedData['id'] +'" type="button" class="btn btn-danger btn-sm btn-cancel" value="'+ parsedData['id'] +'" style="display: none;">Cancel</button>';

            request.forEach(function(requestInput) {
                var type;
                console.log(requestInput['name']);
                if (requestInput['name'] == 'date' || requestInput['name'] == 'time') {
                    type = requestInput['name'];
                } else {
                    type = 'text'
                }
                var html = '<div class="tableData">' + requestInput['value'] + '</div><input class="inputData" type="' + type + '" name="' + requestInput['name'] + '" value="' + requestInput['value'] + '" style="display: none;">'
                newRow.push(html);
            });

            dataTable.rows().add(newRow);
            
            // 2022-01-09 OG NEW - Increase the counter by one
            countElement.innerHTML = count;

            // 2022-01-09 OG NEW - Empty the array for next creation 
            newRow = [];

            // 2022-01-09 OG NEW - Empty the form inputs 
            document.getElementById('create').reset();

            // 2022-01-09 OG NEW - Call the delete function to listen for delete changes 
            stopPropInputs();
            del();
            edit();
            save();
        }
    });
});

// 2022-01-09 OG NEW - Admin update functionality
// =============================================================================
// UPDATE
// 
// The request get handled by ajax to allow for asynchronous functionality
// =============================================================================
function save() {
    $('.btn-save').click(function() {
        var tableRow = $(this)[0].parentElement.parentElement;
        var inputs = tableRow.getElementsByTagName('input');
        var requestData = {};
        console.log(this.value);
        requestData['id'] = this.value;
        
        for (var i = 0; i < inputs.length; i++) {
            requestData[inputs[i]['name']] = inputs[i]['value'];
        }

        console.log(requestData);
        $.ajax({
            url: 'index.php?'+ document.getElementById('route').value +'/update',
            method: 'POST',
            data: requestData,
            success: function(data) {
                var parsedData = JSON.parse(data);
                console.log(parsedData);
            }
        });

        for (var i = 0; i < inputs.length; i++) {
            inputs[inputs[i].name].previousElementSibling.innerHTML = inputs[i].value;
            // inputs[inputs[i].name].value = parsedData[inputs[i].name];
        }
    });
}


// 2022-01-09 OG NEW - Admin delete functionality
// =============================================================================
// DELETE
// 
// The request get handled by ajax to allow for asynchronous functionality
// =============================================================================
function del() {
    $('.btn-delete').click(function() {
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
                edit();
                save();
            }
        });
    });
}

function edit() {
    $('.btn-edit').click(function(event) {
        event.stopPropagation();

        if (editable) {
            // 2022-01-17 OG NEW - show delete and edit buttons and hide save and cancel buttons 
            editableElements['deleteButton'].style.display = 'inline-block';
            editableElements['editButton'].style.display = 'inline-block';

            editableElements['saveButton'].style.display = 'none';
            editableElements['cancelButton'].style.display = 'none';

            for (var i = 0; i < editableElements['formDataElements'].length; i++) {
                editableElements['formDataElements'][i].style.display = 'block';
            }

            for (var i = 0; i < editableElements['inputDataElements'].length; i++) {
                editableElements['inputDataElements'][i].style.display = 'none';
            }
        }

        var id = this.value;
        var tableRow = this.parentElement.parentElement;
        var deleteButton = document.getElementById('delete' + id);
        var editButton = this;
        var saveButton = document.getElementById('save' + id);
        var cancelButton = document.getElementById('cancel' + id);
        
        // 2022-01-17 OG NEW - Hide delete and edit buttons and show save and cancel buttons 
        deleteButton.style.display = 'none';
        editButton.style.display = 'none';

        saveButton.style.display = 'inline-block';
        cancelButton.style.display = 'inline-block';

        // 2022-01-17 OG NEW - Hide table text 
        var formDataElements = tableRow.getElementsByClassName('tableData');
        var inputDataElements = tableRow.getElementsByClassName('inputData');

        for (var i = 0; i < formDataElements.length; i++) {
            formDataElements[i].style.display = 'none';
        }

        for (var i = 0; i < inputDataElements.length; i++) {
            inputDataElements[i].style.display = 'block';
        }

        editableElements = {
            deleteButton: deleteButton,
            editButton: editButton,
            saveButton: saveButton,
            cancelButton: cancelButton,
            formDataElements: formDataElements,
            inputDataElements: inputDataElements
        };

        editable = true;
    });

    $('.btn-cancel').click(function() {
        var id = this.value;
        var tableRow = this.parentElement.parentElement;
        var deleteButton = document.getElementById('delete' + id);
        var editButton = document.getElementById('edit' + id);
        var saveButton = document.getElementById('save' + id);
        var cancelButton = this;

        // 2022-01-17 OG NEW - show delete and edit buttons and hide save and cancel buttons 
        deleteButton.style.display = 'inline-block';
        editButton.style.display = 'inline-block';

        saveButton.style.display = 'none';
        cancelButton.style.display = 'none';

        // 2022-01-17 OG NEW - Hide table text 
        var formDataElements = tableRow.getElementsByClassName('tableData');
        var inputDataElements = tableRow.getElementsByClassName('inputData');

        for (var i = 0; i < formDataElements.length; i++) {
            formDataElements[i].style.display = 'block';
        }

        for (var i = 0; i < inputDataElements.length; i++) {
            inputDataElements[i].style.display = 'none';
        }

        editable = false;
    });
}

// 2022-01-09 OG NEW - If the page changes call the delete function to listen for changes 
dataTable.on('datatable.page', function(page) {
    del();
    edit();
    save();
});

del();
edit();
save();
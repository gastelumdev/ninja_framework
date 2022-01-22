<!-- Basic Tables start -->
<div class="main-content container">
    <div class="page-title">
        <h3><?=$title?></h3>
        <p class="text-subtitle text-muted">Total: <span id="count"><?=$count?></span></p>
    </div>
    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Create an event</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form id="create" class="form">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" id="name" class="form-control" placeholder="Event name"
                                                name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <input type="text" id="description" class="form-control" placeholder="Event description"
                                                name="description">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="date">Date</label>
                                            <input type="date" id="date" class="form-control" name="date">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="time">Time</label>
                                            <input type="time" id="time" class="form-control" name="time">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">List of events</h4>
            </div>
            <div class="card-body">
                <table class='table' id="table1">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <?php foreach ($events as $event): ?>
                        <tr>
                            <td>
                                <button id="delete<?=$event['id']?>" type="button" class="btn btn-danger btn-sm btn-delete" value="<?=$event['id']?>">Delete</button>
                                <button id="edit<?=$event['id']?>" type="button" class="btn btn-success btn-sm btn-edit" value="<?=$event['id']?>">Edit</button>
                                <button id="save<?=$event['id']?>" type="submit" class="btn btn-primary btn-sm btn-save" value="<?=$event['id']?>" style="display: none;">Save</button>
                                <button id="cancel<?=$event['id']?>" type="button" class="btn btn-danger btn-sm btn-cancel" value="<?=$event['id']?>" style="display: none;">Cancel</button>
                            </td>
                            <td>
                                <div class="tableData"><?=$event['name']?></div>
                                <input class="inputData" type="text" name="name" value="<?=$event['name']?>" style="display: none;">
                            </td>
                            <td>
                                <div class="tableData" class="edit"><?=$event['description']?></div>
                                <input class="inputData" type="text" name="description" value="<?=$event['description']?>" style="display: none;">
                            </td>
                            <td>
                                <div class="tableData" class="edit"><?=$event['date']?></div>
                                <input class="inputData" type="date" name="date" value="<?=$event['date']?>" style="display: none;">
                            </td>
                            <td>
                                <div class="tableData" class="edit"><?=$event['time']?></div>
                                <input class="inputData" type="time" name="time" value="<?=$event['militaryTime']?>" style="display: none;">
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
<!-- Basic Tables end -->
</div>
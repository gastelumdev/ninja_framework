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
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <?php foreach ($events as $event): ?>
                        <tr>
                            <td>
                                <button class="btn btn-danger btn-sm btn-delete" name="" value="<?=$event->id?>">Delete</button>
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable<?=$event->id?>">
                                Edit
                                </button>
                            </td>
                            <td><div contenteditable="true" spellcheck="false" class="edit"><?=$event->name?></div></td>
                            <td><div contenteditable="true" spellcheck="false" class="edit"><?=$event->description?></div></td>
                            <td><?=$event->date?></td>
                        </tr>
                        <div class="modal fade" id="exampleModalScrollable<?=$event->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle<?=$event->id?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollableTitle<?=$event->id?>">
                                            Scrolling long Content</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?=$event->id?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-secondary"
                                            data-bs-dismiss="modal">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Close</span>
                                        </button>
                                        <button type="button" class="btn btn-primary ml-1"
                                            data-bs-dismiss="modal">
                                            <i class="bx bx-check d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Accept</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
<!-- Basic Tables end -->
</div>
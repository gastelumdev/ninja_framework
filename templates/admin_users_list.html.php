<!-- Basic Tables start -->
<div class="main-content container">
    <div class="page-title">
        <h3><?=$title?></h3>
        <p class="text-subtitle text-muted">Total: <?=$count?></p>
    </div>
    <section class="section">
                    <div class="card">
                        <div class="card-header">
                            Simple Datatable
                        </div>
                        <div class="card-body">
                            <table class='table table-striped' id="table1">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($authors as $author): ?>
                                    <tr>
                                        <td><?=$author->name?></td>
                                        <td><?=$author->email?></td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
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
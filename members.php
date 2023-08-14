<?php include('db_connect.php'); ?>

<div class="container-fluid">
    <style>
        input[type=checkbox] {
            /* Double-sized Checkboxes */
            -ms-transform: scale(1.5); /* IE */
            -moz-transform: scale(1.5); /* FF */
            -webkit-transform: scale(1.5); /* Safari and Chrome */
            -o-transform: scale(1.5); /* Opera */
            transform: scale(1.5);
            padding: 10px;
        }
    </style>
    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12">

            </div>
        </div>
        <div class="row">
            <!-- FORM Panel -->

            <!-- Table Panel -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b>Member List</b>
                        <!-- <div class="float-right"> -->
                            <a href="report.php">
                            <button class="btn btn-success btn-block btn-sm col-sm-2 float-right"><i class="fa fa-folder"></i>EXPORT</button>
                            </a>
                        <!-- </div> -->                    </div>
                    <div class="card-body">
                        <div id="message"></div> <!-- New message div -->
                        <table class="table table-bordered table-condensed table-hover">
                            <colgroup>
                                <col width="5%">
                                <col width="15%">
                                <col width="20%">
                                <col width="20%">
                                <col width="20%">
                                <col width="20%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="">Name</th>
                                    <th class="">Email</th>
                                    <th class="">TrainerID</th>
                                    <th class="">Plan</th>
                                    <th class="">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                $member = $conn->query("SELECT * FROM usertable");
                                while ($row = $member->fetch_assoc()):
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++ ?></td>
                                    <td class="">
                                        <p><b><?php echo ucwords($row['name']) ?></b></p>
                                    </td>
                                    <td class="">
                                        <p><b><?php echo $row['email'] ?></b></p>
                                    </td>
                                    <td class="">
                                        <p><b><?php echo $row['tid'] ?></b></p>
                                    </td>
                                    <td class="">
                                        <p><b><?php echo $row['plan'] ?></b></p>
                                    </td>
                                    <td class="">
                                        <p><b><?php echo $row['status'] ?></b></p>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($row['status'] != 'Inactive'): ?>
                                            <button class="btn btn-sm btn-outline-danger delete_member" type="button" data-id="<?php echo $row['id'] ?>">Disable</button>
                                        <?php else: ?>
                                            <button class="btn btn-sm btn-danger" type="button" disabled>Deleted</button>
                                        <?php endif; ?>
                                        <?php if ($row['status'] == 'Inactive'): ?>
                                            <button class="btn btn-sm btn-outline-primary reactivate_member" type="button" data-id="<?php echo $row['id'] ?>">Reactivate</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Table Panel -->
        </div>
    </div>
</div>

<style>
    td {
        vertical-align: middle !important;
    }
    td p {
        margin: unset;
    }
    img {
        max-width: 100px;
        max-height: 150px;
    }
</style>

<script>
    $(document).ready(function(){
        $('table').dataTable();
    });
    $(document).ready(function() {
        $('.delete_member').click(function() {
            var memberId = $(this).data('id');
            var button = $(this); // Store button reference
            $.ajax({
                url: 'delete.php',
                method: 'POST',
                data: {
                    action: 'delete',
                    member_id: memberId
                },
                success: function(response) {
                    if (response == 1) {
                        button.removeClass('btn-outline-danger').addClass('btn-danger').prop('disabled', true).text('Deleted');
                        $('#message').html('<div class="alert alert-success">Member disabled successfully.</div>');
                    } else {
                        $('#message').html('<div class="alert alert-danger">Error deleting member.</div>');
                    }
                }
            });
        });

        $('.reactivate_member').click(function() {
            var memberId = $(this).data('id');
            var button = $(this); // Store button reference
            $.ajax({
                url: 'delete.php',
                method: 'POST',
                data: {
                    action: 'reactivate',
                    member_id: memberId
                },
                success: function(response) {
                    if (response == 1) {
                        button.removeClass('btn-primary').addClass('btn-outline-primary').prop('disabled', true).text('Reactivate');
                        $('#message').html('<div class="alert alert-success">Member reactivated successfully.</div>');
                    } else {
                        $('#message').html('<div class="alert alert-danger">Error reactivating member.</div>');
                    }
                }
            });
        });
    });
</script>

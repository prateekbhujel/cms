<?php
    $title = 'Staffs';
    view('back/templates/header.php', compact('title'));
    view('back/templates/nav.php');
?>
<div class="container">
    <div class="row">
        <div class="col-12 bg-white py-3 my-3 rounded-3 shadow-sm">
            <div class="row">
                <div class="col">
                    <h1><?php echo $title; ?></h1>
                </div>
                
                <div class="col-auto">
                    <a href="<?php  echo url('staffs/create'); ?>" class="btn btn-dark">
                        <i class="fa-solid fa-plus me-2"></i>Add Staff
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <?php if(!empty($users['data'])): ?>
                        <table class="table table-striped table-hover table-sm">
                            <thead class="table-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach($users['data'] as $user): ?>
                                    <tr>
                                        <td><?php echo $user->name; ?></td>
                                        <td><?php echo $user->email; ?></td>
                                        <td><?php echo $user->phone; ?></td>
                                        <td><?php echo $user->address; ?></td>
                                        <td><?php echo $user->status; ?></td>
                                        <td><?php echo dt_format($user->created_at); ?></td>
                                        <td><?php echo dt_format($user->updated_at) ?></td>
                                        <td>
                                            <a href="<?php echo url("staffs/edit/{$user->id}") ?>" class="btn btn-dark btn-sm">
                                                <i class="fa-solid fa-edit me-2"></i>Edit
                                            </a>
                                            <a href="<?php echo url("staffs/destroy/{$user->id}") ?>" class="btn btn-danger btn-sm delete">
                                                <i class="fa-solid fa-times me-2"></i>Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php view('back/templates/pagination.php', ['pages' => $users['pages'], 'current'=>$users['current'], 
                        'base'=>url('staffs')]); ?>
                    <?php else:  ?>
                        <h4 class="text-muted fst-italic">No data added</h4>
                    <?php endif;  ?>
                </div>
            </div>
        </div>
    </div>   
</div>



<?php view('back/templates/footer.php'); ?>





    
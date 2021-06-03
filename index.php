<?php
    require_once 'config/config.php';
    include('includes/header.php');


    $user = '';
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
        $stmt = $conn->prepare('SELECT * FROM todo WHERE user_id = ?');
        $stmt->execute([$_SESSION['user']->id]);
        $todos = $stmt->fetchAll();
    }else{
        header('location: login.php');
    }

    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();
    $users = $stmt->fetchAll();

    
?>
<div class="container">
    <h1>Welcome <?php echo $_SESSION['user']->name?>!</h1>
    

    <!-- ToDo Table -->
    <div class="container table-responsive py-5">
        <a class="btn btn-warning ladda-button" href="todo.php?id=<?php echo $user->id; ?>">ToDo</a>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th colspan="2" style="text-align: center;">Action</th>
                </tr>
            </thead>
            
            <?php foreach($todos as $key=>$todo) {?>
                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td><?php echo $todo->name; ?></td>
                    <td><?php echo $todo->email; ?></td>
                    <td><?php echo $todo->phone; ?></td>
                    <td>
                        <a href="todo_update.php?id=<?php echo $todo->id; ?>" class="btn btn-primary edit_btn" data-toggle="modal">Edit</a>
                    </td>
                    <td>
                        <a href="todo_delete.php?id=<?php echo $todo->id; ?>" class="btn btn-warning del_btn" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <!-- Users Table -->
    <div class="container table-responsive py-5">
        <h4>User Tables</h4>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th colspan="2" style="text-align: center;">Action</th>
                </tr>
            </thead>
            
            <?php foreach($users as $key=>$user) { ?>
                <tr>
                    <td><?php echo $user->id; ?></td>
                    <td><?php echo $user->name; ?></td>
                    <td><?php echo $user->email; ?></td>
                    <td><?php echo $user->phone; ?></td>
                    <?php
                        if($user->id == $_SESSION['user']->id) { ?>
                            <td>
                                <a href="update.php?id=<?php echo $user->id; ?>" class="btn btn-primary edit_btn" data-toggle="modal">Edit</a>
                            </td>
                            <td>
                                <a href="delete.php?id=<?php echo $user->id; ?>" class="btn btn-warning del_btn" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                       <?php } else {?>
                            <td>
                                <a disabled href="update.php?id=<?php echo $user->id; ?>" class="btn btn-primary edit_btn" data-toggle="modal">Edit</a>
                            </td>
                            <td>
                                <a disabled href="delete.php?id=<?php echo $user->id; ?>" class="btn btn-warning del_btn" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                    <?php }
                    ?>
                    
                    <?php 

                    ?>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
<?php include('includes/footer.php')?>
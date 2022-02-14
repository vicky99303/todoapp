<?php $__env->startSection("content"); ?>
    <div class="container">
        <?php if(session()->has('message')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Done !!! </strong><?php echo e(session()->get('message')); ?>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <div class="col-md-6">
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <h1>Todo List</h1>
            <form method="POST" action=<?php echo e(url('/task')); ?>>
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="timezone" value="<?php echo e($timezone); ?>">
                <div class="form-group">
                    <label for="TaskName">Task Name</label>
                    <input type="text" class="form-control" name="task" placeholder="Enter Task">
                </div>
                <div class="form-group">
                    <label for="Deadline">Deadline</label>
                    <input type="datetime-local" class="form-control" name="deadline" placeholder="Enter Date Time">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
            </form>
            <hr>
            <ol>
                <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $new_str = new DateTime($task->deadline, new DateTimeZone('UTC'));
                        $new_str->setTimeZone(new DateTimeZone($timezone));
                        $deadline = $new_str->format('h A, jS M Y')
                    ?>
                    <li><a href ="javascript:void(0)"><?php echo e($task->task); ?> - Deadline: <?php echo e($deadline); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ol>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\todoapp\resources\views/welcome.blade.php ENDPATH**/ ?>
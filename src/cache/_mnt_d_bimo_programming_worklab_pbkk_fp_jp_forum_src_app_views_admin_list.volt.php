<?= $this->tag->getDoctype() ?>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $this->tag->rendertitle() ?>
        <?= $this->assets->outputCSS('header') ?>

        <!-- <link rel="shortcut icon" type="image/x-icon" href="<?= $this->url->get('img/favicon.ico') ?>"/> -->
    </head>

    <body>
        
        <?php if ($this->session->has('auth')) { ?>
        <?= $this->partial('partials/auth/navbar') ?><?php } else { ?><?= $this->partial('partials/guest/navbar') ?>
        <?php } ?> 
        
         
<div class="container mt-5">
    <div class="row-center mt-5">
        <div class="col-md-auto bg-white">
            <div class="text-center">
                <table class="table table-hover">
                    <thead class="thead bg-primary text-white text-justify">
                        <tr>
                            <th scope="col" ><h5>Users</h5></th>
                            <th scope="col"><h6>Created</h6></th>
                            <th scope="col"><h6>Role</h6></th>
                        </tr>
                    </thead>
                    <tbody class="th text-justify">
                        <?php foreach ($users as $user) { ?>
                        <tr>
                            <th scope="row" > 
                                <div class="col-5 ">
                                        <a href="<?= $this->url->get('/user/show/') . $user->id ?>"><h5><?= $user->username ?></h5></a> 
                                </div>
                            </th>
                            <th scope="row"><h6><?= $user->created_at ?></h6></th>
                        <?php if ($user->role == 0) { ?>
                        <?php $role = 'User'; ?>
                        <?php } elseif ($user->role == 1) { ?>
                        <?php $role = 'Moderator'; ?>
                        <?php } else { ?>
                        <?php $role = 'Admin'; ?>
                        <?php } ?>
          
                            <th scope="row">  
                             <form class="form-inline ml-2" action="<?= $this->url->get('/admin/updateRole') ?>" method="POST">
                                <input type="hidden" name="uid" value="<?= $user->id ?>">
                                <select name="role" class="form-control" >
                                    <option value="" disabled selected> <?= $role ?> </option>
                                    <option value="0">User</option>
                                    <option value="1">Moderator</option>
                                    <option value="2">Admin</option>
                                </select>
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Change</button>
                            </form>
                            </th>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

        


    </body>
 
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <?= $this->assets->outputJS('js') ?>

</html>
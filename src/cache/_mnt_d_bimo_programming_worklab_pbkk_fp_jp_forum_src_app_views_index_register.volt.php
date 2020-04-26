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
        
         
    <div class="container mt-5 mx-auto">
        <div class="row justify-content-md-center">
            <div class="col-md-auto bg-light border rounded p-5">
                <div class="text-center">
                    <div class="h2 mb-5">Register</div>
                    <form action="<?= $this->url->get('/index/store') ?>" method="POST">
                        <div class="form-group row">
                            <div class="col-md-3 text-right">
                                <label for="username">Username</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 text-right">
                                <label for="email">Email</label>
                            </div>
                            <div class="col-md-9">
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 text-right">
                                <label for="password">Password</label>
                            </div>
                            <div class="col-md-9">
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

        


    </body>
 
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <?= $this->assets->outputJS('js') ?>

</html>
a:5:{i:0;s:459:"<?= $this->tag->getDoctype() ?>
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
        ";s:6:"navbar";s:198:"
        <?php if ($this->session->has('auth')) { ?>
        <?= $this->partial('partials/auth/navbar') ?><?php } else { ?><?= $this->partial('partials/guest/navbar') ?>
        <?php } ?> 
        ";i:1;s:9:"
        ";s:7:"content";s:1599:" 
<div class="container mt-5">
    <div class="row-center mt-5">
        <div class="col-md-auto bg-white">
            <div class="text-center">
                <table class="table table-hover">
                    <thead class="thead bg-primary text-white text-justify">
                        <tr>
                            <th scope="col" class="th "><h5>Subforums</h5></th>
                            <th scope="col"><h6>Threads</h6></th>
                            <th scope="col"><h6>Created</h6></th>
                            <th scope="col"><h6>Last Post</h6></th>
                        </tr>
                    </thead>
                    <tbody class="th text-center">
                        <?php foreach ($subforums as $subforum) { ?>
                        <tr>
                            <th scope="row" class="th text-justify"> 
                                <div class="col-5 ">
                                        <a href="<?= $this->url->get('/subforum/show/') . $subforum->id ?>"><h5><?= $subforum->name ?></h5></a> 
                                        <h6 class="text-muted text-truncate"><?= $subforum->description ?></h6> 
                                </div>
                            </th>
                            <th scope="row"><h6><?= $subforum->threads ?></h6></th>
                            <th scope="row"></th>
                            <th scope="row"></th>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
";i:2;s:260:"
        


    </body>
 
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <?= $this->assets->outputJS('js') ?>

</html>";}
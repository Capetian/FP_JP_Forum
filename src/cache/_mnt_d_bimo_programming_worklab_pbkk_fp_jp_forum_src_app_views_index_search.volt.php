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
        <div class="col-md-auto bg-light p-5">
            <div class="row justify-content-between">
                <div class="col-4">
                    <div class="row">
                        <h4> Search Results </h4>
                    </div>
                </div>
            </div>
            <table class="table border-top border-bottom">
                <tbody class="th text-center">
                    <?php foreach ($results as $result) { ?>
                    <tr>
                        <th>
                            <div class="row text-justify">
                                <div class="col">
                                   <a href="/thread/show/<?= $result->id ?>">  <h5><?= $result->title ?></h5></a> 
                                    <h6> By : <?= $result->user->username ?> </h6>
                                </div>
                            </div>
                        </th>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

        


    </body>
 
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <?= $this->assets->outputJS('js') ?>

</html>
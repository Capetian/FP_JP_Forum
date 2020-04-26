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
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item"><a href="/index">Home</a></li>
                    <li class="breadcrumb-item"><a href="/subforum/index">Thread</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
        <div class="row ">
            <div class="col bg-light p-5">
                <div class="h2 mb-5">Create a Thread</div>
                <form action="<?= $this->url->get('/thread/store') ?>" method="POST">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <select name="sid" class="form-control">
                            <?php foreach ($subforums as $subforum) { ?>
                                <option value="<?= $subforum->id ?>"><?= $subforum->name ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                     <input type="hidden" name="uid" value="<?= $this->session->get('auth')['uid'] ?>">
                    <div class="form-group row">
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Thread Topic">
                        </div>
                    </div>
                    <div class="form-group row pb-1">
                        <div class="col-md-9">
                            <textarea class="form-control" id="content" name="content" placeholder="First post ..."></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-auto">Create</button>
                </form>
            </div>
        </div>
    </div>

        


    </body>
 
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <?= $this->assets->outputJS('js') ?>

</html>